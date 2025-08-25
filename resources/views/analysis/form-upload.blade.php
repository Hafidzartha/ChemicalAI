<!-- resources/views/video-upload.blade.php (potongan utama) -->
<div class="min-h-screen bg-slate-100 py-8">
  <div class="mx-auto max-w-4xl space-y-6">

    <!-- STEP: STEPPER -->
    <div id="stepper" class="bg-white rounded-2xl p-4 shadow flex items-center gap-4">
      <div class="flex items-center gap-3">
        <div data-step="1" class="step-item flex items-center gap-3">
          <div class="step-circle w-9 h-9 rounded-full flex items-center justify-center bg-blue-600 text-white font-semibold">1</div>
          <div class="hidden sm:block">
            <div class="text-xs text-slate-500">Langkah 1</div>
            <div class="font-medium">Upload Video</div>
          </div>
        </div>
        <div class="h-0.5 w-12 bg-slate-200"></div>
        <div data-step="2" class="step-item flex items-center gap-3">
          <div class="step-circle w-9 h-9 rounded-full flex items-center justify-center bg-slate-200 text-slate-600">2</div>
          <div class="hidden sm:block">
            <div class="text-xs text-slate-500">Langkah 2</div>
            <div class="font-medium">Pilih Analisis</div>
          </div>
        </div>
        <div class="h-0.5 w-12 bg-slate-200"></div>
        <div data-step="3" class="step-item flex items-center gap-3">
          <div class="step-circle w-9 h-9 rounded-full flex items-center justify-center bg-slate-200 text-slate-600">3</div>
          <div class="hidden sm:block">
            <div class="text-xs text-slate-500">Langkah 3</div>
            <div class="font-medium">Parameter</div>
          </div>
        </div>
      </div>
      <div class="ml-auto text-sm text-slate-500">Ikuti alur: Upload → Pilih → Isi parameter → Mulai</div>
    </div>

    <!-- LANGKAH 1 -->
    <div id="step1" class="rounded-2xl bg-blue-900 text-white shadow-md p-4">
      <div class="px-1">
        <h3 class="text-lg font-semibold">Langkah 1: Upload Video Reaksi</h3>
        <p class="text-sm text-white/80 mt-1">Upload video atau rekam langsung. Minimal durasi hasil trim: 5 detik.</p>
      </div>

      <div id="dropZone" class="mt-4 rounded-xl border-2 border-dashed border-white/30 bg-blue-800/70 p-4 text-center cursor-pointer transition">
        <video id="videoPreview" class="hidden w-full max-w-2xl h-64 md:h-80 object-contain bg-black rounded-lg mx-auto"
               controls></video>

        <div id="uploadText" class="py-10 select-none">
          <svg class="w-12 h-12 mx-auto mb-3 text-white/95" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M7 16a4 4 0 0 1 0-8 5.5 5.5 0 0 1 10.6-1A4 4 0 0 1 17 16H7zm5-5v6m0-6l2.5 2.5M12 11l-2.5 2.5"/>
          </svg>
          <p class="text-lg font-semibold">Upload Video Reaksi Kimia</p>
          <p class="text-sm text-white/80">Drag & drop atau klik untuk memilih file</p>
          <p class="text-xs text-white/60">Format: MP4, MOV, AVI, WebM (Maks: 100MB)</p>
        </div>
        <input id="videoInput" type="file" name="video_upload_tmp" accept="video/*" class="hidden" />
      </div>

      <div id="fileBar" class="hidden mt-3 flex items-center justify-between gap-3 rounded-lg bg-blue-900/60 px-3 py-2 text-sm">
        <div class="truncate flex items-center gap-2">
          <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-emerald-500 text-blue-900 font-bold">✓</span>
          <span id="fileName" class="truncate">-</span>
        </div>
        <span id="fileSize" class="shrink-0 text-white/70">0 MB</span>
      </div>

      <div id="controls" class="hidden mt-3 rounded-lg bg-blue-900/60 p-3">
        <div class="flex items-center gap-3">
          <span id="curTime" class="text-xs tabular-nums">00:00</span>
          <input id="seekBar" type="range" value="0" min="0" max="100" step="0.01" class="w-full accent-white/90">
          <span id="durTime" class="text-xs tabular-nums">00:00</span>
        </div>
        <div class="mt-2 flex justify-center gap-3">
          <button type="button" id="back5" class="rounded-full bg-blue-700 px-3 py-2 hover:bg-blue-600">⏪ 5s</button>
          <button type="button" id="playPause" class="rounded-full bg-amber-500 text-blue-900 px-4 py-2 font-semibold hover:bg-amber-400">▶</button>
          <button type="button" id="fwd5" class="rounded-full bg-blue-700 px-3 py-2 hover:bg-blue-600">5s ⏩</button>
        </div>
      </div>

      <div id="trimBox" class="hidden mt-3 rounded-lg bg-blue-900/60 p-3 text-left">
        <div class="flex items-center justify-between">
          <div class="font-medium">✂ Trim Selection</div>
          <div class="text-sm">Duration: <span id="trimLen" class="tabular-nums">00:00</span></div>
        </div>

        <div class="mt-2 grid grid-cols-2 gap-4 text-sm">
          <div>
            <label class="block text-white/80">Start Time</label>
            <div class="flex items-center gap-2">
              <span id="startLabel" class="w-12 tabular-nums">00:00</span>
              <input id="startRange" type="range" min="0" max="0" step="0.01" value="0" class="w-full accent-white/90">
            </div>
          </div>
          <div>
            <label class="block text-white/80">End Time</label>
            <div class="flex items-center gap-2">
              <span id="endLabel" class="w-12 tabular-nums">00:00</span>
              <input id="endRange" type="range" min="0" max="0" step="0.01" value="0" class="w-full accent-white/90">
            </div>
          </div>
        </div>

        <p id="trimHint" class="mt-2 text-xs text-amber-200/90">Minimal durasi potongan adalah 5 detik.</p>
      </div>
    </div>

    <!-- LANGKAH 2 -->
    <div id="step2" class="rounded-2xl bg-white shadow-md p-4 hidden">
      <div class="px-1">
        <h3 class="font-semibold text-slate-800">Langkah 2: Pilih Jenis Analisis</h3>
        <p class="text-sm text-slate-500 -mt-0.5">Tentukan jenis analisis yang ingin dilakukan</p>
      </div>

      <div class="p-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
        @php
          $opts = [
            ['id'=>'kinetika','title'=>'Analisis Kinetika','desc'=>'Penentuan laju reaksi & orde reaksi.'],
            ['id'=>'absorbansi','title'=>'Pengukuran Absorbansi','desc'=>'Analisis absorbansi (Hukum Lambert-Beer).'],
            ['id'=>'oksidasi','title'=>'Analisis Oksidasi','desc'=>'Analisis model cerdas (CNN/LSTM).'],
            ['id'=>'redoks','title'=>'Analisis Redoks','desc'=>'Penentuan oksidator dan reduktor.'],
          ];
        @endphp
        @foreach($opts as $o)
        <button type="button"
                data-analysis="{{ $o['id'] }}"
                class="analysis-btn group rounded-xl border border-slate-200 bg-white px-4 py-3 text-left hover:border-blue-400 hover:shadow transition">
          <div class="flex items-start gap-3">
            <div class="mt-1 rounded-xl bg-blue-50 p-2 group-[.active]:bg-blue-600">📊</div>
            <div>
              <div class="font-medium text-slate-800 group-[.active]:text-blue-700">{{ $o['title'] }}</div>
              <div class="text-sm text-slate-500">{{ $o['desc'] }}</div>
            </div>
          </div>
        </button>
        @endforeach
      </div>
    </div>

    <!-- LANGKAH 3 -->
    <div id="step3" class="rounded-2xl bg-white shadow-md p-4 hidden">
      <div class="px-1">
        <h3 class="font-semibold text-slate-800">Langkah 3: Parameter Reaksi</h3>
        <p class="text-sm text-slate-500 -mt-0.5">Masukkan parameter reaksi untuk analisis yang dipilih</p>
      </div>

      <form action="{{ route('page.hasil_analisis') }}" method="POST" enctype="multipart/form-data" id="submitForm" class="p-4">
        @csrf
        <!-- Hidden canonical file inputs -->
        <input type="file" name="video" id="realInputForSubmit" class="hidden" />
        <input type="hidden" name="trim_start" id="trimStartSubmit" value="0">
        <input type="hidden" name="trim_end" id="trimEndSubmit" value="0">
        <input type="hidden" name="analysis_type" id="analysisType" required>

        <!-- PARAMS KINETIKA -->
        <div class="params hidden space-y-3" data-analysis="kinetika">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <label class="block">
              <div class="text-sm text-slate-600">Konsentrasi Awal (M) *</div>
              <input name="konc_awal" required type="number" step="any" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 0.1">
            </label>
            <label class="block">
              <div class="text-sm text-slate-600">Orde Reaksi</div>
              <input name="ordre" type="text" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 1 atau 'fit'">
            </label>
            <label class="block">
              <div class="text-sm text-slate-600">Suhu (°C)</div>
              <input name="suhu" type="number" step="any" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 25">
            </label>
            <label class="block">
              <div class="text-sm text-slate-600">pH</div>
              <input name="ph" type="number" step="any" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 7">
            </label>
            <label class="block">
              <div class="text-sm text-slate-600">Volume Total (mL)</div>
              <input name="volume_ml" type="number" step="any" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 10">
            </label>
            <label class="block">
              <div class="text-sm text-slate-600">Nama Reaksi</div>
              <input name="nama_reaksi" type="text" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: Traffic Light">
            </label>
          </div>
        </div>

        <!-- PARAMS ABSORBANSI -->
        <div class="params hidden space-y-3" data-analysis="absorbansi">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <label>
              <div class="text-sm text-slate-600">Panjang Gelombang (nm) *</div>
              <input name="panjang_gelombang_nm" required type="number" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 420">
            </label>
            <label>
              <div class="text-sm text-slate-600">Path Length (cm)</div>
              <input name="path_length_cm" type="number" step="any" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 1">
            </label>
            <label>
              <div class="text-sm text-slate-600">Volume Total (mL)</div>
              <input name="volume_ml" type="number" step="any" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 3">
            </label>
            <label>
              <div class="text-sm text-slate-600">Nama Reaksi</div>
              <input name="nama_reaksi" type="text" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: Reaksi A">
            </label>
          </div>
        </div>

        <!-- PARAMS OKSIDASI -->
        <div class="params hidden space-y-3" data-analysis="oksidasi">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <label>
              <div class="text-sm text-slate-600">Suhu (°C)</div>
              <input name="suhu" type="number" step="any" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 25">
            </label>
            <label>
              <div class="text-sm text-slate-600">Laju Pengadukan (rpm)</div>
              <input name="laju_pengadukan_rpm" type="number" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 150">
            </label>
            <label>
              <div class="text-sm text-slate-600">Metode/Model</div>
              <select name="metode_model" class="param-input mt-1 block w-full rounded border px-3 py-2">
                <option value="">-- Pilih --</option>
                <option value="cnn-lstm">CNN-LSTM</option>
                <option value="resnet">ResNet</option>
              </select>
            </label>
            <label>
              <div class="text-sm text-slate-600">Nama Reaksi</div>
              <input name="nama_reaksi" type="text" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: Oksidasi X">
            </label>
          </div>
        </div>

        <!-- PARAMS REDOKS -->
        <div class="params hidden space-y-3" data-analysis="redoks">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <label>
              <div class="text-sm text-slate-600">Konsentrasi Reaktan (M) *</div>
              <input name="konc_reaktan" required type="number" step="any" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 0.05">
            </label>
            <label>
              <div class="text-sm text-slate-600">pH</div>
              <input name="ph" type="number" step="any" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 7">
            </label>
            <label>
              <div class="text-sm text-slate-600">Indikator</div>
              <input name="indikator" type="text" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: Fenolftalein">
            </label>
            <label>
              <div class="text-sm text-slate-600">Nama Reaksi</div>
              <input name="nama_reaksi" type="text" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: Redoks Y">
            </label>
          </div>
        </div>

        <!-- BUTTON SUBMIT -->
        <div class="mt-4">
          <button id="submitBtn" type="submit" class="w-full rounded-xl bg-blue-600 px-5 py-3 font-semibold text-white shadow hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
            Mulai Analisis
          </button>
        </div>
      </form>
    </div>

  </div>
