<div class="min-h-screen bg-slate-100 py-8">
  <div class="mx-auto max-w-4xl space-y-6">

    {{-- STEPPER (2 step) --}}
    <div id="stepper" class="bg-white rounded-2xl p-4 shadow flex items-center gap-4">
      <div class="flex items-center gap-3 w-full">
        <div data-step="1" class="flex items-center gap-3">
          <div class="step-circle w-9 h-9 rounded-full flex items-center justify-center bg-blue-600 text-white font-semibold">1</div>
          <div class="hidden sm:block">
            <div class="text-xs text-slate-500">Langkah 1</div>
            <div class="font-medium">Upload Video</div>
          </div>
        </div>

        <div class="h-0.5 flex-1 bg-slate-200 mx-3"></div>

        <div data-step="2" class="flex items-center gap-3">
          <div class="step-circle w-9 h-9 rounded-full flex items-center justify-center bg-slate-200 text-slate-600">2</div>
          <div class="hidden sm:block">
            <div class="text-xs text-slate-500">Langkah 2</div>
            <div class="font-medium">Parameter Kinetika</div>
          </div>
        </div>
      </div>
      <div class="ml-auto text-sm text-slate-500">Upload → Isi Parameter → Mulai</div>
    </div>

    {{-- STEP 1: UPLOAD --}}
    <div id="step1" class="rounded-2xl bg-blue-900 text-white shadow-md p-4">
      <div class="px-1">
        <h3 class="text-lg font-semibold">Langkah 1: Upload Video Reaksi</h3>
        <p class="text-sm text-white/80 mt-1">Upload video atau rekam langsung. Minimal durasi potong: 5 detik.</p>
      </div>

      <div id="dropZone" class="mt-4 rounded-xl border-2 border-dashed border-white/30 bg-blue-800/70 p-4 text-center cursor-pointer transition">

        <!-- wrapper video + canvas -->
        <div class="relative w-full max-w-2xl mx-auto">
          <video id="videoPreview" class="hidden w-full h-64 md:h-80 object-contain bg-black rounded-lg" controls></video>
          <canvas id="roiCanvas" class="absolute inset-0 hidden cursor-crosshair"></canvas>
        </div>

        <div id="uploadText" class="py-10 select-none">
          <svg class="w-12 h-12 mx-auto mb-3 text-white/95" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 0 1 0-8 5.5 5.5 0 0 1 10.6-1A4 4 0 0 1 17 16H7zm5-5v6m0-6l2.5 2.5M12 11l-2.5 2.5"/>
          </svg>
          <p class="text-lg font-semibold">Upload Video Reaksi Kimia</p>
          <p class="text-sm text-white/80">Drag & drop atau klik untuk memilih file</p>
          <p class="text-xs text-white/60">Format: MP4, MOV, AVI, WebM (Maks: 100MB)</p>
        </div>

        <input id="videoInput" type="file" accept="video/*" class="hidden" />
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

    {{-- STEP 2: PARAMETER KINETIKA --}}
    <div id="step2" class="rounded-2xl bg-white shadow-md p-4 hidden">
      <div class="px-1">
        <h3 class="font-semibold text-slate-800">Langkah 2: Parameter Kinetika</h3>
        <p class="text-sm text-slate-500 -mt-0.5">Isi parameter yang diperlukan untuk Analisis Kinetika</p>
      </div>

      <form action="{{ route('analisis.store') }}" method="POST" enctype="multipart/form-data" id="submitForm" class="p-4">
        @csrf
        {{-- canonical file input yang akan dikirim --}}
        <input type="file" name="video" id="realInputForSubmit" class="hidden" />
        <input type="hidden" name="trim_start" id="trimStartSubmit" value="0">
        <input type="hidden" name="trim_end" id="trimEndSubmit" value="0">
        <input type="hidden" name="analysis_type" id="analysisType" value="kinetika">
        <input type="hidden" name="roi_x" id="roiX" value="0">
        <input type="hidden" name="roi_y" id="roiY" value="0">
        <input type="hidden" name="roi_width" id="roiW" value="1">
        <input type="hidden" name="roi_height" id="roiH" value="1">

        {{-- PARAMS KINETIKA --}}
        <div class="params space-y-3" data-analysis="kinetika">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <label class="block">
              <div class="text-sm text-slate-600">Konsentrasi Awal (M) *</div>
              <input name="konsentrasi_awal" required type="number" step="any" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 0.1">
            </label>
            <label class="block">
              <div class="text-sm text-slate-600">pH *</div>
              <input name="ph" required type="number" step="any" min="0" max="14" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 7">
            </label>
            <label class="block">
              <div class="text-sm text-slate-600">Volume Total (mL) *</div>
              <input name="volume" required type="number" step="any" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 10">
            </label>
            <label class="block">
              <div class="text-sm text-slate-600">Pelarut *</div>
              <input name="pelarut" required type="text" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: Air">
            </label>
            <label class="block">
              <div class="text-sm text-slate-600">Laju Pengadukan (rpm) *</div>
              <input name="laju_pengadukan" required type="number" step="any" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: 150">
            </label>
            <label class="block">
              <div class="text-sm text-slate-600">Nama Reaksi *</div>
              <input name="nama_reaksi" required type="text" class="param-input mt-1 block w-full rounded border px-3 py-2" placeholder="Contoh: Traffic Light">
            </label>
          </div>
        </div>

        {{-- SUBMIT --}}
        <div class="mt-4">
          <button id="submitBtn" type="submit" class="w-full rounded-xl bg-blue-600 px-5 py-3 font-semibold text-white shadow hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
            Mulai Analisis
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Loading Overlay -->
<div id="loadingOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
    <svg class="animate-spin h-8 w-8 text-blue-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
    </svg>
    <p class="text-gray-700 font-semibold">Analisis sedang diproses...</p>
  </div>
