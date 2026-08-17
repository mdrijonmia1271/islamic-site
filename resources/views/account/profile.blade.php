@extends('layouts.app')

@section('title', 'আমার অ্যাকাউন্ট (My Account) — Islamic Site')
@section('meta_description', 'ব্যবহারকারী অ্যাকাউন্ট ওভারভিউ ও সংরক্ষিত কন্টেন্ট প্যানেল।')

@section('content')
<div class="bg-slate-50 dark:bg-gray-950 min-h-screen pb-20">

    <!-- Hero Header -->
    <section class="relative overflow-hidden bg-gradient-to-b from-emerald-950 via-teal-950 to-slate-950 text-white py-12 sm:py-16 border-b border-emerald-900/40">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-3">
            <span class="text-3xl sm:text-4xl text-amber-300 font-serif block" style="font-family: 'Amiri', serif;">
                حِسَابِي الشَّخْصِي
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight flex items-center justify-center gap-3">
                <span>👤</span> <span>আমার <span class="bg-gradient-to-r from-emerald-400 to-amber-300 bg-clip-text text-transparent">অ্যাকাউন্ট ওভারভিউ</span></span>
            </h1>
            <p class="text-xs sm:text-sm text-emerald-200/90 max-w-xl mx-auto">
                আসসালামু আলাইকুম, <strong>{{ $user->name }}</strong>! আপনার ইসলামিক প্ল্যাটফর্ম প্রোফাইল ও সংরক্ষিত তালিকা।
            </p>
        </div>
    </section>

    <!-- Main Content Area -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-20 space-y-8">

        <!-- User Profile Card -->
        <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-xl flex flex-col sm:flex-row items-center sm:items-start justify-between gap-6">
            <div class="flex flex-col sm:flex-row items-center gap-5 text-center sm:text-left">
                <div class="w-20 h-20 rounded-3xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white font-extrabold text-3xl flex items-center justify-center shadow-lg shadow-emerald-600/30 uppercase shrink-0">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div class="space-y-1">
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                        @if($user->isAdmin())
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-800/60">
                                👑 Admin
                            </span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/60">
                                👤 Member
                            </span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-mono">{{ $user->email }}</p>
                    <p class="text-xs text-gray-400">যোগদানের তারিখ: {{ $user->created_at->format('d M, Y') }} ({{ $user->created_at->diffForHumans() }})</p>
                </div>
            </div>

            <!-- Profile Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-2">
                @if($user->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold transition shadow-md">
                        👑 Admin Panel
                    </a>
                @endif
                <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-gray-800 hover:bg-slate-200 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-bold transition border border-gray-200 dark:border-gray-700">
                    ⚙️ সেটিংস এডিট
                </a>
            </div>
        </div>

        <!-- Stats & Quick Navigation Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Favorites Card -->
            <a href="{{ route('favorites.index') }}" class="p-6 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-lg hover:border-red-400/50 transition group flex flex-col justify-between">
                <div class="space-y-2">
                    <div class="w-12 h-12 rounded-2xl bg-red-50 dark:bg-red-950/60 text-red-600 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                        ❤️
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">সংরক্ষিত তালিকা</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">আপনার পছন্দের সকল দোয়া, হাদিস ও আর্টিকেল</p>
                </div>
                <div class="pt-4 mt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <span class="text-2xl font-black text-red-600 dark:text-red-400 font-mono">{{ $favoritesCount }}</span>
                    <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 group-hover:translate-x-1 transition-transform">তালিকা দেখুন &rarr;</span>
                </div>
            </a>

            <!-- Duas Shortcut -->
            <a href="{{ route('duas.index') }}" class="p-6 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-lg hover:border-emerald-500/40 transition group flex flex-col justify-between">
                <div class="space-y-2">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                        🤲
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">দোয়া ও আযকার</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">দৈনন্দিন জীবনের প্রয়োজনীয় মাসনূন দোয়া</p>
                </div>
                <div class="pt-4 mt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <span class="text-xs text-gray-400">সকল ক্যাটাগরি</span>
                    <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 group-hover:translate-x-1 transition-transform">পড়ুন &rarr;</span>
                </div>
            </a>

            <!-- Articles Shortcut -->
            <a href="{{ route('articles.index') }}" class="p-6 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-lg hover:border-teal-500/40 transition group flex flex-col justify-between">
                <div class="space-y-2">
                    <div class="w-12 h-12 rounded-2xl bg-teal-50 dark:bg-teal-950/60 text-teal-600 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                        ✍️
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">ইসলামিক প্রবন্ধ</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">জীবনঘনিষ্ঠ প্রামাণ্য ইসলামিক গাইডলাইন</p>
                </div>
                <div class="pt-4 mt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <span class="text-xs text-gray-400">সর্বশেষ বিষয়াবলি</span>
                    <span class="text-xs font-bold text-teal-600 dark:text-teal-400 group-hover:translate-x-1 transition-transform">ব্রাউজ করুন &rarr;</span>
                </div>
            </a>
        </div>

        <!-- Recent Favorites Preview -->
        @if($recentFavorites->count() > 0)
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 pb-3">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <span>❤️</span>
                        <span>সম্প্রতি সংরক্ষিত বিষয়সমূহ (Recent Favorites)</span>
                    </h3>
                    <a href="{{ route('favorites.index') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                        সবগুলো দেখুন ({{ $favoritesCount }}) &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($recentFavorites as $fav)
                        @php $favItem = $fav->favoritable; @endphp
                        @if($favItem)
                            <div class="p-5 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex items-center justify-between gap-4">
                                <div class="space-y-1 min-w-0">
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400">
                                        {{ match($fav->favoritable_type) {
                                            \App\Models\Article::class => '✍️ আর্টিকেল',
                                            \App\Models\Dua::class => '🤲 দোয়া',
                                            \App\Models\Hadith::class => '📚 হাদিস',
                                            default => 'কন্টেন্ট'
                                        } }}
                                    </span>
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white truncate">
                                        {{ $favItem->title_bangla ?? ($favItem->title ?? ($favItem->book?->name ?? 'ইসলামিক বিষয়')) }}
                                    </h4>
                                    <span class="text-[11px] text-gray-400 block">{{ $fav->created_at->diffForHumans() }}</span>
                                </div>

                                <a href="{{ match($fav->favoritable_type) {
                                    \App\Models\Article::class => route('articles.show', $favItem),
                                    \App\Models\Dua::class => ($favItem->category ? route('duas.category', $favItem->category) : route('duas.index')),
                                    \App\Models\Hadith::class => route('hadith.show', $favItem->book?->slug ?? $favItem->hadith_book_id),
                                    default => '#'
                                } }}" class="px-3 py-1.5 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 text-xs font-bold hover:bg-emerald-100 transition whitespace-nowrap">
                                    দেখুন &rarr;
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
