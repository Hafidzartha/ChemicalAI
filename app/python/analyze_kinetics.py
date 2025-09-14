#!/usr/bin/env python3
"""
analyze_kinetics.py
Server-ready version of your Google Colab script.
- Accepts CLI args: --video <path> --params <base64-json>
- Does not use IPython/Colab widgets or display functions.
- Uses matplotlib Agg backend and saves PNGs to disk (next to the video file).
- Prints a single JSON object to stdout containing keys the Laravel controller expects.
- Writes helpful messages to stderr on failure and exits non-zero.

Expected params JSON keys (base64 encoded by the Laravel controller):
{
  "konsentrasi_awal": <number>,
  "ph": <number>,
  "volume_total": <number>,
  "pelarut": "string",
  "laju_pengadukan": <number>,
  "nama_reaksi": "string"
}

Save this file to app/python/analyze_kinetics.py and make sure the PHP Process call uses the correct PYTHON_PATH.
"""
import os
os.environ["MPLCONFIGDIR"] = os.path.join(os.path.dirname(__file__), "matplotlib_config")

import matplotlib
matplotlib.use("Agg")

import argparse
import base64
import json
import os
import sys
import traceback
import math

import cv2
import numpy as np
from scipy.stats import linregress
import matplotlib.pyplot as plt


def eprint(*args, **kwargs):
    print(*args, file=sys.stderr, **kwargs)


def safe_linregress(x, y):
    """Run linregress but return None on failure."""
    try:
        return linregress(x, y)
    except Exception:
        return None


def lr_obj_to_dict(lr):
    """Convert a SciPy linregress result to a JSON-serializable dict including R^2."""
    if lr is None:
        return {'slope': None, 'intercept': None, 'r_value': None, 'p_value': None, 'stderr': None, 'r2': None}
    r2 = float(lr.rvalue ** 2) if hasattr(lr, 'rvalue') and lr.rvalue is not None else None
    return {
        'slope': float(lr.slope),
        'intercept': float(lr.intercept),
        'r_value': float(lr.rvalue),
        'p_value': float(lr.pvalue),
        'stderr': float(lr.stderr) if lr.stderr is not None else None,
        'r2': r2
    }


