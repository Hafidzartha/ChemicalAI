<x-app-layout>
    <div class="py-16 px-4 sm:px-6 lg:px-8 text-center max-w-7xl mx-auto">
        <!-- Judul -->
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Analisis Video Reaksi Kimia</h2>
        <p class="text-md text-gray-600 mb-12">
            Upload video reaksi kimia Anda dan dapatkan analisis kuantitatif yang akurat dengan teknologi AI
        </p>

        <!-- Header Section -->
        <div class="flex justify-between max-w-4xl mx-auto mb-8">
            <div class="text-start">
                <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">Analisis Video Reaksi Kimia</h2>
                <p class="text-sm text-gray-600 mb-8">
                    Upload video reaksi kimia Anda dan dapatkan analisis kuantitatif yang akurat
                </p>
            </div>
            <div class="flex items-center px-10 my-3 text-xl bg-gray-100 text-blue-700 border-2 border-blue-700 hover:text-white hover:bg-blue-700 transform hover:scale-105 transition duration-200 font-semibold rounded-lg">
                <img src="{{ asset('images/vector.png') }}" alt="" class="w-6 h-6 mr-2">
                <a href="{{ route('analisis.history') }}">
                    {{ __('Riwayat Analisis') }}
                </a>
            </div>
        </div>

        @include('analysis.form-upload')
    </div>
</x-app-layout>

