<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 relative">
            <!-- Left: Logo & Menu -->
            <div class="flex items-center">
                <a href="{{ route('page.dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-blue-600 dark:text-blue-400" />
                </a>
                <h1 class="text-xl font-semibold text-zinc-900 px-3">ChemicalAI</h1>
            </div>

            <!-- Desktop Nav -->
            <div class="hidden sm:flex space-x-8 absolute left-1/2 transform -translate-x-1/2">
                <x-nav-link :href="route('page.dashboard')" :active="request()->routeIs('page.dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
                @auth 
                    <x-nav-link :href="route('page.analisis')" :active="request()->routeIs('page.analisis')">
                        {{ __('Analisis') }}
                    </x-nav-link>
                    <x-nav-link :href="route('analisis.history')" :active="request()->routeIs('analisis.history')">
                        {{ __('Hasil Analisis') }}
                    </x-nav-link>
                @else
                    <x-nav-link :href="route('page.harga')" :active="request()->routeIs('page.harga')">
                        {{ __('Harga') }}
                    </x-nav-link>
                    <x-nav-link :href="route('page.review')" :active="request()->routeIs('page.review')">
                        {{ __('Review') }}
                    </x-nav-link>
                @endauth
                <x-nav-link :href="route('page.fitur')" :active="request()->routeIs('page.fitur')">
                    {{ __('Fitur') }}
                </x-nav-link>
                <x-nav-link :href="route('page.cara_kerja')" :active="request()->routeIs('page.cara_kerja')">
                    {{ __('Cara Kerja') }}
                </x-nav-link>
            </div>

            <!-- Right: Auth -->
            <div class="hidden sm:flex items-center space-x-6">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-blue-600 hover:scale-105 transition duration-200 py-2 px-4 dark:hover:text-blue-400">
                        {{ __('Log in') }}
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm bg-blue-600 text-white hover:bg-blue-700 transform hover:scale-105 transition duration-200 font-semibold py-2 px-4 rounded">
                            {{ __('Get Started') }}
                        </a>
                    @endif
                @else
                    <!-- Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 focus:outline-none">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 
                                        10.586l3.293-3.293a1 1 0 111.414 
                                        1.414l-4 4a1 1 0 01-1.414 
                                        0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>

            <!-- Hamburger Button -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open" class="text-gray-500 dark:text-gray-400 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden">
        <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700 space-y-1">
            <x-responsive-nav-link :href="route('page.dashboard')" :active="request()->routeIs('page.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('page.analisis')" :active="request()->routeIs('page.fitur')">
                    {{ __('Analisis') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('analisis.history')" :active="request()->routeIs('analisis.history')">
                    {{ __('Hasil Analisis') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('page.harga')" :active="request()->routeIs('page.harga')">
                    {{ __('Harga') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('page.review')" :active="request()->routeIs('page.review')">
                    {{ __('Review') }}
                </x-responsive-nav-link>
                
            @endauth
            <x-responsive-nav-link :href="route('page.fitur')" :active="request()->routeIs('page.fitur')">
                {{ __('Fitur') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('page.cara_kerja')" :active="request()->routeIs('page.cara_kerja')">
                {{ __('Cara Kerja') }}
            </x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            @else
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Log in') }}
                </x-responsive-nav-link>
                @if (Route::has('register'))
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>
    </div>
</nav>