def main():
    parser = argparse.ArgumentParser(description='Analyze kinetics from a video')
    parser.add_argument('--video', required=True, help='Full path to the video file')
    parser.add_argument('--params', required=True, help='Base64-encoded JSON string of parameters')
    args = parser.parse_args()

    try:
        params_json = base64.b64decode(args.params).decode('utf-8')
        params = json.loads(params_json)
    except Exception as exc:
        eprint('Failed to decode --params:', exc)
        traceback.print_exc(file=sys.stderr)
        sys.exit(2)

    # Map expected parameter names (fall back to None when missing)
    reaction_name = params.get('nama_reaksi') or params.get('reaction_name') or ''
    initial_conc = params.get('konsentrasi_awal')
    ph_value = params.get('ph')
    total_volume = params.get('volume_total') or params.get('volume')
    solvent = params.get('pelarut')
    stirring_rate = params.get('laju_pengadukan')

    video_path = args.video
    if not os.path.isfile(video_path):
        eprint('Video file does not exist:', video_path)
        sys.exit(3)

    cap = cv2.VideoCapture(video_path)
    if not cap.isOpened():
        eprint('Error: Could not open video:', video_path)
        sys.exit(4)

    fps = cap.get(cv2.CAP_PROP_FPS)
    if fps is None or fps <= 0 or np.isnan(fps):
        fps = 30.0

    time_data = []
    color_intensity_data = []
    avg_intensity_rgb_data = []
    bubble_count_data = []

    frame_count = 0

    try:
        while True:
            ret, frame = cap.read()
            if not ret:
                break

            current_time = frame_count / fps
            time_data.append(current_time)

            # kinetics: grayscale mean
            gray_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
            average_intensity_kinetics = float(np.mean(gray_frame))
            color_intensity_data.append(average_intensity_kinetics)

            # average RGB
            rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
            avg_intensity_r = float(np.mean(rgb_frame[:, :, 0]))
            avg_intensity_g = float(np.mean(rgb_frame[:, :, 1]))
            avg_intensity_b = float(np.mean(rgb_frame[:, :, 2]))
            avg_intensity_rgb = (avg_intensity_r + avg_intensity_g + avg_intensity_b) / 3.0
            avg_intensity_rgb_data.append(avg_intensity_rgb)

            # bubble detection (simple thresholding)
            blurred_bubbles = cv2.GaussianBlur(gray_frame, (5, 5), 0)
            # adaptive thresholding can be used, but keep heuristic threshold for now
            try:
                _, thresh_bubbles = cv2.threshold(blurred_bubbles, 150, 255, cv2.THRESH_BINARY_INV)
            except Exception:
                # fallback if frame statistics cause issues
                thresh_bubbles = (blurred_bubbles < 150).astype('uint8') * 255

            contours_bubbles, _ = cv2.findContours(thresh_bubbles, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)
            bubble_count = len(contours_bubbles)
            bubble_count_data.append(bubble_count)

            frame_count += 1

    finally:
        cap.release()

    if len(time_data) == 0:
        eprint('No frames were read from the video.')
        sys.exit(5)

    time_data = np.array(time_data)
    color_intensity_data = np.array(color_intensity_data)
    avg_intensity_rgb_data = np.array(avg_intensity_rgb_data)
    bubble_count_data = np.array(bubble_count_data)

    # --- Kinetics analysis ---
    try:
        max_intensity_kinetics = float(np.max(color_intensity_data))
    except Exception:
        max_intensity_kinetics = float(color_intensity_data[0]) if len(color_intensity_data) > 0 else 0.0

    concentration_proxy = max_intensity_kinetics - color_intensity_data
    concentration_proxy = concentration_proxy.astype(float) + 1e-9

    # Zero-order: [A] vs t
    zr = safe_linregress(time_data, concentration_proxy)

    # First-order: ln([A]) vs t — ensure positive
    safe_conc_for_log = concentration_proxy.copy()
    min_val = np.min(safe_conc_for_log)
    if min_val <= 0:
        safe_conc_for_log = safe_conc_for_log + abs(min_val) + 1e-9

    fr = safe_linregress(time_data, np.log(safe_conc_for_log))

    # Second-order: 1/[A] vs t — avoid division by zero
    safe_conc_for_inv = concentration_proxy.copy()
    safe_conc_for_inv[safe_conc_for_inv == 0] = 1e-9
    sr = safe_linregress(time_data, 1.0 / safe_conc_for_inv)

    zero_order_r2 = float(zr.rvalue**2) if zr is not None else 0.0
    first_order_r2 = float(fr.rvalue**2) if fr is not None else 0.0
    second_order_r2 = float(sr.rvalue**2) if sr is not None else 0.0

    r2_values = {
        'Zero-order': zero_order_r2,
        'First-order': first_order_r2,
        'Second-order': second_order_r2
    }

    best_order = max(r2_values, key=r2_values.get)
    best_r2 = r2_values[best_order]

    regression_results = {
        'Zero-order': lr_obj_to_dict(zr),
        'First-order': lr_obj_to_dict(fr),
        'Second-order': lr_obj_to_dict(sr),
        'Best_Order': best_order
    }

    # half-life calculations
    initial_concentration_proxy = float(concentration_proxy[0]) if len(concentration_proxy) > 0 else 0.0
    k_zero = abs(regression_results['Zero-order']['slope']) if regression_results['Zero-order']['slope'] is not None else 0.0
    k_first = abs(regression_results['First-order']['slope']) if regression_results['First-order']['slope'] is not None else 0.0
    k_second = abs(regression_results['Second-order']['slope']) if regression_results['Second-order']['slope'] is not None else 0.0

    t_half_zero = initial_concentration_proxy / (2 * k_zero) if k_zero > 0 else float('inf')
    t_half_first = math.log(2) / k_first if k_first > 0 else float('inf')
    t_half_second = 1.0 / (k_second * initial_concentration_proxy) if k_second > 0 and initial_concentration_proxy > 0 else float('inf')

    # Bubble metrics
    time_diff_bubbles = np.diff(time_data)
    if len(time_diff_bubbles) > 0 and np.min(time_diff_bubbles) > 0:
        bubble_rate = np.diff(bubble_count_data) / time_diff_bubbles
    else:
        bubble_rate = np.array([0])

    total_bubbles = int(np.sum(np.maximum(0, np.diff(bubble_count_data))))
    average_bubble_rate = float(np.mean(bubble_rate[bubble_rate > 0])) if np.sum(bubble_rate > 0) > 0 else 0.0

    # Prepare plots and save them next to the video file
    video_dir = os.path.dirname(os.path.abspath(video_path))
    video_basename = os.path.splitext(os.path.basename(video_path))[0]

    kinetics_plot_path = os.path.join(video_dir, f"{video_basename}_kinetics.png")
    rgb_plot_path = os.path.join(video_dir, f"{video_basename}_rgb.png")
    bubble_plot_path = os.path.join(video_dir, f"{video_basename}_bubbles.png")

    try:
        # kinetics plot
        plt.figure(figsize=(10, 6))
        if best_order == 'Zero-order' and zr is not None:
            plt.scatter(time_data, concentration_proxy, s=5, label='Data ([A] proxy)')
            plt.plot(time_data, zr.intercept + zr.slope * time_data, label=f'Zero-order Fit (R²={best_r2:.4f})')
            plt.ylabel('Concentration Proxy ([A])')
        elif best_order == 'First-order' and fr is not None:
            plt.scatter(time_data, np.log(safe_conc_for_log), s=5, label='Data (ln([A]) proxy)')
            plt.plot(time_data, fr.intercept + fr.slope * time_data, label=f'First-order Fit (R²={best_r2:.4f})')
            plt.ylabel('ln(Concentration Proxy)')
        elif best_order == 'Second-order' and sr is not None:
            plt.scatter(time_data, 1.0 / safe_conc_for_inv, s=5, label='Data (1/[A]) proxy)')
            plt.plot(time_data, sr.intercept + sr.slope * time_data, label=f'Second-order Fit (R²={best_r2:.4f})')
            plt.ylabel('1 / Concentration Proxy')
        else:
            plt.scatter(time_data, concentration_proxy, s=5)

        plt.xlabel('Time (seconds)')
        plt.title(f'Best-Fit Reaction Order Linearization ({best_order})')
        plt.legend()
        plt.grid(True)
        plt.tight_layout()
        plt.savefig(kinetics_plot_path)
        plt.close()

        # grayscale intensity over time
        plt.figure(figsize=(10, 6))
        plt.scatter(time_data, color_intensity_data, s=5, label='Color Intensity (grayscale)')
        plt.xlabel('Time (seconds)')
        plt.ylabel('Average Color Intensity (Grayscale)')
        plt.title('Color Intensity Change Over Time')
        plt.grid(True)
        plt.legend()
        plt.tight_layout()
        plt.savefig(rgb_plot_path)
        plt.close()

        # bubble count over time
        plt.figure(figsize=(10, 6))
        plt.scatter(time_data, bubble_count_data, s=5, label='Bubble Count')
        plt.xlabel('Time (seconds)')
        plt.ylabel('Number of Bubbles')
        plt.title('Bubble Formation Over Time')
        plt.grid(True)
        plt.legend()
        plt.tight_layout()
        plt.savefig(bubble_plot_path)
        plt.close()
    except Exception:
        eprint('Warning: failed to generate/save plots')
        traceback.print_exc(file=sys.stderr)

    graf_public = []
    try:
        normalized = os.path.normpath(os.path.abspath(video_path))
        if '/storage/app/public/' in normalized.replace('\\', '/'):
            rel = normalized.split('/storage/app/public/')[-1]
            # ubah path supaya hasilnya "storage/videos/xxx.png"
            graf_public = [
                os.path.join("storage", os.path.basename(os.path.dirname(p)), os.path.basename(p))
                for p in [kinetics_plot_path, rgb_plot_path, bubble_plot_path]
            ]
        else:
            # fallback: coba ganti manual "storage/app/public" → "storage"
            graf_public = [
                p.replace("\\", "/").split("storage/app/public/")[-1]
                for p in [kinetics_plot_path, rgb_plot_path, bubble_plot_path]
            ]
            graf_public = ["storage/" + path for path in graf_public]
    except Exception:
        graf_public = [kinetics_plot_path, rgb_plot_path, bubble_plot_path]

    # Prepare a small data_point array (sampled to limit size)
    max_points = 2000
    step = max(1, int(len(time_data) / max_points))
    sampled = [{'t': float(t), 'intensity': float(i)} for t, i in zip(time_data[::step], concentration_proxy[::step])]

    result = {
        'hasil_analisis': (
            f"Orde terbaik: {best_order}. R^2 = {best_r2:.4f}. "
            f"Jumlah titik: {len(time_data)}. Durasi dianalisis: {float(time_data[-1]):.2f}s"
        ),
        'graf_files': [kinetics_plot_path, rgb_plot_path, bubble_plot_path],
        'graf_public': graf_public,
        'durasi': float(time_data[-1]),
        'akurasi': float(best_r2),
        'data_point': sampled,
        'interpretasi': (
            "Berdasarkan analisis intensitas grayscale, orde reaksi yang paling cocok adalah "
            f"{best_order} (nilai R^2 = {best_r2:.4f}). Periksa plot hasil untuk melihat kecocokan linear."),
        'rekomendasi': [
            'Periksa kualitas video (stabilitas pencahayaan, kontras).',
            'Jika nilai R^2 rendah, pertimbangkan preprocessing frame yang berbeda (normalisasi, cropping).',
            'Sesuaikan ambang deteksi gelembung atau gunakan metode deteksi yang lebih kompleks bila perlu.'
        ],
        'regression_results': regression_results,
        'half_life': {
            'zero': t_half_zero,
            'first': t_half_first,
            'second': t_half_second
        }
    }

    # Print JSON to stdout
    print(json.dumps(result, ensure_ascii=False))
    sys.exit(0)

if __name__ == '__main__':
    main()
