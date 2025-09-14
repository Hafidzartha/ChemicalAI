<!-- resources/views/form-analisis.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
  <h2 class="text-lg font-semibold mb-4">Analisis sedang berjalan</h2>

  <div class="bg-white rounded p-4 shadow">
    <p>Mode: <strong>{{ $analisis->analisis_mode }}</strong></p>
    <p>Video: <strong>{{ $analisis->video_path }}</strong></p>
    <div class="mt-4">
      <div class="w-full bg-slate-100 rounded h-4 overflow-hidden">
        <div id="progressBar" class="h-4 bg-blue-600" style="width:0%"></div>
      </div>
      <div class="mt-2 text-sm text-slate-500">Progress: <span id="pct">0</span>%</div>
    </div>
  </div>
</div>

<script>
  const analysisId = "{{ $analisis->id }}";
  const pollUrl = "{{ route('analisis.status', ['id'=>$analisis->id]) }}";

  function updateUI(pct, status) {
    document.getElementById('progressBar').style.width = pct + '%';
    document.getElementById('pct').textContent = pct;
  }

  async function poll() {
    try {
      const res = await fetch(pollUrl);
      const data = await res.json();
      updateUI(data.progress, data.status);
      if (data.status === 'done' || data.progress >= 100) {
        // redirect to result page
        window.location.href = "{{ url('/analisis/result') }}/" + analysisId;
      } else if (data.status === 'failed') {
        alert('Analisis gagal. Silakan periksa log server.');
      } else {
        setTimeout(poll, 2000);
      }
    } catch (err) {
      console.error(err);
      setTimeout(poll, 3000);
    }
  }
  poll();
</script>
@endsection
