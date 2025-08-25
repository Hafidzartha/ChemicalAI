<div class="max-w-5xl mx-auto space-y-6 p-6">

    <!-- Langkah 1: Preview Video -->
    <div class="bg-blue-900 text-white rounded-lg shadow-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Langkah 1: Upload Video Reaksi</h2>

        <!-- Video Player -->
        <div class="w-full aspect-video bg-black rounded-lg overflow-hidden">
            <video id="uploadedVideo" controls class="w-full h-full">
                <source src="{{ asset('storage/videos/' . $videoFileName) }}" type="video/mp4">
                Browser Anda tidak mendukung pemutar video.
            </video>
        </div>

        <!-- Info Video -->
        <div class="flex items-center justify-between mt-3">
            <div>
                <p class="font-medium">{{ $videoFileName }}</p>
                <p class="text-sm text-gray-300">Video berhasil diunggah</p>
            </div>
            <div class="text-sm">{{ number_format($videoFileSize / 1048576, 2) }} MB</div>
        </div>

        <!-- Kontrol Video -->
        <div class="flex items-center justify-center space-x-4 mt-4">
            <button id="rewindBtn" class="p-2 bg-gray-700 rounded-full hover:bg-gray-600">
                ⏪
            </button>
            <button id="playPauseBtn" class="p-4 bg-yellow-500 rounded-full hover:bg-yellow-400 text-black">
                ▶️
            </button>
            <button id="forwardBtn" class="p-2 bg-gray-700 rounded-full hover:bg-gray-600">
                ⏩
            </button>
        </div>

        <!-- Trim Selection -->
        <div class="mt-6">
            <h3 class="text-sm font-semibold mb-2">Trim Selection</h3>
            <div class="flex items-center space-x-4">
                <div>
                    <label class="block text-xs mb-1">Start Time</label>
                    <input type="text" id="startTime" class="w-20 p-1 rounded text-black" value="00:00">
                </div>
                <div>
                    <label class="block text-xs mb-1">End Time</label>
                    <input type="text" id="endTime" class="w-20 p-1 rounded text-black" value="00:00">
                </div>
                <div>
                    <label class="block text-xs mb-1">Duration</label>
                    <span id="duration" class="text-sm">0:00</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Langkah 2: Pilih Jenis Analisis -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Langkah 2: Pilih Jenis Analisis</h2>
        <p class="text-sm text-gray-600 mb-4">Tentukan jenis analisis yang ingin dilakukan sesuai menit/detik video yang dipilih.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Analisis Statistik -->
            <label class="block border rounded-lg p-4 cursor-pointer hover:border-indigo-500">
                <input type="checkbox" name="analysis[]" value="statistik" class="hidden">
                <h3 class="font-semibold mb-1">Analisis Statistik</h3>
                <p class="text-xs text-gray-500">Menampilkan hasil perhitungan statistik dari video</p>
            </label>

            <!-- Pengukuran Intensitas -->
            <label class="block border rounded-lg p-4 cursor-pointer hover:border-indigo-500">
                <input type="checkbox" name="analysis[]" value="intensitas" class="hidden">
                <h3 class="font-semibold mb-1">Pengukuran Intensitas</h3>
                <p class="text-xs text-gray-500">Menganalisis perubahan intensitas warna atau cahaya</p>
            </label>

            <!-- Analisis Objek -->
            <label class="block border rounded-lg p-4 cursor-pointer hover:border-indigo-500">
                <input type="checkbox" name="analysis[]" value="objek" class="hidden">
                <h3 class="font-semibold mb-1">Analisis Objek</h3>
                <p class="text-xs text-gray-500">Mendeteksi dan melacak objek tertentu di dalam video</p>
            </label>
        </div>

        <!-- Tombol Submit -->
        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                Lanjutkan Analisis
            </button>
        </div>
    </div>
</div>

<script>
    const video = document.getElementById('uploadedVideo');
    const playPauseBtn = document.getElementById('playPauseBtn');
    const rewindBtn = document.getElementById('rewindBtn');
    const forwardBtn = document.getElementById('forwardBtn');
    const startTimeInput = document.getElementById('startTime');
    const endTimeInput = document.getElementById('endTime');
    const durationDisplay = document.getElementById('duration');

    // Play / Pause
    playPauseBtn.addEventListener('click', () => {
        if (video.paused) {
            video.play();
            playPauseBtn.textContent = '⏸';
        } else {
            video.pause();
            playPauseBtn.textContent = '▶️';
        }
    });

    // Rewind 5 detik
    rewindBtn.addEventListener('click', () => {
        video.currentTime = Math.max(video.currentTime - 5, 0);
    });

    // Forward 5 detik
    forwardBtn.addEventListener('click', () => {
        video.currentTime = Math.min(video.currentTime + 5, video.duration);
    });

    // Update End Time dan Duration otomatis saat video berjalan
    video.addEventListener('timeupdate', () => {
        endTimeInput.value = formatTime(video.currentTime);
        updateDuration();
    });

    // Fungsi format waktu mm:ss
    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
    }

    // Update durasi
    function updateDuration() {
        const start = parseTime(startTimeInput.value);
        const end = parseTime(endTimeInput.value);
        const diff = Math.max(end - start, 0);
        durationDisplay.textContent = formatTime(diff);
    }

    // Konversi mm:ss ke detik
    function parseTime(timeStr) {
        const [min, sec] = timeStr.split(':').map(Number);
        return min * 60 + sec;
    }
</script>
