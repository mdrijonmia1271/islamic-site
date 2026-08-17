<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') — Islamic Site Control Center</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-900 text-slate-100 font-sans antialiased" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex">
        
        <!-- Sidebar for Desktop & Mobile -->
        <aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" 
               class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-950 border-r border-emerald-950/80 flex flex-col transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto">
            
            <!-- Sidebar Header / Logo -->
            <div class="h-20 flex items-center px-6 border-b border-slate-800/80 bg-slate-950/60">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-700 flex items-center justify-center text-white shadow-md shadow-emerald-500/20 font-bold">
                        <span>🕋</span>
                    </div>
                    <div>
                        <div class="font-bold text-white tracking-tight text-base">Islamic Admin</div>
                        <div class="text-[11px] text-emerald-400 font-medium">কন্ট্রোল সেন্টার</div>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5">
                <div class="px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                    মূল প্যানেল
                </div>

                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <span class="text-base">📊</span>
                    <span>Dashboard</span>
                </a>

                <div class="pt-4 px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                    CMS মডিউলসমূহ
                </div>

                <!-- Quran / Surah Management -->
                <a href="{{ route('admin.surahs.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.surahs.*') ? 'bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <span class="text-base">📖</span>
                    <span>সূরা ব্যবস্থাপনা (Surahs)</span>
                </a>

                <!-- Hadith Books Management -->
                <a href="{{ route('admin.hadith-books.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.hadith-books.*') ? 'bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <span class="text-base">📜</span>
                    <span>হাদিস গ্রন্থ (Hadith Books)</span>
                </a>

                <!-- Hadith Management -->
                <a href="#" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:bg-slate-800/60 hover:text-slate-200 transition opacity-75">
                    <div class="flex items-center gap-3">
                        <span class="text-base">📜</span>
                        <span>হাদিস সম্ভার</span>
                    </div>
                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-800 text-slate-400">শীঘ্রই</span>
                </a>

                <!-- Dua Categories -->
                <a href="{{ route('admin.dua-categories.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.dua-categories.*') ? 'bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <span class="text-base">📂</span>
                    <span>দোয়া ক্যাটাগরি (Categories)</span>
                </a>

                <!-- Duas List -->
                <a href="{{ route('admin.duas.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.duas.*') ? 'bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <span class="text-base">🤲</span>
                    <span>দোয়া ও আযকার (Duas CMS)</span>
                </a>

                <!-- Islamic Events -->
                <a href="{{ route('admin.islamic-events.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.islamic-events.*') ? 'bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <span class="text-base">📅</span>
                    <span>ইসলামিক ক্যালেন্ডার ও দিবস</span>
                </a>

                <!-- Articles Management -->
                <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.articles.*') ? 'bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <span class="text-base">✍️</span>
                    <span>প্রবন্ধ (Articles)</span>
                </a>

                <div class="pt-4 px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                    ইউজার ও সেটিংস
                </div>

                <!-- User Management -->
                <a href="#" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:bg-slate-800/60 hover:text-slate-200 transition opacity-75">
                    <div class="flex items-center gap-3">
                        <span class="text-base">👥</span>
                        <span>ইউজার লিস্ট</span>
                    </div>
                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-800 text-slate-400">শীঘ্রই</span>
                </a>
            </div>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-slate-800/80 bg-slate-950/60 space-y-2">
                <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-emerald-400 hover:bg-emerald-950/40 transition">
                    <span>🌐</span> মূল ওয়েবসাইট দেখুন &rarr;
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-red-400 hover:bg-red-950/30 transition text-left">
                        <span>🚪</span> লগ আউট (Logout)
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Navbar -->
            <header class="h-20 bg-slate-950/80 backdrop-blur-md border-b border-slate-800 px-4 sm:px-6 lg:px-8 flex items-center justify-between sticky top-0 z-40">
                <!-- Left: Hamburger Button (Mobile) & Title -->
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 lg:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="text-lg sm:text-xl font-bold text-white">@yield('title', 'Admin Dashboard')</h1>
                </div>

                <!-- Right: Admin Info Badge -->
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-xs font-semibold text-white">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] text-emerald-400 uppercase font-bold tracking-wider">Administrator</span>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center font-bold text-sm shadow-md">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Page Body -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 bg-slate-900">
                <!-- Success Alert -->
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-950/80 border border-emerald-600/50 text-emerald-200 text-sm flex items-center justify-between shadow-lg">
                        <div class="flex items-center gap-3">
                            <span class="text-lg">✅</span>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" @click="$el.parentElement.remove()" class="text-emerald-400 hover:text-emerald-200">
                            &times;
                        </button>
                    </div>
                @endif

                <!-- Error Alert -->
                @if (isset($errors) && $errors->any())
                    <div class="mb-6 p-4 rounded-2xl bg-red-950/80 border border-red-600/50 text-red-200 text-sm shadow-lg">
                        <div class="flex items-center gap-2 font-bold mb-1">
                            <span>⚠️</span> অনুগ্রহ করে নিচের ভুলগুলো সংশোধন করুন:
                        </div>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
