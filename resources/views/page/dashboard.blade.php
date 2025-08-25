<x-app-layout>
    <div class="flex flex-col items-center justify-center py-10 bg-gradient-to-b from-cyan-800 via-teal-600 via-emerald-400 via-emerald-200 to-cyan-50">
        <h1 class="text-center text-7xl font-bold text-white max-w-5xl py-10 dark:text-gray-200">
            <span>
                Ubah Video Reaksi Kimia Menjadi Data Kuantitatif
            </span>
        </h1>
        <p class="text-center text-xl font-semibold text-white max-w-5xl mt-4 py-8 dark:text-gray-200">
            Ubah data eksperimen Anda menjadi wawasan yang dapat ditindaklanjuti dengan AI
            Analisis kinetika, ukur absorbansi, dan visualisakan reaksi osilasi hanya dengan beberapa klik.
            Chrono Spectra AI adalah laboratorium kimia di dalam browser Anda. 
            Sebagai Platform analisis video canggih untuk penelitian Anda.
        </p><br>
        <a href="{{ route('page.analisis') }}" class="text-xl bg-blue-600 text-white hover:bg-blue-700 transform hover:scale-105 transition duration-200 font-semibold py-4 px-6 rounded-lg">
            {{ __('Start Free Analysis') }}
        </a>
        <div class="h-20"></div>
    </div>
    <div class="flex flex-col items-center justify-center py-20 bg-gradient-to-b from-cyan-50 to-white">
        <div class="flex items-center justify-center bg-red-100 rounded-full mb-6 px-6 py-1">
            <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-10 h-10">
            <p class="text-lg font-bold px-4 text-red-500">Masalah yang sering dihadapi!</p>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-4">
            Tinggalkan Spektrofotometer yang Rumit dan Mahal
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl text-center">
            Analisis kinetika reaksi sering kali membutuhkan peralatan laboratorium berbiaya tinggi serta proses memakan waktu. Mengamati perubahan warna secara visual tidaklah cukup untuk mendapatkan data kuantitatif yang akurat.
        </p>
        <div class="h-20"></div>
        <div class="flex items-center justify-center bg-green-100 rounded-full mb-6 px-6 py-1">
            <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-10 h-10">
            <p class="text-lg font-bold px-4 text-green-500">Solusi Cerdas di Ujung Jari Anda</p>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-4">
            Kecerdasan Buatan untuk Analisis yang Lebih Cerdas
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl text-center">
            Chrono Spectra AI mentransformasi kamera smartphone atau webcam Anda menjadi alat analisis yang canggih. Unggah video reaksi Anda, dan biarkan kecerdasan buatan kami melakukan analisis untuk mengubah data visual menjadi grafik, tabel, dan wawasan yang siap dipublikasikan.
        </p>
    </div>
    <div class="flex flex-wrap justify-center gap-6 py-20 px-20">
        <div class="w-[300px] h-[320px] flex flex-col text-center bg-white dark:bg-gray-800 px-12 py-8 rounded-lg shadow-lg">
            <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-10 h-10 mx-auto mb-4">
            <div class="flex-grow flex flex-col justify-start">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 min-h-[56px] mb-2">
                    Gunakan Perangkat Anda
                </h2>
                <p>
                    Tidak perlu peralatan mahal. Smartphone atau kamera web sudah cukup untuk melakukan analisis tingkat laboratorium.
                </p>
            </div>
        </div>
        <div class="w-[300px] h-[320px] flex flex-col text-center bg-white dark:bg-gray-800 px-12 py-8 rounded-lg shadow-lg">
            <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-10 h-10 mx-auto mb-4">
            <div class="flex-grow flex flex-col justify-start">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 min-h-[56px] mb-2">
                    AI Yang Canggih
                </h2>
                <p>
                    Model CNN-LSTM untuk analisis temporal dan spasial yang akurat. Deteksi otomatis ROI dan kalkulasi absorbansi
                </p>
            </div>
        </div>
        <div class="w-[300px] h-[320px] flex flex-col text-center bg-white dark:bg-gray-800 px-12 py-8 rounded-lg shadow-lg">
            <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-10 h-10 mx-auto mb-4">
            <div class="flex-grow flex flex-col justify-start">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 min-h-[56px] mb-2">
                Data Akurat
                </h2>
                <p>
                    Berdasarkan Hukum Lambert-Beer dengan validasi otomatis untuk memastikan data berada dalam rentang linear.
                </p>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center justify-center py-20 bg-blue-100 dark:bg-gray-900">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-12">
            Analisis dalam 3 Langkah Mudah
        </h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl text-center mb-12">
            Dari video mentah hingga data yang siap dipublikasikan hanya dalam beberapa menit
        </p>
        <div class="flex flex-wrap justify-center gap-6  px-20">
            <div class="relative w-[300px] h-[400px] flex flex-col text-center bg-white dark:bg-gray-800 px-12 py-8 rounded-lg shadow-lg">
                <!-- Nomor step (angka di atas tengah card) -->
                <div class="absolute -top-5 left-1/2 transform -translate-x-1/2 bg-blue-500 text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold shadow-md z-10">
                    1
                </div>

                <!-- Panah ke kanan (kecuali di card terakhir) -->
                <x-arah-panah />
                <!-- Konten card -->
                <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-15 h-15 mx-auto mb-4">
                <div class="flex-grow flex flex-col justify-start">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 min-h-[32px] mb-2">
                        Unggah Video Anda
                    </h2>
                    <p>
                        Rekam reaksi kimia Anda secara langsung atau unggah file video dari perangkat. Potong bagian yang tidak perlu dengan editor sederhana kami.
                    </p>
                </div>
            </div>
            <div class="relative w-[300px] h-[400px] flex flex-col text-center bg-white dark:bg-gray-800 px-12 py-8 rounded-lg shadow-lg">
                <!-- Nomor step (angka di atas tengah card) -->
                <div class="absolute -top-5 left-1/2 transform -translate-x-1/2 bg-blue-500 text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold shadow-md z-10">
                    2
                </div>

                <!-- Panah ke kanan (kecuali di card terakhir) -->
                <x-arah-panah />
                <!-- Konten card -->
                <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-15 h-15 mx-auto mb-4">
                <div class="flex-grow flex flex-col justify-start">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 min-h-[32px] mb-2">
                    Mulai Analisis AI
                    </h2>
                    <p>
                        Berikan konteks pada AI mengenai reaksi Anda, lalu klik "Analisis". Mesin kami akan secara otomatis melacak perubahan warna, menghitung absorbansi, dan menganalisis dinamika reaksi di setiap frame.
                    </p>
                </div>
            </div>
            <div class="relative w-[300px] h-[400px] flex flex-col text-center bg-white dark:bg-gray-800 px-12 py-8 rounded-lg shadow-lg">
                <!-- Nomor step (angka di atas tengah card) -->
                <div class="absolute -top-5 left-1/2 transform -translate-x-1/2 bg-blue-500 text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold shadow-md z-10">
                    3
                </div>
                <!-- Konten card -->
                <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-15 h-15 mx-auto mb-4">
                <div class="flex-grow flex flex-col justify-start">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 min-h-[32px] mb-2">
                        Visualisasikan Hasil
                    </h2>
                    <p>
                        Dapatkan laporan komprehensif berisi uraian naratif, grafik interaktif, dan tabel data. Ekspor hasil Anda ke format PDF, Word, atau  Excel dengan mudah.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center justify-center py-20 bg-blue-100 dark:bg-gray-900">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-12">
            Lebih dari Sekedar Analisis Biasa 
        </h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl text-center mb-12">
            Platform komprehensif yang mengubah cara Anda melakukan analisis kimia kuantitatif
        </p>
        <div class="flex flex-wrap justify-start gap-3">
            <div class="w-[270px] h-[400px] flex flex-col text-start bg-white dark:bg-gray-800 px-6 py-8 rounded-lg shadow-lg">
                <!-- Konten card -->
                <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-15 h-15 mx-auto mb-4">
                <div class="flex-grow flex flex-col justify-start">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 min-h-[32px] mb-2">
                        Pengukuran Absorbansi
                    </h2>
                    <p>
                        Fungsikan perangkat Anda sebagai spektrometer digital. Dapatkan plot absorbansi vs waktu yang akurat berdasarkan Hukum Lambert-Beer.
                    </p>
                </div>
            </div>
            <div class="w-[270px] h-[400px] flex flex-col text-start bg-white dark:bg-gray-800 px-6 py-8 rounded-lg shadow-lg">
                <!-- Konten card -->
                <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-15 h-15 mx-auto mb-4">
                <div class="flex-grow flex flex-col justify-start">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 min-h-[32px] mb-2">
                        Analisis Kinetika Lanjut
                    </h2>
                    <p>
                        Tentukan laju reaksi, konstanta laju (k), dan orde reaksi (0, 1, atau 2) secara otomatis dari data video Anda.
                    </p>
                </div>
            </div>
            <div class="w-[270px] h-[400px] flex flex-col text-start bg-white dark:bg-gray-800 px-6 py-8 rounded-lg shadow-lg">
                <!-- Konten card -->
                <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-15 h-15 mx-auto mb-4">
                <div class="flex-grow flex flex-col justify-start">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 min-h-[32px] mb-2">
                        Analisis Osilasi Cepat
                    </h2>
                    <p>
                        Dengan dukungan video frame rate tinggi dan model AI (CNN-LSTM), tangkap dan kuantifikasi setiap perubahan dalam reaksi osilasi kompleks seperti Belousov-Zhabotinsky.
                    </p>
                </div>
            </div>
            <div class="w-[270px] h-[400px] flex flex-col text-start bg-white dark:bg-gray-800 px-6 py-8 rounded-lg shadow-lg">
                <!-- Konten card -->
                <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-15 h-15 mx-auto mb-4">
                <div class="flex-grow flex flex-col justify-start">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 min-h-[32px] mb-2">
                        Validasi Otomatis
                    </h2>
                    <p>
                        Sistem memberikan peringatan jika nilai absorbansi berada di luar rentang linear untuk menjaga validitas data analisis Anda.
                    </p>
                </div>
            </div>
        </div>
    </div><br>
    <div class="max-w-5xl mx-auto bg-cyan-50 rounded-xl p-8 flex flex-col md:flex-row items-center justify-between gap-10 shadow-md mb-10">
        <!-- Kiri: Teks Deskripsi -->
        <div class="flex-1 text-left">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">
                Teknologi AI Terdepan untuk Analisis Kimia
            </h2>

            <p class="text-sm text-gray-800 mb-2">
                <span class="font-bold">CNN untuk Analisis Spasial:</span>
                Deteksi otomatis Region of Interest (ROI) dan ekstraksi warna yang presisi
            </p>
            
            <p class="text-sm text-gray-800 mb-2">
                <span class="font-bold">LSTM untuk Analisis Temporal:</span>
                Melacak perubahan dinamis dan pola osilasi dari waktu ke waktu
            </p>
            
            <p class="text-sm text-gray-800">
                <span class="font-bold">Validasi Real-time:</span>
                Memastikan semua data berada dalam rentang linear untuk akurasi maksimal
            </p>
        </div>

        <!-- Kanan: Ilustrasi Grafik (gambar atau dummy blok) -->
        <div class="flex-1 flex justify-center">
            <img src="{{ asset('images/ai-chem-illustration.png') }}" alt="AI Chem Illustration" class="w-full max-w-sm">
        </div>
    </div>

    <div class="flex flex-col items-center justify-center py-20 bg-blue-100 dark:bg-gray-900">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-12">
            Rancangan Khusus untuk Dunia Akademis dan Riset
        </h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl text-center mb-12">
            Solusi yang tepat untuk setiap tingkat pendidikan dan penelitian kimia   
        </p>
        <div class="flex flex-wrap justify-start gap-4">
            <div class="w-[300px] h-[550px] flex flex-col text-start bg-white dark:bg-gray-800 px-8 py-8 rounded-lg shadow-lg">
                <!-- Konten card -->
                <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-15 h-15 mx-auto mb-4">
                <div class="flex-grow flex flex-col justify-start">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 min-h-[32px] mb-2">
                        Untuk Mahasiswa & Pelajar
                    </h2>
                    <p>
                        Pahami konsep kimia abstrak dengan cara yang praktis dan visual. Jadikan laporan praktikum Anda lebih impresif dengan data kuantitatif.    
                    </p>
                    <ul class="list-disc pl-5 mt-4 text-md text-gray-700 dark:text-gray-300 space-y-1">
                        <li>Visualisasi konsep Hukum Lambert-Beer</li>
                        <li>Data kuantitatif untuk laporan praktikum</li>
                        <li>Pemahaman mendalam tentang kinetika kimia</li>
                        <li>Akses gratis untuk belajar</li>
                    </ul>

                </div>
            </div>
            <div class="w-[300px] h-[550px] flex flex-col text-start bg-white dark:bg-gray-800 px-8 py-8 rounded-lg shadow-lg">
                <!-- Konten card -->
                <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-15 h-15 mx-auto mb-4">
                <div class="flex-grow flex flex-col justify-start">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 min-h-[32px] mb-2">
                        Untuk Dosen & Pendidik
                    </h2>
                    <p>
                        Ciptakan pengalaman belajar yang interaktif di kelas atau laboratorium. Ubah demonstrasi klasik menjadi eksperimen berbasis data.
                    </p>
                    <ul class="list-disc pl-5 mt-4 text-md text-gray-700 dark:text-gray-300 space-y-1">    <li>Alat bantu mengajar yang interaktif</li>
                        <li>Demonstrasi real-time di kelas</li>
                        <li>Engaging pembelajaran untuk mahasiswa</li>
                        <li>Hemat biaya peralatan laboratorium</li>
                    </ul>
                </div>
            </div>
            <div class="w-[300px] h-[550px] flex flex-col text-start bg-white dark:bg-gray-800 px-8 py-8 rounded-lg shadow-lg">
                <!-- Konten card -->
                <img src="{{ asset('images/chemicalAi.png') }}" alt="Hero Image" class="w-15 h-15 mx-auto mb-4">
                <div class="flex-grow flex flex-col justify-start">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 min-h-[32px] mb-2">
                        Untuk Peneliti
                    </h2>
                    <p>
                        Lakukan skrining eksperimen awal dengan cepat dan efisien. Dapatkan data pendahuluan untuk proposal riset atau publikasi ilmiah Anda.    
                    </p>
                    <ul class="list-disc pl-5 mt-4 text-md text-gray-700 dark:text-gray-300 space-y-1">
                        <li>Skrining eksperimen yang efisien</li>
                        <li>Data preliminer untuk riset</li>
                        <li>Analisis batch untuk throughput tinggi</li>
                        <li>Export hasil untuk publikasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-8 flex flex-col md:flex-row justify-around items-center gap-8">
        <!-- Statistik 1 -->
        <div class="text-center">
            <div class="text-3xl font-bold text-blue-600">500+</div>
            <div class="text-sm text-gray-800">Mahasiswa & Peneliti</div>
        </div>

        <!-- Statistik 2 -->
        <div class="text-center">
            <div class="text-3xl font-bold text-teal-600">50+</div>
            <div class="text-sm text-gray-800">Institusi Pendidikan</div>
        </div>

        <!-- Statistik 3 -->
        <div class="text-center">
            <div class="text-3xl font-bold text-purple-600">1000+</div>
            <div class="text-sm text-gray-800">Analisis Selesai</div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-16 text-center">
        <!-- Judul -->
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
            Apa Kata Mereka Tentang Chrono Spectra AI?
        </h2>
        <p class="text-sm text-gray-600 mb-10">
            Dipercaya oleh akademisi dan peneliti di seluruh Indonesia
        </p>

        <!-- Testimoni Cards -->
        <div class="flex flex-col md:flex-row justify-center gap-6">
            
            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-sm text-left">
            <!-- Bintang -->
            <div class="flex gap-1 mb-2 text-yellow-400 text-lg">
                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
            </div>

            <!-- Kutipan -->
            <div class="text-blue-400 text-2xl leading-none">“</div>
            <p class="text-sm text-gray-700 mb-6">
                "Platform ini mengubah cara saya mengajar kinetika kimia. Mahasiswa menjadi lebih antusias karena mereka bisa melihat langsung bagaimana data dihasilkan dari eksperimen yang mereka lakukan."
            </p>

            <!-- Footer -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/anugrah.jpg') }}" alt="Dr. Anugrah" class="w-10 h-10 rounded-full object-cover">
                <p class="font-semibold text-gray-900 text-sm">Dr. Anugrah R.W.</p>
            </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-sm text-left">
            <div class="flex gap-1 mb-2 text-yellow-400 text-lg">
                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
            </div>
            <div class="text-blue-400 text-2xl leading-none">“</div>
            <p class="text-sm text-gray-700 mb-6">
                "Sebagai peneliti, waktu saya sangat berharga. Chrono Spectra AI memungkinkan saya melakukan analisis awal tanpa harus antre menggunakan spektrofotometer. Sangat efisien!"
            </p>
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/mohammad.jpg') }}" alt="Mohammad" class="w-10 h-10 rounded-full object-cover">
                <p class="font-semibold text-gray-900 text-sm">Mohammad I.U.</p>
            </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-sm text-left">
            <div class="flex gap-1 mb-2 text-yellow-400 text-lg">
                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
            </div>
            <div class="text-blue-400 text-2xl leading-none">“</div>
            <p class="text-sm text-gray-700 mb-6">
                "Laporan praktikum saya jadi jauh lebih impresif dengan data kuantitatif dari Chrono Spectra AI. Dosen saya sampai tanya dari mana saya dapat data seakurat ini!"
            </p>
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/sarah.jpg') }}" alt="Sarah" class="w-10 h-10 rounded-full object-cover">
                <p class="font-semibold text-gray-900 text-sm">Sarah L.</p>
            </div>
            </div>
        </div>
    </div>

    <div class="py-16 px-4 sm:px-6 lg:px-8 text-center max-w-7xl mx-auto">
        <!-- Judul -->
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Temukan Paket yang Tepat untuk Anda</h2>
        <p class="text-sm text-gray-600 mb-12">
            Mulai gratis, upgrade sesuai kebutuhan. Semua paket dilengkapi dengan akses penuh ke platform analisis AI kami.
        </p>

        <!-- Cards -->
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Free Plan -->
            <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col items-center">
            <h3 class="text-lg font-bold text-gray-800 mb-1">Free</h3>
            <p class="text-sm text-gray-500 mb-4">Sempurna untuk mencoba</p>
            <p class="text-2xl font-bold text-gray-900 mb-6">Gratis</p>
            <ul class="text-sm text-gray-700 text-left space-y-2 mb-6">
                <li>✔ 5 Analisis / Bulan</li>
                <li>✔ Analisis Kinetika Dasar</li>
                <li>✔ Ekspor dengan Watermark</li>
                <li>✔ Dukungan Email</li>
            </ul>
            <button class="bg-emerald-500 text-white px-6 py-2 rounded-md font-semibold hover:bg-emerald-600 transition">Mulai Gratis</button>
            </div>

            <!-- Basic Plan (Paling Populer) -->
            <div class="bg-white shadow-lg rounded-xl p-6 border-2 border-blue-500 relative flex flex-col items-center">
            <!-- Badge -->
            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full font-semibold flex items-center gap-1">
                ⚡ Paling Populer
                </span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1 mt-4">Basic</h3>
            <p class="text-sm text-gray-500 mb-4">Ideal untuk mahasiswa & pendidik</p>
            <p class="text-2xl font-bold text-gray-900 mb-1">Rp. 49.000<span class="text-sm font-normal">/bulan</span></p>
            <ul class="text-sm text-gray-700 text-left space-y-2 mb-6">
                <li>✔ 50 Analisis / Bulan</li>
                <li>✔ Semua Fitur Analisis Standar</li>
                <li>✔ Ekspor Tanpa Watermark</li>
                <li>✔ Video Frame Rate Tinggi</li>
                <li>✔ Dukungan Prioritas</li>
            </ul>
            <button class="bg-blue-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-700 transition">Pilih Basic</button>
            </div>

            <!-- Pro Plan -->
            <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col items-center">
            <h3 class="text-lg font-bold text-gray-800 mb-1">Pro</h3>
            <p class="text-sm text-gray-500 mb-4">Solusi lengkap untuk riset</p>
            <p class="text-2xl font-bold text-gray-900 mb-1">Rp. 149.000<span class="text-sm font-normal">/bulan</span></p>
            <ul class="text-sm text-gray-700 text-left space-y-2 mb-6">
                <li>✔ Analisis Tanpa Batas</li>
                <li>✔ Analisis Osilasi Cepat (CNN-LSTM)</li>
                <li>✔ Analisis Batch</li>
                <li>✔ API Access</li>
                <li>✔ Dukungan 24/7</li>
                <li>✔ Custom Integrations</li>
            </ul>
            <button class="bg-emerald-700 text-white px-6 py-2 rounded-md font-semibold hover:bg-emerald-800 transition">Pilih Pro</button>
            </div>
        </div>

        <!-- Fitur Tambahan -->
        <div class="mt-12 bg-white rounded-xl p-6 max-w-4xl mx-auto shadow-md">
            <h4 class="text-md font-semibold mb-4 text-gray-800">Semua Paket Termasuk:</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm text-gray-700 text-left">
            <li>✔ Akses ke semua fitur analisis dasar</li>
            <li>✔ Export hasil ke PDF, Word, Excel</li>
            <li>✔ Visualisasi grafik interaktif</li>
            <li>✔ Cloud storage untuk proyek</li>
            <li>✔ Tutorial dan dokumentasi lengkap</li>
            <li>✔ Update fitur secara berkala</li>
            </div>
        </div>
    </div>
    <div class="bg-gradient-to-r from-blue-600 to-teal-500 text-white py-16 px-6 text-center">
        <!-- Badge -->
        <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-400 text-xs font-semibold uppercase tracking-wide mb-4">
            <span>✨ Revolusi Analisis Kimia ✨</span>
        </div>

        <!-- Heading -->
        <h2 class="text-2xl md:text-3xl font-bold mb-4">
            Siap Merevolusi Analisis Kimia Anda?
        </h2>

        <!-- Subheading -->
        <p class="max-w-2xl mx-auto text-sm md:text-base mb-8">
            Bergabunglah dengan ratusan akademisi dan peneliti yang telah beralih ke cara analisis yang lebih cerdas. Dapatkan hasil yang akurat, hemat waktu, dan tingkatkan kualitas riset Anda.
        </p>

        <!-- Buttons -->
        <div class="flex justify-center flex-wrap gap-4 mb-10">
            <a href="#" class="inline-flex items-center bg-white text-blue-700 font-semibold px-6 py-3 rounded-md hover:bg-blue-100 transition">
            Daftar & dapatkan <span class="hidden sm:inline">&nbsp;Analisis Gratis Anda</span>
            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L13.586 11H4a1 1 0 110-2h9.586l-3.293-3.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            </a>
            <a href="#" class="inline-flex items-center border border-white text-white font-semibold px-6 py-3 rounded-md hover:bg-white hover:text-blue-700 transition">
            Pelajari Lebih Lanjut
            </a>
        </div>

        <!-- Stats -->
        <div class="flex justify-center flex-wrap gap-8 text-sm md:text-base font-medium">
            <div>
            <p class="text-2xl font-bold">99%</p>
            <p class="text-white/80">Tingkat Kepuasan</p>
            </div>
            <div>
            <p class="text-2xl font-bold">500+</p>
            <p class="text-white/80">Pengguna Aktif</p>
            </div>
            <div>
            <p class="text-2xl font-bold">24/7</p>
            <p class="text-white/80">Dukungan Anda</p>
            </div>
        </div>
    </div>
</x-app-layout>
