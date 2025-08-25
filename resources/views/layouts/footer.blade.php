<!-- Footer -->
<footer class="bg-gray-900 text-gray-500 py-10 px-8 ">
    <div class="max-w-[1920px] mx-auto grid grid-cols-1 md:grid-cols-7 gap-8 text-sm items-start">
        <!-- Logo dan Deskripsi -->
        <div class="col-span-2">
            <div class="flex items-center gap-2 mb-2">
                <img src="/images/home/logo.svg" alt="SaniFlow Logo" class="w-20 h-20">
                <h1 class="text-xl font-semibold text-[#02A6EB]">SaniFlow</h1>
            </div>
            <p>Platform analisis kimia berbasis AI yang mengubah video reaksi menjadi data kuantitatif akurat. Laboratorium kimia di dalam browser Anda.</p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="font-bold mb-2">Platform</h3>
            <ul class="space-y-1">
                <li><a href="{{ route('page.dashboard') }}" class="hover:underline">&gt; Home</a></li>
                <li><a href="{{ route('page.fitur') }}" class="hover:underline">&gt; Fitur</a></li>
                <li><a href="{{ route('page.cara_kerja') }}" class="hover:underline">&gt; Cara Kerja</a></li>
                <li><a href="{{ route('page.harga') }}" class="hover:underline">&gt; Harga</a></li>
                <li><a href="{{ route('page.review') }}" class="hover:underline">&gt; Review</a></li>

            </ul>
        </div>

        <!-- Artikel Terbaru -->
        <div>
            <h3 class="font-bold mb-2">Dukungan</h3>
            <ul class="list-disc list-inside space-y-1">
                <li>Help Center</li>
                <li>Tutorial</li>
                <li>Community</li>
            </ul>
        </div>
        <!-- Artikel Terbaru -->
        <div>
            <h3 class="font-bold mb-2">Perusahaan</h3>
            <ul class="list-disc list-inside space-y-1">
                <li>Tentang Kami</li>
                <li>Blog</li>
                <li>Karir</li>
                <li>Press</li>
            </ul>
        </div>

        <!-- Kontak dan Sosial -->
        <div>
            <!-- Kontak -->
            <div class="mb-6">
            <h3 class="font-bold mb-2">Contact Us</h3>
            <p class="text-sm leading-snug">
                📍 Jl. Veteran No.10-11, Ketawanggede,<br>
                Kec. Lowokwaru, Kota Malang
            </p>
            <p class="mt-2">📧 saniflow@gmail.com</p>
            </div>

            <!-- Sosial -->
            <div>
            <h3 class="font-bold mb-2">Follow Us</h3>
            <div class="flex gap-3 mb-4">
                <img src="/images/home/Facebook.png" alt="Facebook" class="w-6 h-6">
                <img src="/images/home/Telegram.png" alt="Telegram" class="w-6 h-6">
                <img src="/images/home/Instagram.png" alt="Instagram" class="w-6 h-6">
                <img src="/images/home/X.png" alt="X" class="w-6 h-6">
            </div>

            <!-- //Partner
            <h3 class="font-bold mb-2">Our Partners</h3>
            <div class="flex flex-wrap gap-3">
                <img src="/images/home/unicef.png" alt="UNICEF" class="h-6">
                <img src="/images/home/kemenkes.png" alt="Kemenkes" class="h-6">
                <img src="/images/home/worldbank.png" alt="World Bank" class="h-6">
                <img src="/images/home/waterorg.png" alt="Water.org" class="h-6">
                <img src="/images/home/ub.png" alt="Kemendikbud" class="h-6">
            </div> -->
            </div>
        </div>
    </div>
    
    <div class="flex justify-between items-center relative max-w-[1920px] mx-auto mt-10 pt-6 border-t border-gray-300">
        <div>
            <p class="text-xm text-gray-500">© 2025 All Rights Reserved</p>
        </div>
        <div class="sm:flex items-center space-x-8">
            <a href="{{ route('page.dashboard') }}" class="text-xm text-gray-500 hover:underline">Privacy</a>
            <a href="{{ route('page.dashboard') }}" class="text-xm text-gray-500 hover:underline">Terms</a>
            <a href="{{ route('page.dashboard') }}" class="text-xm text-gray-500 hover:underline">Security</a>
        </div>
    </div>
</footer>