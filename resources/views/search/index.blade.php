@extends('layouts.app')

@section('title', $query ? "অনুসন্ধান ফলাফল: \"{$query}\" — Islamic Site" : 'সার্বিক অনুসন্ধান (Global Search) — Islamic Site')
@section('meta_description', 'কুরআন, সহিহ হাদিস, দৈনন্দিন দোয়া, ইসলামিক প্রবন্ধ ও ক্যালেন্ডার ইভেন্টস এক ক্লিকে সার্বিক অনুসন্ধান করুন।')
@section('meta_robots', 'noindex,follow')

@section('content')
<div class="bg-slate-50 dark:bg-gray-950 min-h-screen pb-20">

    <!-- Search Hero Header -->
    <section class="relative overflow-hidden bg-gradient-to-b from-emerald-950 via-teal-950 to-slate-950 text-white py-14 sm:py-20 border-b border-emerald-900/40">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-6">
            <div>
                <span class="text-3xl sm:text-4xl text-amber-300 font-serif block mb-2" style="font-family: 'Amiri', serif;">
                    البَحْثُ الشَّامِلُ
                </span>
                <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
                    সার্বিক <span class="bg-gradient-to-r from-emerald-400 to-amber-300 bg-clip-text text-transparent">ইসলামিক অনুসন্ধান</span>
                </h1>
                <p class="text-xs sm:text-sm text-emerald-200/90 max-w-xl mx-auto mt-2 leading-relaxed">
                    কুরআনের আয়াত, সহিহ হাদিস, মাসনূন দোয়া, ইসলামিক প্রবন্ধ ও ক্যালেন্ডার ইভেন্টস এক সাথে খুঁজুন।
                </p>
            </div>

            <!-- Main Big Search Box with Live Suggestions (STEP 11 & STEP 12) -->
            <div class="max-w-2xl mx-auto relative" 
                 x-data="{
                    q: '{{ addslashes($query) }}',
                    suggestions: [],
                    loading: false,
                    showDropdown: false,
                    fetchSuggestions() {
                        if (this.q.trim().length < 2) {
                            this.suggestions = [];
                            this.showDropdown = false;
                            return;
                        }
                        this.loading = true;
                        fetch('{{ route('search.suggestions') }}?q=' + encodeURIComponent(this.q))
                            .then(res => res.json())
                            .then(data => {
                                this.suggestions = data;
                                this.showDropdown = data.length > 0;
                                this.loading = false;
                            })
                            .catch(() => { this.loading = false; });
                    }
                 }" 
                 @click.outside="showDropdown = false">
                
                <form method="GET" action="{{ route('search') }}" class="relative flex items-center shadow-2xl rounded-2xl overflow-hidden">
                    <div class="absolute left-4 text-emerald-400 text-lg">
                        🔎
                    </div>
                    <input type="text" name="q" x-model="q" 
                           @input.debounce.300ms="fetchSuggestions()" 
                           @focus="if(suggestions.length > 0) showDropdown = true"
                           placeholder="কী খুঁজতে চান? (যেমন: তাহাজ্জুদ, রোজা, যাকাত, আয়াতুল কুরসী...)" 
                           required autofocus
                           class="w-full pl-12 pr-28 py-4 bg-white/10 dark:bg-gray-900/90 backdrop-blur-md border border-emerald-500/30 text-white placeholder-emerald-200/60 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:bg-slate-900/95 transition">
                    
                    <button type="submit" class="absolute right-2 px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white font-bold text-xs sm:text-sm rounded-xl shadow-md transition">
                        খুঁজুন
                    </button>
                </form>

                <!-- Live Auto-Suggestions Dropdown (STEP 11) -->
                <div x-show="showDropdown && suggestions.length > 0" 
                     x-transition 
                     class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-gray-900 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-800 py-2 z-50 text-left overflow-hidden">
                    <div class="px-4 py-1.5 text-[11px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                        দ্রুত পরামর্শ (Instant Suggestions)
                    </div>
                    <template x-for="item in suggestions" :key="item.url">
                        <a :href="item.url" class="px-4 py-2.5 flex items-center justify-between hover:bg-emerald-50 dark:hover:bg-emerald-950/50 transition group">
                            <div class="flex items-center gap-3">
                                <span x-text="item.icon" class="text-base"></span>
                                <span x-text="item.title" class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition"></span>
                            </div>
                            <span x-text="item.type" class="text-[10px] px-2 py-0.5 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400"></span>
                        </a>
                    </template>
                </div>

                <!-- Quick Suggestion Chips -->
                <div class="flex flex-wrap items-center justify-center gap-2 mt-4 text-xs">
                    <span class="text-emerald-300/80 font-medium">জনপ্রিয় অনুসন্ধান:</span>
                    <a href="{{ route('search', ['q' => 'তাহাজ্জুদ']) }}" class="px-3 py-1 rounded-full bg-emerald-900/60 hover:bg-emerald-800/80 text-emerald-200 border border-emerald-700/50 transition">তাহাজ্জুদ</a>
                    <a href="{{ route('search', ['q' => 'রোজা']) }}" class="px-3 py-1 rounded-full bg-emerald-900/60 hover:bg-emerald-800/80 text-emerald-200 border border-emerald-700/50 transition">রোজা</a>
                    <a href="{{ route('search', ['q' => 'যাকাত']) }}" class="px-3 py-1 rounded-full bg-emerald-900/60 hover:bg-emerald-800/80 text-emerald-200 border border-emerald-700/50 transition">যাকাত</a>
                    <a href="{{ route('search', ['q' => 'আয়াতুল কুরসী']) }}" class="px-3 py-1 rounded-full bg-emerald-900/60 hover:bg-emerald-800/80 text-emerald-200 border border-emerald-700/50 transition">আয়াতুল কুরসী</a>
                    <a href="{{ route('search', ['q' => 'ইস্তিগফার']) }}" class="px-3 py-1 rounded-full bg-emerald-900/60 hover:bg-emerald-800/80 text-emerald-200 border border-emerald-700/50 transition">ইস্তিগফার</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Results Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        @if($query !== '')
            <!-- Search Results Summary Header -->
            <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4 pb-4 border-b border-gray-200 dark:border-gray-800">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">
                        "{{ $query }}" এর জন্য অনুসন্ধান ফলাফল
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">
                        সর্বমোট <strong class="text-emerald-600 dark:text-emerald-400 font-bold">{{ $counts['total'] }}</strong> টি ফলাফল পাওয়া গেছে
                    </p>
                </div>

                <!-- Tabs / Module Filters (STEP 8 & STEP 9) -->
                <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
                    <a href="{{ route('search', ['q' => $query, 'tab' => 'all']) }}" 
                       class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition border {{ $activeTab === 'all' ? 'bg-emerald-600 text-white border-emerald-600 shadow-md shadow-emerald-600/30' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-emerald-500' }}">
                        সকল ({{ $counts['total'] }})
                    </a>
                    @if($counts['surahs'] > 0 || $counts['ayahs'] > 0)
                        <a href="{{ route('search', ['q' => $query, 'tab' => 'quran']) }}" 
                           class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition border {{ $activeTab === 'quran' ? 'bg-emerald-600 text-white border-emerald-600 shadow-md' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-emerald-500' }}">
                            📖 কুরআন ({{ $counts['surahs'] + $counts['ayahs'] }})
                        </a>
                    @endif
                    @if($counts['hadiths'] > 0)
                        <a href="{{ route('search', ['q' => $query, 'tab' => 'hadiths']) }}" 
                           class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition border {{ $activeTab === 'hadiths' ? 'bg-emerald-600 text-white border-emerald-600 shadow-md' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-emerald-500' }}">
                            📚 হাদিস ({{ $counts['hadiths'] }})
                        </a>
                    @endif
                    @if($counts['duas'] > 0)
                        <a href="{{ route('search', ['q' => $query, 'tab' => 'duas']) }}" 
                           class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition border {{ $activeTab === 'duas' ? 'bg-emerald-600 text-white border-emerald-600 shadow-md' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-emerald-500' }}">
                            🤲 দোয়া ({{ $counts['duas'] }})
                        </a>
                    @endif
                    @if($counts['articles'] > 0)
                        <a href="{{ route('search', ['q' => $query, 'tab' => 'articles']) }}" 
                           class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition border {{ $activeTab === 'articles' ? 'bg-emerald-600 text-white border-emerald-600 shadow-md' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-emerald-500' }}">
                            📝 প্রবন্ধ ({{ $counts['articles'] }})
                        </a>
                    @endif
                    @if($counts['events'] > 0)
                        <a href="{{ route('search', ['q' => $query, 'tab' => 'events']) }}" 
                           class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition border {{ $activeTab === 'events' ? 'bg-emerald-600 text-white border-emerald-600 shadow-md' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-emerald-500' }}">
                            📅 দিবস ({{ $counts['events'] }})
                        </a>
                    @endif
                </div>
            </div>

            <!-- When Results Found -->
            @if($counts['total'] > 0)
                <div class="space-y-12">

                    <!-- SECTION 1: Quran Results (STEP 7, 8, 9, 10) -->
                    @if(($activeTab === 'all' || $activeTab === 'quran') && ($counts['surahs'] > 0 || $counts['ayahs'] > 0))
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                    <span class="w-8 h-8 rounded-xl bg-amber-100 dark:bg-amber-950 text-amber-600 flex items-center justify-center text-sm">📖</span>
                                    <span>পবিত্র আল-কুরআন (Quran)</span>
                                    <small class="text-xs text-gray-400 font-normal">({{ $counts['surahs'] + $counts['ayahs'] }} টি ফলাফল)</small>
                                </h3>
                                <a href="{{ route('quran.index') }}" class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline">
                                    সম্পূর্ণ কুরআন &rarr;
                                </a>
                            </div>

                            <!-- Surahs Matching -->
                            @if($surahs->count() > 0)
                                <div class="flex flex-wrap gap-3">
                                    @foreach($surahs as $surah)
                                        <a href="{{ route('quran.show', $surah->number) }}" class="p-3.5 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 hover:border-emerald-500/50 flex items-center gap-3 shadow-sm transition group">
                                            <span class="w-8 h-8 rounded-xl bg-emerald-600 text-white font-bold text-xs flex items-center justify-center">
                                                {{ $surah->number }}
                                            </span>
                                            <div>
                                                <div class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 transition">
                                                    {!! highlightSearch($surah->name_bangla ?? $surah->name_english, $query) !!}
                                                </div>
                                                <div class="text-[11px] text-gray-400 font-serif" style="font-family: 'Amiri', serif;">
                                                    {{ $surah->name_arabic }} &bull; {{ $surah->ayah_count }} আয়াত
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Ayahs Matching (STEP 10 Highlight) -->
                            @if($counts['ayahs'] > 0)
                                <div class="space-y-3">
                                    @foreach($ayahs as $ayah)
                                        <div class="p-5 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm space-y-3">
                                            <div class="flex items-center justify-between">
                                                <a href="{{ route('quran.show', $ayah->surah?->number ?? 1) }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                                                    সূরা {{ $ayah->surah?->name_bangla ?? $ayah->surah?->name_english }} (আয়াত: {{ $ayah->ayah_number }})
                                                </a>
                                                <span class="text-xs text-gray-400">সূরা নং {{ $ayah->surah?->number }}</span>
                                            </div>

                                            <p dir="rtl" class="text-right text-lg text-gray-800 dark:text-emerald-200 font-serif leading-loose" style="font-family: 'Amiri', serif;">
                                                {{ $ayah->arabic_text }}
                                            </p>

                                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                                {!! highlightSearch($ayah->bangla_text, $query) !!}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>

                                @if($ayahs->hasPages() && $activeTab === 'quran')
                                    <div class="pt-2">
                                        {{ $ayahs->links() }}
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endif

                    <!-- SECTION 2: Hadiths Results (STEP 6, 8, 9, 10) -->
                    @if(($activeTab === 'all' || $activeTab === 'hadiths') && $counts['hadiths'] > 0)
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                    <span class="w-8 h-8 rounded-xl bg-purple-100 dark:bg-purple-950 text-purple-600 flex items-center justify-center text-sm">📚</span>
                                    <span>সহিহ হাদিস (Hadith)</span>
                                    <small class="text-xs text-gray-400 font-normal">({{ $counts['hadiths'] }} টি)</small>
                                </h3>
                                <a href="{{ route('hadith.index') }}" class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline">
                                    সব হাদিস গ্রন্থ &rarr;
                                </a>
                            </div>

                            <div class="space-y-4">
                                @foreach($hadiths as $hadith)
                                    <div class="p-6 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-100 dark:bg-purple-950 text-purple-700 dark:text-purple-300">
                                                {{ $hadith->book?->name_bangla ?? $hadith->book?->name }} (হাদিস নং {{ $hadith->hadith_number }})
                                            </span>
                                            @if($hadith->grade)
                                                <span class="text-xs font-semibold px-2 py-0.5 rounded bg-emerald-100 dark:bg-emerald-950 text-emerald-600">{{ $hadith->grade }}</span>
                                            @endif
                                        </div>

                                        @if($hadith->arabic_text)
                                            <p dir="rtl" class="text-right text-base text-gray-800 dark:text-gray-200 font-serif leading-loose" style="font-family: 'Amiri', serif;">
                                                {{ Str::limit($hadith->arabic_text, 150) }}
                                            </p>
                                        @endif

                                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                            {!! highlightSearch(Str::limit($hadith->bangla_text, 250), $query) !!}
                                        </p>

                                        @if($hadith->narrator)
                                            <p class="text-xs text-gray-400">
                                                বর্ণনাকারী: <span class="font-medium text-gray-600 dark:text-gray-300">{!! highlightSearch($hadith->narrator, $query) !!}</span>
                                            </p>
                                        @endif

                                        <div class="pt-2 border-t border-gray-100 dark:border-gray-800 flex justify-end">
                                            <a href="{{ route('hadith.show', $hadith->book?->slug ?? $hadith->hadith_book_id) }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                                                সম্পূর্ণ হাদিস গ্রন্থ দেখুন &rarr;
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if($hadiths->hasPages() && $activeTab === 'hadiths')
                                <div class="pt-2">
                                    {{ $hadiths->links() }}
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- SECTION 3: Duas Results (STEP 8, 9, 10) -->
                    @if(($activeTab === 'all' || $activeTab === 'duas') && $counts['duas'] > 0)
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                    <span class="w-8 h-8 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 flex items-center justify-center text-sm">🤲</span>
                                    <span>দোয়া ও আযকার (Duas)</span>
                                    <small class="text-xs text-gray-400 font-normal">({{ $counts['duas'] }} টি)</small>
                                </h3>
                                <a href="{{ route('duas.index') }}" class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline">
                                    সব দোয়া দেখুন &rarr;
                                </a>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($duas as $dua)
                                    <div class="p-5 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:border-emerald-500/40 transition space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">
                                                {{ $dua->category?->name_bangla ?? ($dua->category?->name ?? 'দোয়া') }}
                                            </span>
                                            @if($dua->reference)
                                                <span class="text-[11px] text-gray-400 font-medium">{{ $dua->reference }}</span>
                                            @endif
                                        </div>

                                        <h4 class="text-base font-bold text-gray-900 dark:text-white">
                                            {!! highlightSearch($dua->title_bangla ?? $dua->title, $query) !!}
                                        </h4>

                                        @if($dua->arabic_text)
                                            <p dir="rtl" class="text-right text-base text-emerald-800 dark:text-emerald-300 font-serif leading-loose" style="font-family: 'Amiri', serif;">
                                                {{ Str::limit($dua->arabic_text, 120) }}
                                            </p>
                                        @endif

                                        @if($dua->bangla_meaning)
                                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                                                <strong>অর্থ:</strong> {!! highlightSearch($dua->bangla_meaning, $query) !!}
                                            </p>
                                        @endif

                                        <div class="pt-2 border-t border-gray-100 dark:border-gray-800 flex justify-end">
                                            <a href="{{ route('duas.category', $dua->category?->slug ?? $dua->dua_category_id) }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                                                সম্পূর্ণ দোয়া পড়ুন &rarr;
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if($duas->hasPages() && $activeTab === 'duas')
                                <div class="pt-2">
                                    {{ $duas->links() }}
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- SECTION 4: Articles Results (STEP 8, 9, 10) -->
                    @if(($activeTab === 'all' || $activeTab === 'articles') && $counts['articles'] > 0)
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                    <span class="w-8 h-8 rounded-xl bg-teal-100 dark:bg-teal-950 text-teal-600 flex items-center justify-center text-sm">📝</span>
                                    <span>ইসলামিক প্রবন্ধ ও গাইড (Articles)</span>
                                    <small class="text-xs text-gray-400 font-normal">({{ $counts['articles'] }} টি)</small>
                                </h3>
                                <a href="{{ route('articles.index') }}" class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline">
                                    সব প্রবন্ধ দেখুন &rarr;
                                </a>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($articles as $article)
                                    <a href="{{ route('articles.show', $article) }}" 
                                       class="p-6 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-lg hover:border-emerald-500/40 hover:-translate-y-1 transition duration-200 flex flex-col justify-between group">
                                        <div class="space-y-2.5">
                                            @if($article->category)
                                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">
                                                    {{ $article->category->name_bangla ?? $article->category->name }}
                                                </span>
                                            @endif

                                            <h4 class="text-base font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-2">
                                                {!! highlightSearch($article->title, $query) !!}
                                            </h4>

                                            @if($article->excerpt)
                                                <p class="text-xs text-gray-600 dark:text-gray-300 line-clamp-3 leading-relaxed">
                                                    {!! highlightSearch($article->excerpt, $query) !!}
                                                </p>
                                            @endif
                                        </div>

                                        <div class="pt-4 mt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between text-xs">
                                            <span class="text-gray-400">
                                                {{ $article->published_at ? $article->published_at->format('d M, Y') : '' }}
                                            </span>
                                            <span class="text-emerald-600 dark:text-emerald-400 font-semibold group-hover:translate-x-1 transition-transform">
                                                পড়ুন &rarr;
                                            </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            @if($articles->hasPages() && $activeTab === 'articles')
                                <div class="pt-2">
                                    {{ $articles->links() }}
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- SECTION 5: Islamic Events Results (STEP 8, 9, 10) -->
                    @if(($activeTab === 'all' || $activeTab === 'events') && $counts['events'] > 0)
                        <div class="space-y-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <span class="w-8 h-8 rounded-xl bg-blue-100 dark:bg-blue-950 text-blue-600 flex items-center justify-center text-sm">📅</span>
                                <span>ইসলামিক দিবস ও ক্যালেন্ডার ইভেন্টস</span>
                                <small class="text-xs text-gray-400 font-normal">({{ $counts['events'] }} টি)</small>
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($events as $event)
                                    <div class="p-5 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm space-y-2">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400">
                                                {{ $event->hijri_day }} {{ config("hijri.months.{$event->hijri_month}") }} ({{ config("hijri.months_bn.{$event->hijri_month}") }})
                                            </span>
                                            @if($event->gregorian_date)
                                                <span class="text-xs text-gray-400">{{ $event->gregorian_date->format('d M, Y') }}</span>
                                            @endif
                                        </div>

                                        <h4 class="text-base font-bold text-gray-900 dark:text-white">
                                            {!! highlightSearch($event->title_bangla ?? $event->title, $query) !!}
                                        </h4>

                                        @if($event->description)
                                            <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                                                {!! highlightSearch($event->description, $query) !!}
                                            </p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            @else
                <!-- No Results Found State -->
                <div class="p-12 text-center rounded-3xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 space-y-4 shadow-sm">
                    <div class="w-16 h-16 mx-auto rounded-full bg-amber-100 dark:bg-amber-950 text-amber-600 flex items-center justify-center text-3xl">
                        🔍
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">"{{ $query }}" এর জন্য কোনো ফলাফল পাওয়া যায়নি</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                        বানানটি পুনরায় চেক করুন অথবা অন্য কোনো সহজ শব্দ যেমন "রোজা", "নামাজ", "তাহাজ্জুদ", "যাকাত" ইত্যাদি দিয়ে অনুসন্ধান করুন।
                    </p>
                </div>
            @endif

        @else
            <!-- Initial State (Before searching - STEP 5) -->
            <div class="text-center py-12 space-y-8">
                <div class="max-w-md mx-auto space-y-3">
                    <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-600 flex items-center justify-center text-3xl">
                        🔎
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">অনুসন্ধান করতে কীওয়ার্ড লিখুন</h3>
                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                        আমাদের ডাটাবেজে সংরক্ষিত সম্পূর্ণ কুরআন, সহিহ হাদিস, বিষয়ভিত্তিক দোয়া এবং তথ্যবহুল আর্টিকেল থেকে নিমেষেই খুঁজে নিন আপনার কাঙ্ক্ষিত বিষয়।
                    </p>
                </div>

                <!-- 4 Feature Cards -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto">
                    <a href="{{ route('quran.index') }}" class="p-5 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:border-emerald-500/40 text-center space-y-2 transition group">
                        <span class="text-3xl block group-hover:scale-110 transition-transform">📖</span>
                        <div class="font-bold text-sm text-gray-900 dark:text-white">আল-কুরআন</div>
                        <div class="text-[11px] text-gray-400">১১৪টি সূরা ও আয়াত</div>
                    </a>

                    <a href="{{ route('hadith.index') }}" class="p-5 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:border-emerald-500/40 text-center space-y-2 transition group">
                        <span class="text-3xl block group-hover:scale-110 transition-transform">📚</span>
                        <div class="font-bold text-sm text-gray-900 dark:text-white">সহিহ হাদিস</div>
                        <div class="text-[11px] text-gray-400">হাদিস গ্রন্থসমূহ</div>
                    </a>

                    <a href="{{ route('duas.index') }}" class="p-5 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:border-emerald-500/40 text-center space-y-2 transition group">
                        <span class="text-3xl block group-hover:scale-110 transition-transform">🤲</span>
                        <div class="font-bold text-sm text-gray-900 dark:text-white">দোয়া ও আযকার</div>
                        <div class="text-[11px] text-gray-400">দৈনন্দিন মাসনূন দোয়া</div>
                    </a>

                    <a href="{{ route('articles.index') }}" class="p-5 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:border-emerald-500/40 text-center space-y-2 transition group">
                        <span class="text-3xl block group-hover:scale-110 transition-transform">📝</span>
                        <div class="font-bold text-sm text-gray-900 dark:text-white">প্রবন্ধ ও গাইড</div>
                        <div class="text-[11px] text-gray-400">জীবনঘনিষ্ঠ আর্টিকেল</div>
                    </a>
                </div>
            </div>
        @endif

    </div>

</div>
@endsection
