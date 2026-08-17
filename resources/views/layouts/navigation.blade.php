<nav x-data="{ mobileOpen: false, toolsOpen: false }" class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-md border-b border-emerald-100 dark:border-emerald-950/50 sticky top-0 z-50 transition-all">
    <!-- Top Emerald Accent Bar -->
    <div class="h-1 bg-gradient-to-r from-emerald-600 via-teal-500 to-amber-500"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <!-- Left Side: Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center focus:outline-none">
                    <x-application-logo />
                </a>
            </div>

            <!-- Middle: Main Navigation Links (Desktop) -->
            <div class="hidden lg:flex items-center space-x-1 xl:space-x-2">
                <!-- Home -->
                <a href="{{ url('/') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->is('/') ? 'text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-emerald-50/50 dark:hover:bg-gray-800' }}">
                    Home
                </a>

                <!-- Quran -->
                <a href="{{ route('quran.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->is('quran*') || request()->routeIs('quran.*') ? 'text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-emerald-50/50 dark:hover:bg-gray-800' }}">
                    Quran
                </a>

                <!-- Hadith -->
                <a href="{{ route('hadith.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->is('hadith*') || request()->routeIs('hadith.*') ? 'text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-emerald-50/50 dark:hover:bg-gray-800' }}">
                    Hadith
                </a>

                <!-- Dua & Azkar -->
                <a href="{{ route('duas.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors whitespace-nowrap {{ request()->is('duas*') || request()->is('dua*') || request()->routeIs('duas.*') ? 'text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-emerald-50/50 dark:hover:bg-gray-800' }}">
                    Dua &amp; Azkar
                </a>

                <!-- Prayer Time -->
                <a href="{{ route('prayer-times.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors whitespace-nowrap {{ request()->is('prayer-time*') || request()->routeIs('prayer-times.*') ? 'text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-emerald-50/50 dark:hover:bg-gray-800' }}">
                    Prayer Time
                </a>

                <!-- Islamic Calendar -->
                <a href="{{ route('islamic-calendar.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors whitespace-nowrap {{ request()->is('calendar*') || request()->is('islamic-calendar*') || request()->routeIs('islamic-calendar.*') ? 'text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-emerald-50/50 dark:hover:bg-gray-800' }}">
                    Islamic Calendar
                </a>

                <!-- Articles -->
                <a href="{{ url('/articles') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->is('articles*') ? 'text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-emerald-50/50 dark:hover:bg-gray-800' }}">
                    Articles
                </a>

                <!-- Tools Dropdown -->
                <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                    <button @click="open = !open" type="button" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-emerald-50/50 dark:hover:bg-gray-800 focus:outline-none transition-colors">
                        <span>Tools</span>
                        <svg class="ms-1.5 h-4 w-4 transition-transform duration-200" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                         class="absolute right-0 mt-2 w-56 rounded-2xl bg-white dark:bg-gray-800 shadow-xl border border-emerald-100/80 dark:border-gray-700 py-2 z-50"
                         style="display: none;">
                        
                        <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700 text-xs font-semibold text-emerald-700 dark:text-emerald-400 uppercase tracking-wider">
                            Islamic Utilities
                        </div>

                        <!-- Tasbih -->
                        <a href="{{ route('tasbih') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors group">
                            <span class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center me-3 group-hover:scale-110 transition-transform">
                                📿
                            </span>
                            <div>
                                <div class="font-medium">Tasbih</div>
                                <div class="text-xs text-gray-400 dark:text-gray-400">Digital Dhikr Counter</div>
                            </div>
                        </a>

                        <!-- Qibla -->
                        <a href="{{ route('qibla') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors group">
                            <span class="w-8 h-8 rounded-lg bg-teal-100 dark:bg-teal-900/60 text-teal-600 dark:text-teal-400 flex items-center justify-center me-3 group-hover:scale-110 transition-transform">
                                🧭
                            </span>
                            <div>
                                <div class="font-medium">Qibla</div>
                                <div class="text-xs text-gray-400 dark:text-gray-400">Direction Finder</div>
                            </div>
                        </a>

                        <!-- Zakat Calculator -->
                        <a href="{{ route('zakat.calculator') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors group">
                            <span class="w-8 h-8 rounded-lg bg-amber-100 dark:bg-amber-900/60 text-amber-600 dark:text-amber-400 flex items-center justify-center me-3 group-hover:scale-110 transition-transform">
                                💰
                            </span>
                            <div>
                                <div class="font-medium">Zakat Calculator</div>
                                <div class="text-xs text-gray-400 dark:text-gray-400">Calculate Your Zakat</div>
                            </div>
                        </a>

                        <!-- Islamic Quiz -->
                        <a href="{{ route('quiz.index') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors group">
                            <span class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/60 text-purple-600 dark:text-purple-400 flex items-center justify-center me-3 group-hover:scale-110 transition-transform">
                                🧠
                            </span>
                            <div>
                                <div class="font-medium">Islamic Quiz</div>
                                <div class="text-xs text-gray-400 dark:text-gray-400">Test Your Knowledge</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Side: Header Search Input & Auth Controls -->
            <div class="hidden lg:flex items-center space-x-3">
                <!-- Header Search Box (STEP 4) -->
                <form action="{{ route('search') }}" method="GET" class="relative flex items-center">
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="অনুসন্ধান করুন..." 
                           class="w-36 xl:w-52 pl-9 pr-3 py-1.5 rounded-xl bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-xs text-gray-800 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:w-60 focus:ring-2 focus:ring-emerald-500/40 focus:border-emerald-500 transition-all duration-300">
                    <button type="submit" aria-label="Search" class="absolute left-2.5 text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                </form>
                @auth
                    <!-- User Dropdown (when logged in) -->
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                        <button @click="open = !open" class="inline-flex items-center gap-2 px-3.5 py-2 border border-emerald-200 dark:border-gray-700 text-sm font-medium rounded-xl text-gray-700 dark:text-gray-200 bg-emerald-50/50 dark:bg-gray-800 hover:bg-emerald-100/50 dark:hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="w-7 h-7 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs font-bold uppercase">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="fill-current h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                             class="absolute right-0 mt-2 w-48 rounded-xl bg-white dark:bg-gray-800 shadow-xl border border-gray-100 dark:border-gray-700 py-1.5 z-50"
                             style="display: none;">
                            
                            @if (Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-emerald-600 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-gray-700">
                                    <span>👑</span> {{ __('Admin Panel') }}
                                </a>
                            @endif

                            <a href="{{ route('account.profile') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-emerald-50 dark:hover:bg-gray-700">
                                <span>👤</span> {{ __('My Account') }}
                            </a>
                            <a href="{{ route('bookmarks.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-emerald-50 dark:hover:bg-gray-700">
                                <span>🔖</span> {{ __('My Bookmarks') }}
                            </a>
                            <a href="{{ route('favorites.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-emerald-50 dark:hover:bg-gray-700">
                                <span>❤️</span> {{ __('My Favorites') }}
                            </a>
                            <a href="{{ route('history.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-emerald-50 dark:hover:bg-gray-700">
                                <span>📖</span> {{ __('Reading History') }}
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-emerald-50 dark:hover:bg-gray-700">
                                {{ __('Settings') }}
                            </a>

                            <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/30">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Guest: Login / Register -->
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-emerald-700 dark:hover:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-gray-800 transition">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 shadow-sm shadow-emerald-600/30 hover:shadow-md transition">
                            Register
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Hamburger Button for Mobile -->
            <div class="flex items-center lg:hidden">
                <button @click="mobileOpen = !mobileOpen" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-600 dark:text-gray-300 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-gray-800 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': mobileOpen, 'inline-flex': !mobileOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !mobileOpen, 'inline-flex': mobileOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu Drawer -->
    <div :class="{'block': mobileOpen, 'hidden': !mobileOpen}" class="hidden lg:hidden border-t border-emerald-100 dark:border-gray-800 bg-white/95 dark:bg-gray-900/95 px-4 pt-3 pb-6 space-y-1">
        <a href="{{ url('/') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium transition-colors {{ request()->is('/') ? 'text-emerald-700 bg-emerald-50 dark:bg-emerald-950/40 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
            Home
        </a>
        <a href="{{ route('quran.index') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium transition-colors {{ request()->is('quran*') || request()->routeIs('quran.*') ? 'text-emerald-700 bg-emerald-50 dark:bg-emerald-950/40 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
            Quran
        </a>
        <a href="{{ route('hadith.index') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium transition-colors {{ request()->is('hadith*') || request()->routeIs('hadith.*') ? 'text-emerald-700 bg-emerald-50 dark:bg-emerald-950/40 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
            Hadith
        </a>
        <a href="{{ route('duas.index') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium transition-colors {{ request()->is('duas*') || request()->is('dua*') || request()->routeIs('duas.*') ? 'text-emerald-700 bg-emerald-50 dark:bg-emerald-950/40 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
            Dua &amp; Azkar
        </a>
        <a href="{{ route('prayer-times.index') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium transition-colors {{ request()->is('prayer-time*') || request()->routeIs('prayer-times.*') ? 'text-emerald-700 bg-emerald-50 dark:bg-emerald-950/40 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
            Prayer Time
        </a>
        <a href="{{ route('islamic-calendar.index') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium transition-colors {{ request()->is('calendar*') || request()->is('islamic-calendar*') || request()->routeIs('islamic-calendar.*') ? 'text-emerald-700 bg-emerald-50 dark:bg-emerald-950/40 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
            Islamic Calendar
        </a>
        <a href="{{ url('/articles') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium transition-colors {{ request()->is('articles*') ? 'text-emerald-700 bg-emerald-50 dark:bg-emerald-950/40 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
            Articles
        </a>
        <!-- Mobile Search Form (STEP 4) -->
        <form action="{{ route('search') }}" method="GET" class="px-3 py-2">
            <div class="relative flex items-center">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="কুরআন, হাদিস, দোয়া বা প্রবন্ধ খুঁজুন..." 
                       class="w-full pl-9 pr-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm text-gray-800 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:border-emerald-500">
                <button type="submit" aria-label="Search" class="absolute left-3 text-emerald-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </div>
        </form>

        <!-- Mobile Tools Submenu Accordion -->
        <div x-data="{ openTools: false }" class="pt-1">
            <button @click="openTools = !openTools" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800">
                <span class="flex items-center gap-2">
                    <span>Tools</span>
                </span>
                <svg class="h-4 w-4 transition-transform duration-200" :class="{'rotate-180': openTools}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="openTools" class="pl-4 space-y-1 mt-1 border-l-2 border-emerald-200 dark:border-emerald-800 ms-3" style="display: none;">
                <a href="{{ route('tasbih') }}" class="flex items-center gap-2 px-3 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-emerald-600">
                    <span>📿</span> Tasbih
                </a>
                <a href="{{ route('qibla') }}" class="flex items-center gap-2 px-3 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-emerald-600">
                    <span>🧭</span> Qibla
                </a>
                <a href="{{ route('zakat.calculator') }}" class="flex items-center gap-2 px-3 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-emerald-600">
                    <span>💰</span> Zakat Calculator
                </a>
                <a href="{{ route('quiz.index') }}" class="flex items-center gap-2 px-3 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-emerald-600">
                    <span>🧠</span> Islamic Quiz
                </a>
            </div>
        </div>

        <!-- Mobile Auth / Guest Section -->
        <div class="pt-4 mt-3 border-t border-gray-200 dark:border-gray-700">
            @auth
                <div class="px-3 py-2">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-2 space-y-1">
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40">
                            <span>👑</span> {{ __('Admin Panel') }}
                        </a>
                    @endif
                    <a href="{{ route('account.profile') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                        <span>👤</span> {{ __('My Account') }}
                    </a>
                    <a href="{{ route('bookmarks.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                        <span>🔖</span> {{ __('My Bookmarks') }}
                    </a>
                    <a href="{{ route('favorites.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                        <span>❤️</span> {{ __('My Favorites') }}
                    </a>
                    <a href="{{ route('history.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                        <span>📖</span> {{ __('Reading History') }}
                    </a>
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                        {{ __('Profile') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-3 py-2 rounded-lg text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/20">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            @else
                <div class="flex flex-col gap-2 pt-2">
                    <a href="{{ route('login') }}" class="w-full text-center px-4 py-2.5 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700 hover:bg-gray-50">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="w-full text-center px-4 py-2.5 rounded-xl text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700">
                            Register
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>
