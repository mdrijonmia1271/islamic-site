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

    <!-- Navigation Links (STEP 13 Hierarchy) -->
    <div class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5 scrollbar-thin scrollbar-thumb-slate-800">
        <div class="px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-500">
            মূল প্যানেল
        </div>

        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <span class="text-base">📊</span>
            <span>Dashboard</span>
        </a>

        <div class="pt-4 px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-500">
            CMS মডিউলসমূহ
        </div>

        <!-- Quran / Surah Management -->
        <a href="{{ route('admin.surahs.index') }}" 
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.surahs.*') ? 'bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <span class="text-base">📖</span>
            <span>সূরা ব্যবস্থাপনা (Surahs)</span>
        </a>

        <!-- Hadith Books Management -->
        <a href="{{ route('admin.hadith-books.index') }}" 
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.hadith-books.*') ? 'bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <span class="text-base">📚</span>
            <span>হাদিস গ্রন্থ (Hadith Books)</span>
        </a>

        <!-- Dua Categories -->
        <a href="{{ route('admin.dua-categories.index') }}" 
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.dua-categories.*') ? 'bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <span class="text-base">📂</span>
            <span>দোয়া ক্যাটাগরি (Categories)</span>
        </a>

        <!-- Duas List -->
        <a href="{{ route('admin.duas.index') }}" 
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.duas.*') ? 'bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <span class="text-base">🤲</span>
            <span>দোয়া ও আযকার (Duas CMS)</span>
        </a>

        <!-- Islamic Events -->
        <a href="{{ route('admin.islamic-events.index') }}" 
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.islamic-events.*') ? 'bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <span class="text-base">📅</span>
            <span>ইসলামিক ক্যালেন্ডার ও দিবস</span>
        </a>

        <!-- Articles Management -->
        <a href="{{ route('admin.articles.index') }}" 
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.articles.*') ? 'bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <span class="text-base">📝</span>
            <span>প্রবন্ধ (Articles)</span>
        </a>

        <!-- Islamic Quiz Management (DAY 12) -->
        <a href="{{ route('quiz.index') }}" target="_blank"
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition text-slate-300 hover:bg-slate-800 hover:text-white">
            <span class="text-base">🧠</span>
            <span>ইসলামিক কুইজ (Quiz)</span>
        </a>

        <div class="pt-4 px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-500">
            ইউজার ও পাবলিক সাইট
        </div>

        <!-- Public Website Link -->
        <a href="{{ url('/') }}" target="_blank" 
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-emerald-400 hover:bg-emerald-950/40 transition">
            <span class="text-base">🌐</span>
            <span>মূল ওয়েবসাইট ভিজিট &rarr;</span>
        </a>
    </div>

    <!-- Sidebar Footer with Logout -->
    <div class="p-4 border-t border-slate-800/80 bg-slate-950/60 space-y-2">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl text-xs font-bold text-red-400 bg-red-950/20 hover:bg-red-950/50 border border-red-900/40 transition">
                <span>🚪</span> <span>লগ আউট (Logout)</span>
            </button>
        </form>
    </div>
</aside>
