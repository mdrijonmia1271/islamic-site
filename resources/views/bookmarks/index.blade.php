@extends('layouts.app')

@section('title', 'আমার বুকমার্কসমূহ (My Bookmarks) — Islamic Site')
@section('meta_description', 'পরে পড়ার জন্য বুকমার্ক করা আপনার সকল ইসলামিক কন্টেন্টের তালিকা।')

@section('content')
<div class="bg-slate-50 dark:bg-gray-950 min-h-screen pb-20">

    <!-- Hero Header -->
    <section class="relative overflow-hidden bg-gradient-to-b from-teal-950 via-slate-950 to-slate-950 text-white py-12 sm:py-16 border-b border-teal-900/40">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#14b8a6_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
            <span class="text-3xl sm:text-4xl text-amber-300 font-serif block" style="font-family: 'Amiri', serif;">
                الإِشَارَاتُ المَرْجِعِيَّةُ
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight flex items-center justify-center gap-3">
                <span>🔖</span> <span>আমার <span class="bg-gradient-to-r from-teal-400 to-amber-300 bg-clip-text text-transparent">বুকমার্কসমূহ</span></span>
            </h1>
            <p class="text-xs sm:text-sm text-teal-200/90 max-w-xl mx-auto leading-relaxed">
                পরবর্তীতে মনোযোগ দিয়ে পড়ার জন্য সংরক্ষিত আপনার সকল ইসলামিক প্রবন্ধ, সহিহ হাদিস, দু'আ ও কুরআনের আয়াত।
            </p>
        </div>
    </section>

    <!-- Main Content Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Flash Success Message -->
        @if (session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-teal-100 dark:bg-teal-950/80 border border-teal-300 dark:border-teal-800 text-teal-800 dark:text-teal-200 text-sm font-semibold flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2">
                    <span>✅</span>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-teal-600 hover:text-teal-800 text-lg leading-none">&times;</button>
            </div>
        @endif

        <!-- Filter Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-6 scrollbar-none border-b border-gray-200 dark:border-gray-800">
            <a href="{{ route('bookmarks.index', ['type' => 'all']) }}" 
               class="px-4 py-2 rounded-2xl text-xs sm:text-sm font-bold whitespace-nowrap transition border {{ ($type ?? 'all') === 'all' ? 'bg-teal-600 text-white border-teal-600 shadow-md shadow-teal-600/30' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-teal-500' }}">
                সকল বুকমার্ক ({{ $counts['all'] ?? 0 }})
            </a>
            <a href="{{ route('bookmarks.index', ['type' => 'article']) }}" 
               class="px-4 py-2 rounded-2xl text-xs sm:text-sm font-bold whitespace-nowrap transition border {{ ($type ?? '') === 'article' ? 'bg-teal-600 text-white border-teal-600 shadow-md' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-teal-500' }}">
                ✍️ আর্টিকেল ({{ $counts['article'] ?? 0 }})
            </a>
            <a href="{{ route('bookmarks.index', ['type' => 'dua']) }}" 
               class="px-4 py-2 rounded-2xl text-xs sm:text-sm font-bold whitespace-nowrap transition border {{ ($type ?? '') === 'dua' ? 'bg-teal-600 text-white border-teal-600 shadow-md' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-teal-500' }}">
                🤲 দু'আ ও আযকার ({{ $counts['dua'] ?? 0 }})
            </a>
            <a href="{{ route('bookmarks.index', ['type' => 'hadith']) }}" 
               class="px-4 py-2 rounded-2xl text-xs sm:text-sm font-bold whitespace-nowrap transition border {{ ($type ?? '') === 'hadith' ? 'bg-teal-600 text-white border-teal-600 shadow-md' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-teal-500' }}">
                📚 সহিহ হাদিস ({{ $counts['hadith'] ?? 0 }})
            </a>
            @if(($counts['ayah'] ?? 0) > 0)
                <a href="{{ route('bookmarks.index', ['type' => 'ayah']) }}" 
                   class="px-4 py-2 rounded-2xl text-xs sm:text-sm font-bold whitespace-nowrap transition border {{ ($type ?? '') === 'ayah' ? 'bg-teal-600 text-white border-teal-600 shadow-md' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-teal-500' }}">
                    📖 কুরআন আয়াত ({{ $counts['ayah'] ?? 0 }})
                </a>
            @endif
        </div>

        <!-- Bookmarks Cards Grid -->
        @if ($bookmarks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($bookmarks as $bookmark)
                    @php
                        $item = $bookmark->bookmarkable;
                    @endphp

                    @if ($item)
                        <div class="p-6 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-lg hover:border-teal-500/40 transition duration-200 flex flex-col justify-between group space-y-4">
                            
                            <!-- Card Header: Type Badge & Remove Form -->
                            <div class="flex items-center justify-between">
                                @if ($bookmark->bookmarkable_type === \App\Models\Article::class)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-teal-100 dark:bg-teal-950 text-teal-700 dark:text-teal-300">
                                        ✍️ আর্টিকেল
                                    </span>
                                @elseif ($bookmark->bookmarkable_type === \App\Models\Dua::class)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">
                                        🤲 দোয়া
                                    </span>
                                @elseif ($bookmark->bookmarkable_type === \App\Models\Hadith::class)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-purple-100 dark:bg-purple-950 text-purple-700 dark:text-purple-300">
                                        📚 হাদিস
                                    </span>
                                @elseif ($bookmark->bookmarkable_type === \App\Models\Ayah::class)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 dark:bg-amber-950 text-amber-700 dark:text-amber-300">
                                        📖 আয়াত
                                    </span>
                                @endif

                                <!-- Remove Bookmark Button Form -->
                                <form method="POST" action="{{ route('bookmark.destroy') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="type" value="{{ match($bookmark->bookmarkable_type) {
                                        \App\Models\Article::class => 'article',
                                        \App\Models\Dua::class => 'dua',
                                        \App\Models\Hadith::class => 'hadith',
                                        \App\Models\Ayah::class => 'ayah',
                                        default => 'article'
                                    } }}">
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" title="বুকমার্ক থেকে সরান" 
                                            class="p-1.5 rounded-xl text-gray-400 hover:text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-950/50 transition">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                    </button>
                                </form>
                            </div>

                            <!-- Card Body: Content based on Type -->
                            <div class="space-y-2">
                                @if ($bookmark->bookmarkable_type === \App\Models\Article::class)
                                    <h4 class="text-base font-bold text-gray-900 dark:text-white line-clamp-2">
                                        {{ $item->title }}
                                    </h4>
                                    @if ($item->excerpt)
                                        <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2 leading-relaxed">
                                            {{ $item->excerpt }}
                                        </p>
                                    @endif

                                @elseif ($bookmark->bookmarkable_type === \App\Models\Dua::class)
                                    <h4 class="text-base font-bold text-gray-900 dark:text-white">
                                        {{ $item->title_bangla ?? $item->title }}
                                    </h4>
                                    @if ($item->arabic_text)
                                        <p dir="rtl" class="text-right text-base text-emerald-800 dark:text-emerald-300 font-serif leading-loose" style="font-family: 'Amiri', serif;">
                                            {{ Str::limit($item->arabic_text, 90) }}
                                        </p>
                                    @endif
                                    @if ($item->bangla_meaning)
                                        <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2">
                                            {{ $item->bangla_meaning }}
                                        </p>
                                    @endif

                                @elseif ($bookmark->bookmarkable_type === \App\Models\Hadith::class)
                                    <h4 class="text-sm font-bold text-purple-700 dark:text-purple-400">
                                        {{ $item->book?->name_bangla ?? $item->book?->name }} (হাদিস নং {{ $item->hadith_number }})
                                    </h4>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-3 leading-relaxed">
                                        {{ Str::limit($item->bangla_text, 140) }}
                                    </p>

                                @elseif ($bookmark->bookmarkable_type === \App\Models\Ayah::class)
                                    <h4 class="text-xs font-bold text-amber-600 dark:text-amber-400">
                                        সূরা {{ $item->surah?->name_bangla ?? $item->surah?->name_english }} (আয়াত {{ $item->ayah_number }})
                                    </h4>
                                    <p dir="rtl" class="text-right text-sm text-gray-800 dark:text-emerald-200 font-serif" style="font-family: 'Amiri', serif;">
                                        {{ Str::limit($item->arabic_text, 70) }}
                                    </p>
                                @endif
                            </div>

                            <!-- Card Footer: Direct Link Button -->
                            <div class="pt-3 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between text-xs">
                                <span class="text-[11px] text-gray-400">
                                    {{ $bookmark->created_at->diffForHumans() }}
                                </span>

                                @if ($bookmark->bookmarkable_type === \App\Models\Article::class)
                                    <a href="{{ route('articles.show', $item) }}" class="text-xs font-bold text-teal-600 dark:text-teal-400 hover:underline flex items-center gap-1">
                                        পড়া চালিয়ে যান &rarr;
                                    </a>
                                @elseif ($bookmark->bookmarkable_type === \App\Models\Dua::class)
                                    <a href="{{ $item->category ? route('duas.category', $item->category) : route('duas.index') }}" class="text-xs font-bold text-teal-600 dark:text-teal-400 hover:underline flex items-center gap-1">
                                        দোয়াটি দেখুন &rarr;
                                    </a>
                                @elseif ($bookmark->bookmarkable_type === \App\Models\Hadith::class)
                                    <a href="{{ route('hadith.show', $item->book?->slug ?? $item->hadith_book_id) }}" class="text-xs font-bold text-teal-600 dark:text-teal-400 hover:underline flex items-center gap-1">
                                        হাদিসটি দেখুন &rarr;
                                    </a>
                                @elseif ($bookmark->bookmarkable_type === \App\Models\Ayah::class)
                                    <a href="{{ route('quran.show', $item->surah?->number ?? 1) }}" class="text-xs font-bold text-teal-600 dark:text-teal-400 hover:underline flex items-center gap-1">
                                        সূরা দেখুন &rarr;
                                    </a>
                                @endif
                            </div>

                        </div>
                    @endif
                @endforeach
            </div>

            <div class="pt-8">
                {{ $bookmarks->links() }}
            </div>

        @else
            <!-- Empty Bookmarks State -->
            <div class="text-center py-16 px-4 rounded-3xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm space-y-4 max-w-2xl mx-auto">
                <div class="w-20 h-20 mx-auto rounded-full bg-amber-100 dark:bg-amber-950 text-amber-500 flex items-center justify-center text-4xl shadow-inner">
                    🔖
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">এখনো কোনো কন্টেন্ট বুকমার্ক করা হয়নি</h3>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                    যেসব আর্টিকেল, হাদিস বা দোয়া আপনি পরবর্তীতে পড়তে চান, সেগুলোতে 🔖 বুকমার্ক বাটনে ক্লিক করে সেভ করে রাখুন।
                </p>

                <div class="flex flex-wrap items-center justify-center gap-3 pt-4">
                    <a href="{{ route('articles.index') }}" class="px-4 py-2 rounded-xl bg-teal-600 hover:bg-teal-500 text-white text-xs font-bold transition shadow-md">
                        ✍️ প্রবন্ধসমূহ পড়ুন
                    </a>
                    <a href="{{ route('quran.index') }}" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-bold transition">
                        📖 আল-কুরআন
                    </a>
                    <a href="{{ route('hadith.index') }}" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-bold transition">
                        📚 সহিহ হাদিস
                    </a>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
