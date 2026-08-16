<x-app-layout>
    <!-- Quran Hero Header -->
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
                সহজ তিলাওয়াত, বিশুদ্ধ আরবি টেক্সট এবং প্রাঞ্জল বাংলা অর্থসহ ১১৪টি সূরার সম্ভার।
            </p>

            <!-- Search & Filters -->
            <div class="max-w-2xl mx-auto">
                <form method="GET" action="{{ route('quran.index') }}" class="flex flex-col sm:flex-row items-center gap-3">
                    <div class="relative flex-1 w-full">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="সূরার নাম (বাংলা, ইংরেজি, আরবি) বা নম্বর লিখুন..." 
                               class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-white/10 backdrop-blur-md text-white placeholder-emerald-200/60 border border-emerald-500/30 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-400/20 text-sm shadow-xl">
                        <div class="absolute left-4 top-3.5 text-emerald-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <select name="place" class="px-4 py-3.5 rounded-2xl bg-slate-900/90 text-white text-sm border border-emerald-500/30 focus:outline-none focus:border-amber-400 flex-1 sm:flex-initial">
                            <option value="">সকল সূরা</option>
                            <option value="Makkah" {{ request('place') === 'Makkah' ? 'selected' : '' }}>মাক্কী</option>
                            <option value="Madinah" {{ request('place') === 'Madinah' ? 'selected' : '' }}>মাদানী</option>
                        </select>

                        <button type="submit" class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold text-sm shadow-md transition whitespace-nowrap">
                            খুঁজুন
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Surah Listing Section -->
    <section class="py-12 bg-slate-50 dark:bg-gray-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Quick Filter Bar & Stats -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-8 pb-4 border-b border-gray-200 dark:border-gray-800">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-bold text-gray-700 dark:text-gray-300">মোট সূরা:</span>
                    <span class="px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 font-bold text-xs">
                        {{ $totalSurahs }} টি
                    </span>
                    <span class="px-3 py-1 rounded-full bg-amber-100 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 font-medium text-xs">
                        মাক্কী: {{ $makkiCount }}
                    </span>
                    <span class="px-3 py-1 rounded-full bg-teal-100 dark:bg-teal-950/60 text-teal-700 dark:text-teal-300 font-medium text-xs">
                        মাদানী: {{ $madaniCount }}
                    </span>
                </div>

                @if (request()->hasAny(['search', 'place']))
                    <a href="{{ route('quran.index') }}" class="text-xs font-semibold text-red-600 dark:text-red-400 hover:underline">
                        ফিল্টার রিসেট করুন &times;
                    </a>
                @endif
            </div>

            <!-- Surahs Grid (3 Columns on Desktop) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse ($surahs as $surah)
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
                                    {{ $surah->name_bangla }}
                                </h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $surah->name_english }} &bull; <span class="font-medium">{{ $surah->ayah_count }} আয়াত</span>
                                </p>
                            </div>
                        </div>

                        <!-- Right: Arabic Calligraphy & Place Badge -->
                        <div class="text-right flex flex-col items-end">
                            <span class="text-2xl text-emerald-800 dark:text-emerald-300 group-hover:text-emerald-600 font-normal leading-none mb-1.5" style="font-family: 'Amiri', serif;">
                                {{ $surah->name_arabic }}
                            </span>
                            <span class="text-[10px] font-semibold px-2.5 py-0.5 rounded-full {{ $surah->revelation_place === 'Makkah' ? 'bg-amber-100 dark:bg-amber-950 text-amber-700 dark:text-amber-300' : 'bg-teal-100 dark:bg-teal-950 text-teal-700 dark:text-teal-300' }}">
                                {{ $surah->revelation_place === 'Makkah' ? 'মাক্কী' : 'মাদানী' }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-16 text-center">
                        <div class="text-5xl mb-3">🔍</div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">কোনো সূরা খুঁজে পাওয়া যায়নি</h3>
                        <p class="text-sm text-gray-500 mt-1">অনুগ্রহ করে সঠিক বানান বা সূরা নম্বর দিয়ে পুনরায় চেষ্টা করুন।</p>
                        <a href="{{ route('quran.index') }}" class="mt-4 inline-block px-5 py-2 rounded-xl bg-emerald-600 text-white text-xs font-semibold">
                            সকল সূরা দেখুন
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
