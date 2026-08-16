<x-app-layout>
    <!-- Quran Hero Header & Search -->
    <section class="relative overflow-hidden bg-gradient-to-b from-emerald-950 via-teal-950 to-slate-950 text-white py-14 sm:py-20 border-b border-emerald-900/40">
        <!-- Geometric pattern accent -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="text-3xl sm:text-4xl text-amber-300 font-serif block mb-3" style="font-family: 'Amiri', serif;">
                بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight mb-4">
                পবিত্র <span class="bg-gradient-to-r from-emerald-400 to-amber-300 bg-clip-text text-transparent">আল-কুরআনুল কারীম</span>
            </h1>
            <p class="max-w-2xl mx-auto text-sm sm:text-base text-emerald-200/90 mb-8 leading-relaxed">
                পবিত্র কুরআনের আয়াত অনুসন্ধান করুন এবং ১১৪টি সূরার তিলাওয়াত ও অনুবাদ পড়ুন।
            </p>

            <!-- Search Form Box -->
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('quran.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
                    <div class="relative flex-1 w-full">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="কুরআনের আয়াত বা শব্দ অনুসন্ধান করুন (যেমন: الله / রহমান / প্রশংসা)..." 
                               class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-white/10 backdrop-blur-md text-white placeholder-emerald-200/60 border border-emerald-500/30 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-400/20 text-sm sm:text-base shadow-xl">
                        <div class="absolute left-4 top-3.5 text-emerald-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>

                    <button type="submit" class="w-full sm:w-auto px-7 py-3.5 rounded-2xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold text-sm shadow-md transition whitespace-nowrap">
                        অনুসন্ধান (Search)
                    </button>
                </form>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">
        
        <!-- Search Results Section (If user searched) -->
        @if ($search)
            <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-gray-900 border border-emerald-200 dark:border-gray-800 shadow-xl space-y-6">
                <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 pb-4">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">অনুসন্ধান ফলাফল</span>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mt-0.5">
                            Search Results for: <span class="text-emerald-600 dark:text-emerald-400">"{{ $search }}"</span>
                        </h2>
                    </div>
                    <a href="{{ route('quran.index') }}" class="text-xs font-semibold text-red-600 dark:text-red-400 hover:underline">
                        রিসেট করুন &times;
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse ($results as $ayah)
                        <div class="p-5 rounded-2xl bg-slate-50 dark:bg-gray-800/60 border border-gray-200/70 dark:border-gray-700/80 shadow-sm hover:border-emerald-500/40 transition space-y-3">
                            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                <span class="font-bold text-emerald-700 dark:text-emerald-300">
                                    {{ $ayah->surah->name_english }} ({{ $ayah->surah->name_bangla }}) &bull; আয়াত {{ $ayah->ayah_number }}
                                </span>
                                <a href="{{ route('quran.show', $ayah->surah->number) }}#ayah-{{ $ayah->ayah_number }}" class="text-emerald-600 dark:text-emerald-400 hover:underline font-semibold flex items-center gap-1">
                                    সম্পূর্ণ সূরা পড়ুন &rarr;
                                </a>
                            </div>

                            <!-- Arabic Text -->
                            <p dir="rtl" class="text-right leading-loose text-2xl text-gray-900 dark:text-emerald-100 font-normal py-1" style="font-family: 'Amiri', serif; line-height: 2.2;">
                                {{ $ayah->arabic_text }} ﴿{{ $ayah->ayah_number }}﴾
                            </p>

                            <!-- Bangla Text -->
                            @if ($ayah->bangla_text)
                                <div class="pt-2 border-t border-gray-200/60 dark:border-gray-700/60 text-sm text-gray-700 dark:text-gray-300">
                                    {{ $ayah->bangla_text }}
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="py-10 text-center text-gray-500">
                            <div class="text-4xl mb-2">🔍</div>
                            <p class="text-base font-semibold">"{{ $search }}" এর জন্য কোনো আয়াত পাওয়া যায়নি।</p>
                            <p class="text-xs text-gray-400 mt-1">অন্য কোনো আরবি বা বাংলা শব্দ দিয়ে অনুসন্ধান করুন।</p>
                        </div>
                    @endforelse
                </div>
            </div>
        @endif

        <!-- Surah Directory List Section -->
        <section class="space-y-6">
            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-800">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">সূচিপত্র (Surah Directory)</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">কুরআন মাজিদের সকল সূরার তালিকা (১-১১৪)</p>
                </div>
                <div class="text-xs font-semibold text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/60 px-3 py-1.5 rounded-full border border-emerald-200 dark:border-emerald-800">
                    মোট সূরা: {{ $surahs->count() }}
                </div>
            </div>

            <!-- Surahs Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($surahs as $surah)
                    <a href="{{ route('quran.show', $surah->number) }}" 
                       class="p-5 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-xl hover:border-emerald-500/40 hover:-translate-y-1 transition duration-200 flex items-center justify-between group">
                        
                        <!-- Left Info -->
                        <div class="flex items-center gap-4">
                            <!-- Number Badge -->
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 group-hover:bg-emerald-600 text-emerald-700 dark:text-emerald-300 group-hover:text-white flex items-center justify-center font-extrabold text-base border border-emerald-200/60 dark:border-emerald-800/40 transition-all duration-200">
                                {{ $surah->number }}
                            </div>

                            <div>
                                <h3 class="text-base font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                    {{ $surah->name_english }}
                                </h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $surah->name_bangla }} &bull; <span class="font-medium">{{ $surah->ayah_count }} Ayahs</span>
                                </p>
                            </div>
                        </div>

                        <!-- Right: Arabic Calligraphy & Place Badge -->
                        <div class="text-right flex flex-col items-end">
                            <span class="text-2xl text-emerald-800 dark:text-emerald-300 group-hover:text-emerald-600 font-normal leading-none mb-1.5" style="font-family: 'Amiri', serif;">
                                {{ $surah->name_arabic }}
                            </span>
                            <span class="text-[10px] font-semibold px-2.5 py-0.5 rounded-full {{ $surah->revelation_place === 'Makkah' ? 'bg-amber-100 dark:bg-amber-950 text-amber-700 dark:text-amber-300' : 'bg-teal-100 dark:bg-teal-950 text-teal-700 dark:text-teal-300' }}">
                                {{ $surah->revelation_place === 'Makkah' ? 'Makkah' : 'Madinah' }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

    </div>
</x-app-layout>