</div>

{{-- JS --}}
<script>
  // helper
  const $ = id => document.getElementById(id);
  const fmt = s => {
    s = Math.max(0, Math.floor(s||0));
    const m = String(Math.floor(s/60)).padStart(2,'0');
    const ss = String(Math.floor(s%60)).padStart(2,'0');
    return `${m}:${ss}`;
  };

  // elements
  const step1 = $('step1'), step2 = $('step2');
  const dropZone = $('dropZone');
  const videoInput = $('videoInput'), realInputForSubmit = $('realInputForSubmit');
  const video = $('videoPreview'), uploadText = $('uploadText');
  const fileBar = $('fileBar'), fileName = $('fileName'), fileSize = $('fileSize');
  const controls = $('controls'), seekBar = $('seekBar'), curTime = $('curTime'), durTime = $('durTime');
  const back5 = $('back5'), fwd5 = $('fwd5'), playPause = $('playPause');
  const trimBox = $('trimBox'), startRange = $('startRange'), endRange = $('endRange');
  const startLabel = $('startLabel'), endLabel = $('endLabel'), trimLen = $('trimLen'), trimHint = $('trimHint');
  const trimStartSubmit = $('trimStartSubmit'), trimEndSubmit = $('trimEndSubmit');
  const analysisType = $('analysisType'), submitBtn = $('submitBtn'), submitForm = $('submitForm');

  const roiCanvas = $('roiCanvas');
  const roiCtx = roiCanvas.getContext('2d');
  const roiX = $('roiX'), roiY = $('roiY'), roiW = $('roiW'), roiH = $('roiH');

  const MAX_SIZE = 100*1024*1024, MIN_TRIM = 5;
  let videoReady = false;

  // stepper UI
  function setStepper(active) {
    document.querySelectorAll('#stepper [data-step]').forEach(el => {
      const stepNum = Number(el.getAttribute('data-step'));
      const circle = el.querySelector('.step-circle');
      if (!circle) return;
      if (stepNum < active) {
        circle.className = 'step-circle w-9 h-9 rounded-full flex items-center justify-center bg-emerald-500 text-white font-semibold';
      } else if (stepNum === active) {
        circle.className = 'step-circle w-9 h-9 rounded-full flex items-center justify-center bg-blue-600 text-white font-semibold';
      } else {
        circle.className = 'step-circle w-9 h-9 rounded-full flex items-center justify-center bg-slate-200 text-slate-600';
      }
    });
  }
  setStepper(1);

  // --- DropZone Handling (aktif sebelum upload, mati sesudah upload) ---
  function openFilePicker() { videoInput.click(); }
  function dragOver(e) { e.preventDefault(); dropZone.classList.add('bg-blue-700/70','border-white/70'); }
  function dragLeave(e) { e.preventDefault(); dropZone.classList.remove('bg-blue-700/70','border-white/70'); }
  function handleDrop(e) { e.preventDefault(); if (e.dataTransfer?.files?.length) handleFile(e.dataTransfer.files[0]); }

  function enableDropZone() {
    dropZone.addEventListener('click', openFilePicker);
    ['dragenter','dragover'].forEach(evt => dropZone.addEventListener(evt, dragOver));
    ['dragleave','drop'].forEach(evt => dropZone.addEventListener(evt, dragLeave));
    dropZone.addEventListener('drop', handleDrop);
  }

  function disableDropZone() {
    dropZone.removeEventListener('click', openFilePicker);
    ['dragenter','dragover'].forEach(evt => dropZone.removeEventListener(evt, dragOver));
    ['dragleave','drop'].forEach(evt => dropZone.removeEventListener(evt, dragLeave));
    dropZone.removeEventListener('drop', handleDrop);
  }

  // aktifkan dropzone di awal
  enableDropZone();
  videoInput.addEventListener('change', ()=>{ if (videoInput.files?.length) handleFile(videoInput.files[0]); });

  // copy file ke hidden input
  function copyFileToHiddenInput(file) {
    const dt = new DataTransfer();
    dt.items.add(file);
    realInputForSubmit.files = dt.files;
  }

  // handle file picked
  function handleFile(file){
    if (!file || !file.type.startsWith('video/')) { alert('❌ Harap upload file video.'); return; }
    if (file.size > MAX_SIZE) { alert('❌ Ukuran file melebihi 100 MB.'); return; }

    // setelah file dipilih → matikan dropzone supaya ROI tidak terganggu
    disableDropZone();

    // show file info
    fileName.textContent = file.name;
    fileSize.textContent = (file.size/(1024*1024)).toFixed(2) + ' MB';
    fileBar.classList.remove('hidden');

    // preview
    const url = URL.createObjectURL(file);
    video.src = url;
    video.classList.remove('hidden');
    uploadText.classList.add('hidden');

    controls.classList.remove('hidden');
    trimBox.classList.remove('hidden');
    roiCanvas.classList.remove('hidden');

    // copy file ke hidden input
    copyFileToHiddenInput(file);

    // reveal parameters step
    step2.classList.remove('hidden');
    setStepper(2);
  }

  // video metadata loaded
  video.addEventListener('loadedmetadata', ()=>{
    const d = Math.floor(video.duration || 0);
    if (!isFinite(d) || d === 0) return;
    if (d < MIN_TRIM) { alert('Durasi video kurang dari 5 detik. Harap gunakan video lain.'); resetAll(); return; }

    videoReady = true;
    seekBar.max = d;
    seekBar.value = 0;
    curTime.textContent = '00:00';
    durTime.textContent = fmt(d);

    startRange.min = 0; startRange.max = d; startRange.value = 0;
    endRange.min = 0; endRange.max = d; endRange.value = d;

    updateTrim();
    updateSubmitState();

    // resize canvas ROI biar pas dengan video
    roiCanvas.width = video.clientWidth;
    roiCanvas.height = video.clientHeight;
  });

  // --- ROI Selection ---
  let roi = null, isDrawing = false, startX = 0, startY = 0;

  roiCanvas.addEventListener('mousedown', (e)=>{
    isDrawing = true;
    const rect = roiCanvas.getBoundingClientRect();
    startX = e.clientX - rect.left;
    startY = e.clientY - rect.top;
  });

  roiCanvas.addEventListener('mousemove', (e)=>{
    if (!isDrawing) return;
    const rect = roiCanvas.getBoundingClientRect();
    const curX = e.clientX - rect.left;
    const curY = e.clientY - rect.top;
    const w = curX - startX, h = curY - startY;

    roiCtx.clearRect(0,0,roiCanvas.width,roiCanvas.height);
    roiCtx.strokeStyle = 'red';
    roiCtx.lineWidth = 2;
    roiCtx.strokeRect(startX, startY, w, h);
  });

  roiCanvas.addEventListener('mouseup', (e)=>{
    isDrawing = false;
    const rect = roiCanvas.getBoundingClientRect();
    const endX = e.clientX - rect.left;
    const endY = e.clientY - rect.top;
    roi = {
      x: Math.min(startX, endX),
      y: Math.min(startY, endY),
      w: Math.abs(endX - startX),
      h: Math.abs(endY - startY)
    };
    roiCtx.clearRect(0,0,roiCanvas.width,roiCanvas.height);
    roiCtx.strokeStyle = 'lime';
    roiCtx.lineWidth = 2;
    roiCtx.strokeRect(roi.x, roi.y, roi.w, roi.h);

    // isi hidden input untuk submit
    roiX.value = roi.x; roiY.value = roi.y;
    roiW.value = roi.w; roiH.value = roi.h;
    updateSubmitState();
  });

  // player controls
  video.addEventListener('timeupdate', ()=> { seekBar.value = video.currentTime; curTime.textContent = fmt(video.currentTime); });
  seekBar.addEventListener('input', ()=> video.currentTime = Number(seekBar.value));
  back5.addEventListener('click', ()=> video.currentTime = Math.max(0, video.currentTime - 5));
  fwd5.addEventListener('click', ()=> video.currentTime = Math.min(video.duration, video.currentTime + 5));
  playPause.addEventListener('click', ()=> { if (video.paused) { video.play(); playPause.textContent = '⏸'; } else { video.pause(); playPause.textContent = '▶'; } });

  // trim handlers
  startRange.addEventListener('input', ()=> { if (Number(startRange.value) > Number(endRange.value)) endRange.value = startRange.value; updateTrim(); });
  endRange.addEventListener('input', ()=> { if (Number(endRange.value) < Number(startRange.value)) startRange.value = endRange.value; updateTrim(); });

  function updateTrim(){
    const s = Math.floor(Number(startRange.value));
    const e = Math.floor(Number(endRange.value));
    const len = Math.max(0, e - s);

    startLabel.textContent = fmt(s);
    endLabel.textContent = fmt(e);
    trimLen.textContent = fmt(len);

    const ok = len >= MIN_TRIM;
    trimStartSubmit.value = s;
    trimEndSubmit.value = e;
    trimHint.textContent = ok ? 'Siap dipotong.' : 'Minimal durasi potongan adalah 5 detik.';
    trimHint.className = 'mt-2 text-xs ' + (ok ? 'text-emerald-200' : 'text-amber-200/90');

    updateSubmitState();
  }

  // validation parameter inputs
  function paramsValid() {
    const form = document.querySelector('.params[data-analysis="kinetika"]');
    if (!form) return false;
    const inputs = form.querySelectorAll('.param-input[required]');
    for (let i=0;i<inputs.length;i++) {
      const v = inputs[i].value;
      if (typeof v === 'undefined' || String(v).trim() === '') return false;
      if (inputs[i].type === 'number') {
        const n = parseFloat(v);
        if (!isFinite(n)) return false;
      }
    }
    return true;
  }

  // update submit button enabled state
  function updateSubmitState(){
    const hasFile = realInputForSubmit.files?.length > 0;
    const trimOK = (Number(trimEndSubmit.value) - Number(trimStartSubmit.value)) >= MIN_TRIM;
    const hasAnalysis = analysisType.value === 'kinetika';
    const pValid = paramsValid();
    const roiOK = (Number(roiW.value) > 0 && Number(roiH.value) > 0);

    submitBtn.disabled = !(hasFile && videoReady && trimOK && hasAnalysis && pValid && roiOK);
  }

  // reset UI
  function resetAll(){
    try { video.pause(); } catch(e){}
    try { URL.revokeObjectURL(video.src); } catch(e){}
    video.src = '';
    video.classList.add('hidden');
    uploadText.classList.remove('hidden');
    fileBar.classList.add('hidden');
    controls.classList.add('hidden');
    trimBox.classList.add('hidden');
    roiCanvas.classList.add('hidden');
    videoReady = false;
    videoInput.value = '';
    realInputForSubmit.value = '';
    step2.classList.add('hidden');
    setStepper(1);
    roiCtx.clearRect(0,0,roiCanvas.width,roiCanvas.height);
    roiX.value = roiY.value = roiW.value = roiH.value = '';
    enableDropZone();
    updateSubmitState();
  }
  window.resetAll = resetAll;

  // copy file just before submit (safety)
  submitForm.addEventListener('submit', (e) => {
    const f = videoInput.files?.[0];
    if (f && (!realInputForSubmit.files || realInputForSubmit.files.length === 0)) {
      copyFileToHiddenInput(f);
    }
    updateSubmitState();

    if (submitBtn.disabled) {
      e.preventDefault();
      alert('Lengkapi semua langkah, pilih ROI, dan isi parameter sebelum memulai analisis.');
    }
    // Tampilkan loading overlay & disable tombol
    document.getElementById('loadingOverlay').classList.remove('hidden');
    submitBtn.disabled = true;
    submitBtn.textContent = "⏳ Sedang menganalisis...";
  });

  // attach listeners to parameter inputs
  document.querySelectorAll('.param-input').forEach(inp => inp.addEventListener('input', updateSubmitState));
</script>
