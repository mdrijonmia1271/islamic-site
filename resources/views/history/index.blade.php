@extends('layouts.app')

@section('title', 'পড়ার ইতিহাস (Reading History) — Islamic Site')
@section('meta_description', 'আপনার সাম্প্রতিক পঠিত ইসলামিক প্রবন্ধ, সহিহ হাদিস, দু\'আ ও কুরআন আয়াতের ইতিহাস।')

@section('content')
<div class="bg-slate-50 dark:bg-gray-950 min-h-screen pb-20">

    <!-- Hero Header -->
    <section class="relative overflow-hidden bg-gradient-to-b from-teal-950 via-slate-950 to-slate-950 text-white py-12 sm:py-16 border-b border-teal-900/40">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#14b8a6_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
            <span class="text-3xl sm:text-4xl text-amber-300 font-serif block" style="font-family: 'Amiri', serif;">
                سِجِلُّ القِرَاءَةِ
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight flex items-center justify-center gap-3">
                <span>📖</span> <span>পড়ার <span class="bg-gradient-to-r from-teal-400 to-amber-300 bg-clip-text text-transparent">ইতিহাস</span></span>
            </h1>
            <p class="text-xs sm:text-sm text-teal-200/90 max-w-xl mx-auto leading-relaxed">
                আপনার সাম্প্রতিক পঠিত সকল ইসলামিক প্রবন্ধ, সহিহ হাদিস, দু'আ ও পবিত্র কুরআনের আয়াতের সময়ানুক্রমিক তালিকা।
            </p>

            @if($history->count() > 0)
                <div class="pt-2">
                    <form method="POST" action="{{ route('history.clear') }}" onsubmit="return confirm('আপনি কি নিশ্চিত যে সম্পূর্ণ পড়ার ইতিহাস মুছে ফেলতে চান?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-red-950/60 border border-red-800/80 text-red-300 hover:bg-red-900/80 text-xs font-semibold transition shadow-sm">
                            <span>🗑️</span>
                            <span>সকল ইতিহাস মুছুন</span>
                        </button>
                    </form>
                </div>
            @endif
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
            <a href="{{ route('history.index', ['type' => 'all']) }}" 
               class="px-4 py-2 rounded-2xl text-xs sm:text-sm font-bold whitespace-nowrap transition border {{ ($type ?? 'all') === 'all' ? 'bg-teal-600 text-white border-teal-600 shadow-md shadow-teal-600/30' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-teal-500' }}">
                সকল পড়া ({{ $counts['all'] ?? 0 }})
            </a>
            <a href="{{ route('history.index', ['type' => 'article']) }}" 
               class="px-4 py-2 rounded-2xl text-xs sm:text-sm font-bold whitespace-nowrap transition border {{ ($type ?? '') === 'article' ? 'bg-teal-600 text-white border-teal-600 shadow-md' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-teal-500' }}">
                ✍️ আর্টিকেল ({{ $counts['article'] ?? 0 }})
            </a>
            <a href="{{ route('history.index', ['type' => 'dua']) }}" 
               class="px-4 py-2 rounded-2xl text-xs sm:text-sm font-bold whitespace-nowrap transition border {{ ($type ?? '') === 'dua' ? 'bg-teal-600 text-white border-teal-600 shadow-md' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-teal-500' }}">
                🤲 দু'আ ও আযকার ({{ $counts['dua'] ?? 0 }})
            </a>
            <a href="{{ route('history.index', ['type' => 'hadith']) }}" 
               class="px-4 py-2 rounded-2xl text-xs sm:text-sm font-bold whitespace-nowrap transition border {{ ($type ?? '') === 'hadith' ? 'bg-teal-600 text-white border-teal-600 shadow-md' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-teal-500' }}">
                📚 সহিহ হাদিস ({{ $counts['hadith'] ?? 0 }})
            </a>
            @if(($counts['ayah'] ?? 0) > 0)
                <a href="{{ route('history.index', ['type' => 'ayah']) }}" 
                   class="px-4 py-2 rounded-2xl text-xs sm:text-sm font-bold whitespace-nowrap transition border {{ ($type ?? '') === 'ayah' ? 'bg-teal-600 text-white border-teal-600 shadow-md' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-teal-500' }}">
                    📖 কুরআন আয়াত ({{ $counts['ayah'] ?? 0 }})
                </a>
            @endif
        </div>

        <!-- History Timeline Grid -->
        @if ($history->count() > 0)
            <div class="space-y-4">
                @foreach ($history as $item)
                    @php
                        $readable = $item->readable;
                    @endphp

                    @if ($readable)
                        <div class="p-5 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md hover:border-teal-500/40 transition duration-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 group">
                            
                            <!-- Left: Type Badge & Content Summary -->
                            <div class="flex items-start gap-4 flex-grow">
                                <div class="w-10 h-10 rounded-2xl flex-shrink-0 flex items-center justify-center text-lg {{ 
                                    $item->readable_type === \App\Models\Article::class ? 'bg-teal-100 dark:bg-teal-950 text-teal-700 dark:text-teal-300' :
                                    ($item->readable_type === \App\Models\Dua::class ? 'bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300' :
                                    ($item->readable_type === \App\Models\Hadith::class ? 'bg-purple-100 dark:bg-purple-950 text-purple-700 dark:text-purple-300' :
                                    'bg-amber-100 dark:bg-amber-950 text-amber-700 dark:text-amber-300'))
                                }}">
                                    @if ($item->readable_type === \App\Models\Article::class)
                                        ✍️
                                    @elseif ($item->readable_type === \App\Models\Dua::class)
                                        🤲
                                    @elseif ($item->readable_type === \App\Models\Hadith::class)
                                        📚
                                    @else
                                        📖
                                    @endif
                                </div>

                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                            @if ($item->readable_type === \App\Models\Article::class)
                                                প্রবন্ধ (Article)
                                            @elseif ($item->readable_type === \App\Models\Dua::class)
                                                দোয়া (Dua)
                                            @elseif ($item->readable_type === \App\Models\Hadith::class)
                                                সহিহ হাদিস (Hadith)
                                            @else
                                                কুরআন আয়াত (Quran Ayah)
                                            @endif
                                        </span>
                                        <span class="text-gray-300 dark:text-gray-700">&bull;</span>
                                        <span class="text-[11px] text-teal-600 dark:text-teal-400 font-medium">
                                            🕒 {{ $item->last_read_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    @if ($item->readable_type === \App\Models\Article::class)
                                        <h4 class="text-base font-bold text-gray-900 dark:text-white group-hover:text-teal-600 dark:group-hover:text-teal-400 transition">
                                            {{ $readable->title }}
                                        </h4>
                                        @if ($readable->excerpt)
                                            <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1">
                                                {{ $readable->excerpt }}
                                            </p>
                                        @endif

                                    @elseif ($item->readable_type === \App\Models\Dua::class)
                                        <h4 class="text-base font-bold text-gray-900 dark:text-white">
                                            {{ $readable->title_bangla ?? $readable->title }}
                                        </h4>
                                        @if ($readable->bangla_meaning)
                                            <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1">
                                                {{ $readable->bangla_meaning }}
                                            </p>
                                        @endif

                                    @elseif ($item->readable_type === \App\Models\Hadith::class)
                                        <h4 class="text-sm font-bold text-purple-700 dark:text-purple-400">
                                            {{ $readable->book?->name_bangla ?? $readable->book?->name }} (হাদিস নং #{{ $readable->hadith_number }})
                                        </h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1">
                                            {{ Str::limit($readable->bangla_text, 100) }}
                                        </p>

                                    @elseif ($item->readable_type === \App\Models\Ayah::class)
                                        <h4 class="text-xs font-bold text-amber-600 dark:text-amber-400">
                                            সূরা {{ $readable->surah?->name_bangla ?? $readable->surah?->name_english }} (আয়াত {{ $readable->ayah_number }})
                                        </h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1">
                                            {{ $readable->bangla_text }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Right: Actions (Direct Link & Delete) -->
                            <div class="flex items-center gap-3 self-end sm:self-center flex-shrink-0">
                                @if ($item->readable_type === \App\Models\Article::class)
                                    <a href="{{ route('articles.show', $readable) }}" class="px-4 py-2 rounded-xl bg-teal-50 dark:bg-teal-950/60 text-teal-700 dark:text-teal-300 text-xs font-bold hover:bg-teal-100 transition flex items-center gap-1 shadow-sm">
                                        <span>পড়ুন &rarr;</span>
                                    </a>
                                @elseif ($item->readable_type === \App\Models\Dua::class)
                                    <a href="{{ $readable->category ? route('duas.category', $readable->category) : route('duas.index') }}" class="px-4 py-2 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 text-xs font-bold hover:bg-emerald-100 transition flex items-center gap-1 shadow-sm">
                                        <span>দেখুন &rarr;</span>
                                    </a>
                                @elseif ($item->readable_type === \App\Models\Hadith::class)
                                    <a href="{{ route('hadith.show', $readable->book?->slug ?? $readable->hadith_book_id) }}" class="px-4 py-2 rounded-xl bg-purple-50 dark:bg-purple-950/60 text-purple-700 dark:text-purple-300 text-xs font-bold hover:bg-purple-100 transition flex items-center gap-1 shadow-sm">
                                        <span>দেখুন &rarr;</span>
                                    </a>
                                @elseif ($item->readable_type === \App\Models\Ayah::class)
                                    <a href="{{ route('quran.show', $readable->surah?->number ?? 1) }}" class="px-4 py-2 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 text-xs font-bold hover:bg-amber-100 transition flex items-center gap-1 shadow-sm">
                                        <span>দেখুন &rarr;</span>
                                    </a>
                                @endif

                                <!-- Delete single history item form -->
                                <form method="POST" action="{{ route('history.destroy', $item->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="ইতিহাস থেকে মুছুন" 
                                            class="p-2 rounded-xl text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-950/50 transition">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endif
                @endforeach
            </div>

            <div class="pt-8">
                {{ $history->links() }}
            </div>

        @else
            <!-- Empty History State -->
            <div class="text-center py-16 px-4 rounded-3xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm space-y-4 max-w-2xl mx-auto">
                <div class="w-20 h-20 mx-auto rounded-full bg-teal-100 dark:bg-teal-950 text-teal-600 flex items-center justify-center text-4xl shadow-inner">
                    📖
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">এখনো কোনো পড়ার ইতিহাস নেই</h3>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                    আপনি যখন ওয়েবসাইট থেকে কোনো আর্টিকেল বা কুরআনের আয়াত পড়বেন, তা এখানে স্বয়ংক্রিয়ভাবে সংরক্ষিত হবে যাতে পরবর্তীতে সহজেই খুঁজে পেতে পারেন।
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
