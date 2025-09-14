<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4">
        <h2 class="text-2xl font-bold mb-6">Riwayat Analisis Anda</h2>

        @if($analyses->isEmpty())
            <div class="text-gray-500">Belum ada analisis yang pernah dilakukan.</div>
        @else
            <div class="grid gap-4">
                @foreach($analyses as $analysis)
                    <div x-data="analysisProgress({{ $analysis->id }}, '{{ $analysis->status }}')"
                         class="p-4 border rounded-lg shadow-sm bg-white hover:shadow-md transition">

                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold">
                                    {{ $analysis->judul ?? 'Analisis #' . $analysis->id }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ $analysis->created_at->format('d M Y H:i') }}
                                </p>
                                <div class="mt-2 text-sm text-gray-700">
                                    Hasil Analisis: <span class="font-medium">{{ $analysis->hasil_analisis ?? '-' }}</span> |
                                    Akurasi: <span class="font-medium">{{ $analysis->akurasi ?? '-' }}%</span> |
                                    Durasi: <span class="font-medium">{{ $analysis->durasi ?? '-' }} detik</span>
                                </div>
                            </div>
                            <a href="{{ route('analisis.result', $analysis->id) }}"
                               class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition">
                                Lihat Detail
                            </a>
                        </div>

                        {{-- Progress bar jika status = processing --}}
                        <template x-if="status === 'processing'">
                            <div class="mt-4">
                                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                    <div class="bg-blue-600 h-3 rounded-full animate-pulse"
                                         :style="`width: ${progress}%`"></div>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">Sedang diproses... <span x-text="progress + '%'"></span></p>
                            </div>
                        </template>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $analyses->links() }}
            </div>
        @endif
    </div>
</x-app-layout>