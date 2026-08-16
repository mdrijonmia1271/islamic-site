<x-app-layout>
    <div x-data="{ arabicSize: 30, showTranslation: true, copiedIndex: null }" class="bg-slate-50 dark:bg-gray-950 min-h-screen pb-20">
        
        <!-- Sticky Sub-header & Reading Toolbar -->
        <div class="sticky top-20 z-30 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 shadow-sm py-3">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap items-center justify-between gap-3">
                
                <!-- Left: Surah Quick Dropdown Navigation -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('quran.index') }}" class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline flex items-center gap-1">
                        &larr; <span>সকল সূরা</span>
                    </a>

                    <div class="h-4 w-px bg-gray-300 dark:bg-gray-700"></div>

                    <!-- Quick Dropdown Switcher -->
                    <select onchange="if(this.value) window.location.href=this.value" 
                            class="text-xs font-bold bg-slate-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-700 rounded-xl py-1.5 pl-3 pr-8 focus:ring-1 focus:ring-emerald-500">
                        <option value="">সূরা নির্বাচন করুন (Select Surah)</option>
                        @foreach ($allSurahs as $item)
                            <option value="{{ route('quran.show', $item->number) }}" @selected($item->id === $surah->id)>
                                {{ $item->number }}. {{ $item->name_english }} ({{ $item->name_bangla }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Right: Font Size & Translation Toggle Controls -->
                <div class="flex items-center gap-2 text-xs">
                    <!-- Translation Toggle -->
                    <button @click="showTranslation = !showTranslation" type="button" 
                            class="px-3 py-1.5 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                            :class="{ 'bg-emerald-50 text-emerald-700 border-emerald-300 dark:bg-emerald-950 dark:text-emerald-300': showTranslation }">
                        অনুবাদ: <span x-text="showTranslation ? 'চালু' : 'বন্ধ'"></span>
                    </button>

                    <!-- Font Size Zoom (A- / A+) -->
                    <div class="inline-flex items-center rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-0.5">
                        <button @click="if (arabicSize > 22) arabicSize -= 4" type="button" class="px-2.5 py-1 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg font-semibold" title="ফন্ট ছোট করুন">
                            A-
                        </button>
                        <span class="px-2 text-[11px] font-semibold text-gray-500" x-text="arabicSize + 'px'"></span>
                        <button @click="if (arabicSize < 56) arabicSize += 4" type="button" class="px-2.5 py-1 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg font-semibold" title="ফন্ট বড় করুন">
                            A+
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Surah Header Card -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-10">
            <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-br from-emerald-900 via-teal-900 to-slate-950 text-white text-center shadow-2xl relative overflow-hidden border border-emerald-800/40">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

                <div class="relative z-10 space-y-3">
                    <!-- Arabic Surah Name -->
                    <div class="text-4xl sm:text-6xl text-amber-300 font-serif font-normal" style="font-family: 'Amiri', serif;">
                        {{ $surah->name_arabic }}
                    </div>

                    <!-- English & Bangla Titles -->
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-white">
                        {{ $surah->name_english }}
                    </h1>
                    <p class="text-emerald-300 font-medium text-lg">
                        {{ $surah->name_bangla }}
                    </p>

                    <!-- Place & Ayahs Meta -->
                    <div class="pt-2">
                        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-950/80 border border-emerald-600/40 text-xs font-semibold text-emerald-200">
                            {{ $surah->revelation_place ?? 'Makkah' }} &bull; {{ $surah->ayah_count }} Ayahs
                        </span>
                    </div>

                    <!-- Bismillah Banner (Except Surah At-Tawbah #9 & Al-Fatihah #1 where it's Ayah 1) -->
                    @if ($surah->number != 9 && $surah->number != 1)
                        <div class="pt-6 mt-6 border-t border-emerald-800/40">
                            <span class="text-2xl sm:text-3xl text-emerald-100 font-serif tracking-widest block" style="font-family: 'Amiri', serif;">
                                بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sequential Ayahs List -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">
            @forelse ($surah->ayahs as $ayah)
                <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-md hover:shadow-lg transition space-y-5 group" id="ayah-{{ $ayah->ayah_number }}">
                    
                    <!-- Ayah Header Bar (Badge & Actions) -->
                    <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 pb-3">
                        <!-- Ayah Number Badge -->
                        <span class="w-8 h-8 rounded-xl bg-emerald-100 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-300 font-bold text-xs flex items-center justify-center border border-emerald-200 dark:border-emerald-800">
                            {{ $ayah->ayah_number }}
                        </span>

                        <!-- Action Buttons (Copy / Bookmark) -->
                        <div class="flex items-center gap-1.5">
                            <button @click="navigator.clipboard.writeText('{{ addslashes($ayah->arabic_text) }} \n\n{{ addslashes($ayah->bangla_text ?? '') }}'); copiedIndex = {{ $ayah->ayah_number }}; setTimeout(() => copiedIndex = null, 2000)" 
                                    type="button" class="p-1.5 rounded-lg text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-gray-800 transition text-xs" title="আয়াত কপি করুন">
                                <span x-show="copiedIndex !== {{ $ayah->ayah_number }}">📋</span>
                                <span x-show="copiedIndex === {{ $ayah->ayah_number }}" class="text-emerald-600 font-bold">✓ কপি হয়েছে!</span>
                            </button>
                            <button type="button" class="p-1.5 rounded-lg text-gray-400 hover:text-amber-500 hover:bg-amber-50 dark:hover:bg-gray-800 transition text-xs" title="বুকমার্ক">
                                🔖
                            </button>
                        </div>
                    </div>

                    <!-- Arabic Text -->
                    <div dir="rtl" class="text-right leading-loose text-gray-900 dark:text-emerald-100 font-normal py-1 select-text" 
                         :style="'font-size: ' + arabicSize + 'px; font-family: \'Amiri\', serif; line-height: 2.2;'">
                        {{ $ayah->arabic_text }} <span class="text-emerald-600 dark:text-amber-300 text-xl font-sans inline-block px-1">﴿{{ $ayah->ayah_number }}﴾</span>
                    </div>

                    <!-- Bangla Translation (with toggle) -->
                    @if ($ayah->bangla_text)
                        <div x-show="showTranslation" x-collapse>
                            <div class="pt-3 border-t border-gray-100 dark:border-gray-800 text-base text-gray-700 dark:text-gray-300 font-medium leading-relaxed">
                                {{ $ayah->bangla_text }}
                            </div>
                        </div>
                    @endif

                </div>
            @empty
                <div class="p-14 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 text-center shadow-md">
                    <div class="text-4xl mb-3">📖</div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">এখনও কোনো আয়াত যুক্ত করা হয়নি</h3>
                    <p class="text-xs text-gray-500 mt-1 max-w-sm mx-auto">
                        এডমিন প্যানেল থেকে এই সূরার আয়াতগুলো এন্ট্রি করা হচ্ছে।
                    </p>
                </div>
            @endforelse
        </div>

        <!-- Bottom Navigation: Prev / Next Surah -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-gray-200 dark:border-gray-800">
            <div class="flex items-center justify-between gap-4">
                @if ($previousSurah)
                    <a href="{{ route('quran.show', $previousSurah->number) }}" class="p-3.5 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 hover:border-emerald-500 text-gray-800 dark:text-gray-200 text-sm font-semibold transition flex items-center gap-2 shadow-sm">
                        <span>&larr;</span>
                        <div class="text-left">
                            <div class="text-[10px] text-gray-400 font-normal uppercase">পূর্ববর্তী সূরা</div>
                            <div>{{ $previousSurah->name_english }} ({{ $previousSurah->name_bangla }})</div>
                        </div>
                    </a>
                @else
                    <div></div>
                @endif

                <a href="{{ route('quran.index') }}" class="px-5 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold shadow-md transition">
                    সকল সূরা 📑
                </a>

                @if ($nextSurah)
                    <a href="{{ route('quran.show', $nextSurah->number) }}" class="p-3.5 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 hover:border-emerald-500 text-gray-800 dark:text-gray-200 text-sm font-semibold transition flex items-center gap-2 text-right shadow-sm">
                        <div class="text-right">
                            <div class="text-[10px] text-gray-400 font-normal uppercase">পরবর্তী সূরা</div>
                            <div>{{ $nextSurah->name_english }} ({{ $nextSurah->name_bangla }})</div>
                        </div>
                        <span>&rarr;</span>
                    </a>
                @else
                    <div></div>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>
