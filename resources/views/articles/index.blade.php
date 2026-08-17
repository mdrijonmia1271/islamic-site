@extends('layouts.app')

@section('title', $currentCategory ? (($currentCategory->name_bangla ?? $currentCategory->name) . ' - ইসলামিক প্রবন্ধ') : 'ইসলামিক প্রবন্ধ ও নির্দেশিকা — Islamic Site')

@section('content')
    <!-- Article Hero Header -->
    <section class="relative overflow-hidden bg-gradient-to-b from-emerald-950 via-teal-950 to-slate-950 text-white py-14 sm:py-20 border-b border-emerald-900/40">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="text-3xl sm:text-4xl text-amber-300 font-serif block mb-3" style="font-family: 'Amiri', serif;">
                مَقَالَاتٌ إِسْلَامِيَّةٌ
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight mb-4">
                ইসলামিক <span class="bg-gradient-to-r from-emerald-400 to-amber-300 bg-clip-text text-transparent">প্রবন্ধ ও দিকনির্দেশনা</span>
            </h1>
            <p class="max-w-2xl mx-auto text-sm sm:text-base text-emerald-200/90 leading-relaxed">
                কোরআন ও সুন্নাহর আলোকে প্রয়োজনীয় ইসলামিক প্রবন্ধ, রমজান, যাকাত, সালাত, দোয়ার মাসআলা ও জীবনঘনিষ্ঠ নির্দেশিকা।
            </p>

            <!-- Search Bar in Hero -->
            <div class="mt-8 max-w-xl mx-auto">
                <form method="GET" action="{{ route('articles.index') }}" class="relative flex items-center">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="কী বিষয়ে জানতে চান? (যেমন: রোজা, যাকাত, তাহাজ্জুদ...)" 
                           class="w-full pl-5 pr-28 py-3.5 rounded-2xl bg-white/10 dark:bg-gray-900/80 backdrop-blur-md border border-emerald-500/30 text-white placeholder-emerald-200/60 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:bg-slate-900/90 transition shadow-lg">
                    <button type="submit" class="absolute right-2 px-5 py-2 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-white text-xs font-bold tracking-wide shadow-md transition">
                        অনুসন্ধান
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-12 bg-slate-50 dark:bg-gray-950 min-h-[600px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- Category Pills / Filter Tabs -->
            <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
                <a href="{{ route('articles.index', request()->only('search')) }}" 
                   class="px-4 py-2 rounded-full text-xs font-semibold whitespace-nowrap transition border {{ !request('category') ? 'bg-emerald-600 text-white border-emerald-600 shadow-md shadow-emerald-600/30' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-emerald-500 hover:text-emerald-600' }}">
                    🌟 সকল ক্যাটাগরি
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('articles.index', array_merge(request()->only('search'), ['category' => $category->slug])) }}" 
                       class="px-4 py-2 rounded-full text-xs font-semibold whitespace-nowrap transition border {{ request('category') === $category->slug ? 'bg-emerald-600 text-white border-emerald-600 shadow-md shadow-emerald-600/30' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-emerald-500 hover:text-emerald-600' }}">
                        {{ $category->name_bangla ?? $category->name }}
                        @if($category->articles_count)
                            <span class="ml-1 text-[10px] opacity-75">({{ $category->articles_count }})</span>
                        @endif
                    </a>
                @endforeach
            </div>

            <!-- Active Filter Indication / Result Header -->
            @if(request('category') || request('search'))
                <div class="flex items-center justify-between p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-900/50">
                    <div class="text-sm text-emerald-900 dark:text-emerald-200">
                        @if($currentCategory)
                            ক্যাটাগরি: <strong class="font-bold text-emerald-700 dark:text-emerald-400">{{ $currentCategory->name_bangla ?? $currentCategory->name }}</strong>
                        @endif
                        @if(request('search'))
                            <span class="ml-2">অনুসন্ধান ফলাফল: "<strong class="text-emerald-700 dark:text-emerald-400">{{ request('search') }}</strong>"</span>
                        @endif
                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">({{ $articles->total() }} টি আর্টিকেল পাওয়া গেছে)</span>
                    </div>
                    <a href="{{ route('articles.index') }}" class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline">
                        ফিল্টার মুছুন &times;
                    </a>
                </div>
            @endif

            <!-- Articles Grid -->
            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($articles as $article)
                        <article class="flex flex-col bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 overflow-hidden shadow-sm hover:shadow-xl hover:border-emerald-500/40 hover:-translate-y-1 transition duration-300 group">
                            
                            <!-- Thumbnail / Image -->
                            <a href="{{ route('articles.show', $article) }}" class="relative block aspect-[16/9] overflow-hidden bg-slate-900">
                                @if($article->featured_image)
                                    <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                         alt="{{ $article->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-emerald-900/80 via-teal-900/60 to-slate-950 flex items-center justify-center relative group-hover:scale-105 transition duration-500">
                                        <div class="w-16 h-16 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-3xl text-emerald-400">
                                            📖
                                        </div>
                                        <span class="absolute bottom-3 right-3 text-xs text-emerald-300/60 font-serif" style="font-family: 'Amiri', serif;">
                                            اقْرَأْ
                                        </span>
                                    </div>
                                @endif

                                <!-- Category Badge on Thumbnail -->
                                @if($article->category)
                                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-600/90 backdrop-blur-md text-white shadow-md">
                                        {{ $article->category->name_bangla ?? $article->category->name }}
                                    </span>
                                @endif
                            </a>

                            <!-- Card Body -->
                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                                <div class="space-y-2.5">
                                    <!-- Meta Info -->
                                    <div class="flex items-center gap-3 text-xs text-gray-500 dark:text-gray-400 font-medium">
                                        @if($article->published_at)
                                            <span class="flex items-center gap-1">
                                                <span>🗓️</span> {{ $article->published_at->format('d M, Y') }}
                                            </span>
                                        @endif
                                        @if($article->views > 0)
                                            <span class="flex items-center gap-1">
                                                <span>👁️</span> {{ number_format($article->views) }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Title -->
                                    <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-2 leading-snug">
                                        <a href="{{ route('articles.show', $article) }}">
                                            {{ $article->title }}
                                        </a>
                                    </h2>

                                    <!-- Excerpt -->
                                    @if($article->excerpt)
                                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 line-clamp-3 leading-relaxed">
                                            {{ $article->excerpt }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Read More Link -->
                                <div class="pt-3 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                                        সম্পূর্ণ পড়ুন &rarr;
                                    </span>
                                    <span class="text-[11px] text-gray-400">৩ মিনিট পাঠ</span>
                                </div>
                            </div>

                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pt-6">
                    {{ $articles->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="p-12 text-center rounded-3xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 space-y-4 shadow-sm">
                    <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 flex items-center justify-center text-3xl">
                        🔍
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">কোনো আর্টিকেল পাওয়া যায়নি</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                        আপনার অনুসন্ধানের সাথে মিলে এমন কোনো প্রকাশিত আর্টিকেল খুঁজে পাওয়া যায়নি। দয়া করে অন্য কোনো কীওয়ার্ড ব্যবহার করে চেষ্টা করুন।
                    </p>
                    <a href="{{ route('articles.index') }}" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition shadow-md">
                        সকল আর্টিকেল দেখুন
                    </a>
                </div>
            @endif

        </div>
    </section>
@endsection
