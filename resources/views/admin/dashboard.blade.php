@extends('layouts.admin')

@section('title', 'ড্যাশবোর্ড ওভারভিউ (Dashboard Overview)')

@section('content')
<div class="space-y-8">
    
    <!-- Welcome Banner -->
    <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-emerald-950 via-teal-950 to-slate-950 border border-emerald-800/40 text-white relative overflow-hidden shadow-2xl">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="relative z-10 max-w-2xl space-y-2">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-300 bg-amber-950/60 px-3 py-1 rounded-full border border-amber-500/30 inline-block">
                ISLAMIC SITE CONTROL CENTER 👑
            </span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">
                আসসালামু আলাইকুম, {{ Auth::user()->name }}! 👋
            </h2>
            <p class="text-emerald-200/90 text-xs sm:text-sm leading-relaxed">
                ইসলামিক সাইটের সার্বিক পরিসংখ্যান ও কন্টেন্ট কন্ট্রোল প্যানেলে স্বাগতম। এখান থেকে সাইটের আল-কুরআন, সহিহ হাদিস, দু'আ, প্রবন্ধ ও ইউজারদের সকল তথ্য এক নজরে পর্যবেক্ষণ করুন।
            </p>
        </div>
        <div class="absolute -right-6 -bottom-6 text-9xl opacity-10 pointer-events-none font-serif" style="font-family: 'Amiri', serif;">
            🕋
        </div>
    </div>

    <!-- 6 Main Stat Cards Grid (DAY 12 Core Showcase) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        
        <!-- Stat 1: Users (STEP 15 & 16 Enhanced) -->
        <div class="p-5 rounded-2xl bg-slate-950 border border-slate-800/80 shadow-sm hover:border-emerald-500/50 hover:shadow-emerald-900/20 transition flex flex-col justify-between group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-400">👤 মোট ইউজার</span>
                <span class="p-2 rounded-xl bg-amber-950/60 text-amber-400 text-sm group-hover:scale-110 transition-transform">👥</span>
            </div>
            <div class="mt-4">
                <div class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    {{ number_format($stats['users'] ?? 0) }}
                </div>
                <div class="text-[11px] text-slate-400 mt-1 flex items-center justify-between font-medium">
                    <span class="text-emerald-400">আজ: +{{ $stats['today_users'] ?? 0 }}</span>
                    <span class="text-teal-400">মাস: +{{ $stats['monthly_users'] ?? 0 }}</span>
                </div>
            </div>
        </div>

        <!-- Stat 2: Articles (STEP 14 Enhanced) -->
        <a href="{{ route('admin.articles.index') }}" class="p-5 rounded-2xl bg-slate-950 border border-slate-800/80 shadow-sm hover:border-teal-500/50 hover:shadow-teal-900/20 transition flex flex-col justify-between group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-400">📝 প্রবন্ধসমূহ</span>
                <span class="p-2 rounded-xl bg-teal-950/60 text-teal-400 text-sm group-hover:scale-110 transition-transform">✍️</span>
            </div>
            <div class="mt-4">
                <div class="text-2xl sm:text-3xl font-extrabold text-teal-400 tracking-tight">
                    {{ number_format($stats['articles'] ?? 0) }}
                </div>
                <div class="text-[11px] text-slate-400 mt-1 flex items-center justify-between font-medium">
                    <span class="text-emerald-400">Published: {{ $stats['published_articles'] ?? 0 }}</span>
                    <span class="text-amber-400">Draft: {{ $stats['draft_articles'] ?? 0 }}</span>
                </div>
            </div>
        </a>

        <!-- Stat 3: Duas -->
        <a href="{{ route('admin.duas.index') }}" class="p-5 rounded-2xl bg-slate-950 border border-slate-800/80 shadow-sm hover:border-emerald-500/50 hover:shadow-emerald-900/20 transition flex flex-col justify-between group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-400">🤲 দু'আ ও আযকার</span>
                <span class="p-2 rounded-xl bg-emerald-950/60 text-emerald-400 text-sm group-hover:scale-110 transition-transform">🤲</span>
            </div>
            <div class="mt-4">
                <div class="text-2xl sm:text-3xl font-extrabold text-emerald-400 tracking-tight">
                    {{ number_format($stats['duas'] ?? 0) }}
                </div>
                <span class="text-[11px] text-slate-400 mt-1 block">
                    {{ $stats['dua_categories'] ?? 0 }} ক্যাটাগরিতে
                </span>
            </div>
        </a>

        <!-- Stat 4: Hadiths -->
        <a href="{{ route('admin.hadith-books.index') }}" class="p-5 rounded-2xl bg-slate-950 border border-slate-800/80 shadow-sm hover:border-purple-500/50 hover:shadow-purple-900/20 transition flex flex-col justify-between group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-400">📚 সহিহ হাদিস</span>
                <span class="p-2 rounded-xl bg-purple-950/60 text-purple-400 text-sm group-hover:scale-110 transition-transform">📖</span>
            </div>
            <div class="mt-4">
                <div class="text-2xl sm:text-3xl font-extrabold text-purple-400 tracking-tight">
                    {{ number_format($stats['hadiths'] ?? 0) }}
                </div>
                <span class="text-[11px] text-slate-400 mt-1 block">
                    {{ $stats['hadith_books'] ?? 0 }} হাদিস গ্রন্থে
                </span>
            </div>
        </a>

        <!-- Stat 5: Quran -->
        <a href="{{ route('admin.surahs.index') }}" class="p-5 rounded-2xl bg-slate-950 border border-slate-800/80 shadow-sm hover:border-amber-500/50 hover:shadow-amber-900/20 transition flex flex-col justify-between group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-400">📖 আল-কুরআন</span>
                <span class="p-2 rounded-xl bg-amber-950/60 text-amber-400 text-sm group-hover:scale-110 transition-transform">✨</span>
            </div>
            <div class="mt-4">
                <div class="text-2xl sm:text-3xl font-extrabold text-amber-300 tracking-tight">
                    {{ number_format($stats['surahs'] ?? 0) }}
                </div>
                <span class="text-[11px] text-slate-400 mt-1 block">
                    {{ number_format($stats['ayahs'] ?? 0) }} মোট আয়াত
                </span>
            </div>
        </a>

        <!-- Stat 6: Favorites -->
        <div class="p-5 rounded-2xl bg-slate-950 border border-slate-800/80 shadow-sm hover:border-red-500/50 hover:shadow-red-900/20 transition flex flex-col justify-between group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-400">❤️ মোট ফেভারিট</span>
                <span class="p-2 rounded-xl bg-red-950/60 text-red-400 text-sm group-hover:scale-110 transition-transform">🤍</span>
            </div>
            <div class="mt-4">
                <div class="text-2xl sm:text-3xl font-extrabold text-red-400 tracking-tight">
                    {{ number_format($stats['favorites'] ?? 0) }}
                </div>
                <span class="text-[11px] text-slate-400 mt-1 block">
                    সেভ করা কন্টেন্ট
                </span>
            </div>
        </div>

    </div>

    <!-- Quick CMS Management Actions -->
    <div>
        <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-3">দ্রুত কন্টেন্ট অ্যাকশন (Quick Actions)</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            <a href="{{ route('admin.articles.create') }}" class="p-3.5 rounded-2xl bg-slate-950 hover:bg-slate-800/80 border border-slate-800 flex items-center gap-3 text-slate-200 transition group">
                <span class="w-9 h-9 rounded-xl bg-teal-600 text-white flex items-center justify-center text-base group-hover:scale-110 transition-transform font-bold">+</span>
                <div>
                    <div class="font-bold text-white text-xs">নতুন আর্টিকেল লিখুন</div>
                    <div class="text-[11px] text-teal-400">এসইও অপটিমাইজড ব্লগ</div>
                </div>
            </a>

            <a href="{{ route('admin.duas.create') }}" class="p-3.5 rounded-2xl bg-slate-950 hover:bg-slate-800/80 border border-slate-800 flex items-center gap-3 text-slate-200 transition group">
                <span class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-base group-hover:scale-110 transition-transform font-bold">+</span>
                <div>
                    <div class="font-bold text-white text-xs">নতুন দু'আ যুক্ত করুন</div>
                    <div class="text-[11px] text-emerald-400">আরবি ও অর্থসহ</div>
                </div>
            </a>

            <a href="{{ route('admin.surahs.create') }}" class="p-3.5 rounded-2xl bg-slate-950 hover:bg-slate-800/80 border border-slate-800 flex items-center gap-3 text-slate-200 transition group">
                <span class="w-9 h-9 rounded-xl bg-amber-600 text-white flex items-center justify-center text-base group-hover:scale-110 transition-transform font-bold">+</span>
                <div>
                    <div class="font-bold text-white text-xs">নতুন সূরা যুক্ত করুন</div>
                    <div class="text-[11px] text-amber-400">কুরআন মডিউল</div>
                </div>
            </a>

            <a href="{{ route('admin.islamic-events.create') }}" class="p-3.5 rounded-2xl bg-slate-950 hover:bg-slate-800/80 border border-slate-800 flex items-center gap-3 text-slate-200 transition group">
                <span class="w-9 h-9 rounded-xl bg-purple-600 text-white flex items-center justify-center text-base group-hover:scale-110 transition-transform font-bold">+</span>
                <div>
                    <div class="font-bold text-white text-xs">নতুন দিবস যোগ করুন</div>
                    <div class="text-[11px] text-purple-400">ইসলামিক ক্যালেন্ডার</div>
                </div>
            </a>
        </div>
    </div>

    <!-- 2 Column Data Grid: Recent Articles & Recent Users -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Left Table: Recent Articles (8 Columns) -->
        <div class="lg:col-span-8 p-6 rounded-3xl bg-slate-950 border border-slate-800 flex flex-col justify-between space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800/80 pb-3">
                <div>
                    <h3 class="text-base font-bold text-white flex items-center gap-2">
                        <span>📝</span> <span>সর্বশেষ আর্টিকেলসমূহ (Recent Articles)</span>
                    </h3>
                    <p class="text-xs text-slate-400 mt-0.5">সম্প্রতি প্রকাশিত ও ড্রাফট করা কন্টেন্ট</p>
                </div>
                <a href="{{ route('admin.articles.index') }}" class="text-xs font-semibold text-emerald-400 hover:underline">
                    সকল আর্টিকেল &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-300">
                    <thead class="text-[11px] uppercase bg-slate-900/80 text-slate-400 border-b border-slate-800">
                        <tr>
                            <th class="px-4 py-3">শিরোনাম (Title)</th>
                            <th class="px-4 py-3">ক্যাটাগরি</th>
                            <th class="px-4 py-3 text-center">স্ট্যাটাস</th>
                            <th class="px-4 py-3">তারিখ</th>
                            <th class="px-4 py-3 text-right">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60">
                        @forelse ($recentArticles as $article)
                            <tr class="hover:bg-slate-900/50 transition">
                                <td class="px-4 py-3.5 font-semibold text-white max-w-[220px] truncate">
                                    {{ $article->title }}
                                </td>
                                <td class="px-4 py-3.5 text-slate-400">
                                    {{ $article->category->name_bangla ?? ($article->category->name ?? 'সাধারণ') }}
                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    @if ($article->status === 'published')
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-950 text-emerald-300 border border-emerald-800/60">
                                            Published
                                        </span>
                                    @else
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-950 text-amber-300 border border-amber-800/60">
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 text-slate-400 font-mono text-[11px]">
                                    {{ $article->created_at->format('d M, Y') }}
                                </td>
                                <td class="px-4 py-3.5 text-right space-x-1 whitespace-nowrap">
                                    <a href="{{ route('articles.show', $article) }}" target="_blank" class="px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 text-[11px] text-slate-200 transition">
                                        ভিউ
                                    </a>
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="px-2.5 py-1 rounded-lg bg-emerald-950/80 hover:bg-emerald-900 border border-emerald-800 text-[11px] text-emerald-300 transition">
                                        এডিট
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-slate-500">কোনো আর্টিকেল পাওয়া যায়নি।</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right Table: Recent Users (4 Columns) -->
        <div class="lg:col-span-4 p-6 rounded-3xl bg-slate-950 border border-slate-800 flex flex-col justify-between space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800/80 pb-3">
                <div>
                    <h3 class="text-base font-bold text-white flex items-center gap-2">
                        <span>👤</span> <span>সাম্প্রতিক ইউজার (Recent Users)</span>
                    </h3>
                    <p class="text-xs text-slate-400 mt-0.5">নতুন নিবন্ধিত ব্যবহারকারী</p>
                </div>
            </div>

            <div class="space-y-3">
                @forelse ($recentUsers as $user)
                    <div class="p-3 rounded-2xl bg-slate-900/60 border border-slate-800/60 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-700 to-teal-600 text-white flex items-center justify-center text-xs font-bold shrink-0 uppercase">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="min-w-0">
                                <div class="text-xs font-bold text-white truncate">{{ $user->name }}</div>
                                <div class="text-[11px] text-slate-400 truncate font-mono">{{ $user->email }}</div>
                            </div>
                        </div>

                        <div class="text-right shrink-0">
                            @if ($user->isAdmin())
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-950 text-amber-300 border border-amber-800/60">
                                    Admin
                                </span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-slate-800 text-slate-300">
                                    User
                                </span>
                            @endif
                            <div class="text-[10px] text-slate-500 mt-1">{{ $user->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-xs text-slate-500">কোনো ইউজার পাওয়া যায়নি।</div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
