<header class="h-20 bg-slate-950/90 backdrop-blur-md border-b border-slate-800 px-4 sm:px-6 lg:px-8 flex items-center justify-between sticky top-0 z-40">
    <!-- Left: Mobile Hamburger & Page Title -->
    <div class="flex items-center gap-3">
        <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 lg:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <div>
            <h1 class="text-base sm:text-lg font-bold text-white tracking-tight">@yield('title', 'Admin Dashboard')</h1>
            <span class="text-[11px] text-emerald-400 font-medium hidden sm:inline">Islamic Knowledge Management System</span>
        </div>
    </div>

    <!-- Right: User Badge, Live Site & Logout Action -->
    <div class="flex items-center gap-3">
        <a href="{{ url('/') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-900 hover:bg-slate-800 border border-slate-700 text-xs font-semibold text-emerald-400 transition">
            <span>🌐</span> <span>Live Site</span>
        </a>

        <div class="h-6 w-px bg-slate-800 hidden sm:block"></div>

        <!-- Admin Profile Info -->
        <div class="flex items-center gap-3">
            <div class="hidden md:flex flex-col text-right">
                <span class="text-xs font-bold text-white">{{ Auth::user()->name }}</span>
                <span class="text-[10px] text-amber-400 uppercase font-bold tracking-wider">👑 Administrator</span>
            </div>
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center font-bold text-sm shadow-md shadow-emerald-600/30 uppercase">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-red-400 hover:bg-slate-800 transition" title="Log Out">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            </button>
        </form>
    </div>
</header>