</div>

<!-- Paste juga script JS (letakkan sebelum </body>) -->
<script>
  // --- (Re-use earlier script logic) ---
  // Untuk ringkas: script ini meng-handle:
  // - upload/preview/trim (sama seperti implementasimu sebelumnya),
  // - menampilkan step2 setelah upload valid,
  // - menampilkan step3 dan parameter sesuai analysis_type,
  // - update stepper UI (warna step aktif/complete),
  // - memvalidasi parameter wajib dan enable/disable submit.

  const $ = id => document.getElementById(id);
  const fmt = s => {
    s = Math.max(0, Math.floor(s||0));
    const m = String(Math.floor(s/60)).padStart(2,'0');
    const ss = String(Math.floor(s%60)).padStart(2,'0');
    return `${m}:${ss}`;
  };

  // elements
  const step1 = $('step1'), step2 = $('step2'), step3 = $('step3');
  const videoInput = $('videoInput'), realInputForSubmit = $('realInputForSubmit');
  const video = $('videoPreview'), uploadText = $('uploadText');
  const fileBar = $('fileBar'), fileName = $('fileName'), fileSize = $('fileSize');
  const controls = $('controls'), seekBar = $('seekBar'), curTime = $('curTime'), durTime = $('durTime');
  const back5 = $('back5'), fwd5 = $('fwd5'), playPause = $('playPause');
  const trimBox = $('trimBox'), startRange = $('startRange'), endRange = $('endRange');
  const startLabel = $('startLabel'), endLabel = $('endLabel'), trimLen = $('trimLen'), trimHint = $('trimHint');
  const trimStartSubmit = $('trimStartSubmit'), trimEndSubmit = $('trimEndSubmit');
  const analysisType = $('analysisType'), submitBtn = $('submitBtn');
  const submitForm = $('submitForm');

  const MAX_SIZE = 100*1024*1024, MIN_TRIM = 5;
  let videoReady = false;

  // stepper helpers
  function setStepper(active) {
    document.querySelectorAll('#stepper [data-step]').forEach(el => {
      const stepNum = Number(el.getAttribute('data-step'));
      const circle = el.querySelector('.step-circle');
      if (!circle) return;
      if (stepNum < active) {
        // completed
        circle.className = 'step-circle w-9 h-9 rounded-full flex items-center justify-center bg-emerald-500 text-white font-semibold';
      } else if (stepNum === active) {
        circle.className = 'step-circle w-9 h-9 rounded-full flex items-center justify-center bg-blue-600 text-white font-semibold';
      } else {
        circle.className = 'step-circle w-9 h-9 rounded-full flex items-center justify-center bg-slate-200 text-slate-600';
      }
    });
  }
  setStepper(1);

  // file handling
  document.querySelector('#dropZone').addEventListener('click', ()=> videoInput.click());
  ['dragenter','dragover'].forEach(e=> document.querySelector('#dropZone').addEventListener(e, ev=>{ ev.preventDefault(); ev.currentTarget.classList.add('bg-blue-700/70'); }));
  ['dragleave','drop'].forEach(e=> document.querySelector('#dropZone').addEventListener(e, ev=>{ ev.preventDefault(); ev.currentTarget.classList.remove('bg-blue-700/70'); }));
  document.querySelector('#dropZone').addEventListener('drop', ev=> {
    ev.preventDefault();
    if (ev.dataTransfer?.files?.length) handleFile(ev.dataTransfer.files[0]);
  });
  videoInput.addEventListener('change', ()=> { if (videoInput.files?.length) handleFile(videoInput.files[0]); });

  function copyFileToHiddenInput(file) {
    const dt = new DataTransfer();
    dt.items.add(file);
    realInputForSubmit.files = dt.files;
  }

  function handleFile(file) {
    if (!file || !file.type.startsWith('video/')) { alert('Harap upload file video'); return; }
    if (file.size > MAX_SIZE) { alert('Ukuran file melebihi 100MB'); return; }

    fileName.textContent = file.name;
    fileSize.textContent = (file.size/(1024*1024)).toFixed(2) + ' MB';
    fileBar.classList.remove('hidden');

    const url = URL.createObjectURL(file);
    video.src = url; video.classList.remove('hidden'); uploadText.classList.add('hidden');
    controls.classList.remove('hidden'); trimBox.classList.remove('hidden');
    copyFileToHiddenInput(file);

    // show step2
    step2.classList.remove('hidden');
    setStepper(2);
  }

  video.addEventListener('loadedmetadata', ()=>{
    const d = Math.floor(video.duration || 0);
    if (!isFinite(d) || d===0) return;
    if (d < MIN_TRIM) { alert('Durasi video kurang dari 5 detik.'); resetAll(); return; }
    videoReady = true;
    seekBar.max = d; seekBar.value = 0;
    curTime.textContent = '00:00'; durTime.textContent = fmt(d);
    startRange.min = 0; startRange.max = d; startRange.value = 0;
    endRange.min = 0; endRange.max = d; endRange.value = d;
    updateTrim();
    updateSubmitState();
  });

  video.addEventListener('timeupdate', ()=> { seekBar.value = video.currentTime; curTime.textContent = fmt(video.currentTime); });
  seekBar.addEventListener('input', ()=> video.currentTime = Number(seekBar.value));
  back5.addEventListener('click', ()=> video.currentTime = Math.max(0, video.currentTime-5));
  fwd5.addEventListener('click', ()=> video.currentTime = Math.min(video.duration, video.currentTime+5));
  playPause.addEventListener('click', ()=> { if (video.paused) { video.play(); playPause.textContent='⏸'; } else { video.pause(); playPause.textContent='▶'; } });

  startRange.addEventListener('input', ()=> { if (Number(startRange.value) > Number(endRange.value)) endRange.value = startRange.value; updateTrim(); });
  endRange.addEventListener('input', ()=> { if (Number(endRange.value) < Number(startRange.value)) startRange.value = endRange.value; updateTrim(); });

  function updateTrim(){
    const s = Math.floor(Number(startRange.value)), e = Math.floor(Number(endRange.value)), len = Math.max(0,e-s);
    startLabel.textContent = fmt(s); endLabel.textContent = fmt(e); trimLen.textContent = fmt(len);
    const ok = len >= MIN_TRIM;
    trimHint.textContent = ok ? 'Siap dipotong.' : 'Minimal durasi potongan adalah 5 detik.';
    trimhintClass(ok);
    trimStartSubmit.value = s; trimEndSubmit.value = e;
    updateSubmitState();
  }
  function trimhintClass(ok) { trimHint.className = 'mt-2 text-xs ' + (ok ? 'text-emerald-200' : 'text-amber-200/90'); }

  // analysis selection & show params
  document.querySelectorAll('.analysis-btn').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      document.querySelectorAll('.analysis-btn').forEach(b=>b.classList.remove('active','border-blue-500','ring','ring-blue-100'));
      btn.classList.add('active','border-blue-500','ring','ring-blue-100');
      const key = btn.dataset.analysis;
      $('analysisType').value = key;
      document.querySelectorAll('.params').forEach(p=>p.classList.add('hidden'));
      const show = document.querySelector('.params[data-analysis="'+key+'"]');
      if (show) show.classList.remove('hidden');
      // reveal step3
      step3.classList.remove('hidden');
      setStepper(3);
      // attach param listeners
      document.querySelectorAll('.params[data-analysis="'+key+'"] .param-input').forEach(inp=> inp.addEventListener('input', updateSubmitState));
      updateSubmitState();
    });
  });

  function paramsValid() {
    const key = $('analysisType').value;
    if (!key) return false;
    const form = document.querySelector('.params[data-analysis="'+key+'"]');
    if (!form) return false;
    const inputs = form.querySelectorAll('.param-input[required]');
    for (let i=0;i<inputs.length;i++) {
      const v = inputs[i].value;
      if (typeof v === 'undefined' || String(v).trim()==='') return false;
      if (inputs[i].type==='number') {
        const n = parseFloat(v); if (!isFinite(n)) return false;
      }
    }
    return true;
  }

  function updateSubmitState(){
    const hasFile = realInputForSubmit.files?.length > 0;
    const trimOK = (Number(trimEndSubmit.value) - Number(trimStartSubmit.value)) >= MIN_TRIM;
    const hasAnalysis = !!$('analysisType').value;
    const pValid = paramsValid();
    submitBtn.disabled = !(hasFile && videoReady && trimOK && hasAnalysis && pValid);
  }

  function resetAll(){
    try { video.pause(); } catch(e){}
    try { URL.revokeObjectURL(video.src); } catch(e){}
    video.src=''; video.classList.add('hidden'); uploadText.classList.remove('hidden');
    fileBar.classList.add('hidden'); controls.classList.add('hidden'); trimBox.classList.add('hidden');
    videoReady=false; videoInput.value=''; realInputForSubmit.value='';
    step2.classList.add('hidden'); step3.classList.add('hidden'); $('analysisType').value='';
    document.querySelectorAll('.analysis-btn').forEach(b=>b.classList.remove('active'));
    setStepper(1);
    updateSubmitState();
  }
  window.resetAll = resetAll;

  // ensure submit copies the file if needed
  submitForm.addEventListener('submit', (e)=> {
    const f = videoInput.files?.[0];
    if (f) {
      const dt = new DataTransfer(); dt.items.add(f); realInputForSubmit.files = dt.files;
    }
    updateSubmitState();
    if (submitBtn.disabled) { e.preventDefault(); alert('Lengkapi semua langkah dan parameter sebelum memulai analisis.'); }
  });

  // expose some globals for template usage
  window.startCamera = async function(){
    try {
      const stream = await navigator.mediaDevices.getUserMedia({ video:true, audio:true });
      video.srcObject = stream; video.classList.remove('hidden'); uploadText.classList.add('hidden'); controls.classList.remove('hidden');
      const mediaRecorder = new MediaRecorder(stream); let chunks=[];
      mediaRecorder.ondataavailable = e => chunks.push(e.data);
      mediaRecorder.onstop = () => {
        const blob = new Blob(chunks, { type:'video/webm' }); const recordedFile = new File([blob],'recorded.webm',{ type: blob.type });
        chunks=[]; stream.getTracks().forEach(t=>t.stop());
        const dt = new DataTransfer(); dt.items.add(recordedFile); videoInput.files = dt.files;
        handleFile(recordedFile);
        video.srcObject = null; video.src = URL.createObjectURL(blob); video.play().catch(()=>{});
      };
      mediaRecorder.start();
      setTimeout(()=>{ if (mediaRecorder.state !== 'inactive') mediaRecorder.stop(); }, 5000);
    } catch(err){ alert('Tidak dapat mengakses kamera: ' + err); }
  };
</script>
