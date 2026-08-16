<x-app-layout>
    <!-- 1. Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-b from-emerald-950 via-teal-950 to-slate-950 text-white py-16 sm:py-24">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Bismillah Header -->
            <div class="mb-6 inline-block">
                <span class="text-3xl sm:text-4xl md:text-5xl text-amber-300 font-serif tracking-widest block" style="font-family: 'Amiri', serif;">
                    بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
                </span>
                <span class="text-xs sm:text-sm text-emerald-300 uppercase tracking-widest font-semibold mt-2 block">
                    In the Name of Allah, Most Gracious, Most Merciful
                </span>
            </div>

            <!-- Main Title -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white mb-6 leading-tight">
                ইসলামিক জ্ঞান, আমল ও জীবনযাপনের <br class="hidden sm:inline">
                <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-amber-300 bg-clip-text text-transparent">
                    পূর্ণাঙ্গ প্ল্যাটফর্ম
                </span>
            </h1>

            <p class="max-w-3xl mx-auto text-base sm:text-lg text-emerald-100/90 mb-8 leading-relaxed">
                সহজ ভাষায় আল-কুরআন, সহিহ হাদিস, দৈনন্দিন দোয়া, সঠিক নামাজের সময় এবং নিত্যদিনের ইসলামিক টুলস এক সাথে।
            </p>

            <!-- Search Bar Mockup -->
            <div class="max-w-2xl mx-auto mb-10">
                <div class="relative flex items-center">
                    <input type="text" placeholder="কুরআনের সূরা, আয়াত, হাদিস বা দোয়া অনুসন্ধান করুন..." 
                           class="w-full pl-12 pr-28 py-4 rounded-2xl bg-white/10 backdrop-blur-md text-white placeholder-emerald-200/60 border border-emerald-500/30 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-400/20 text-sm sm:text-base shadow-xl">
                    <div class="absolute left-4 text-emerald-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <button type="button" class="absolute right-2 px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-medium text-xs sm:text-sm rounded-xl transition shadow">
                        অনুসন্ধান
                    </button>
                </div>
            </div>

            <!-- Quick Action Badges -->
            <div class="flex flex-wrap items-center justify-center gap-3 text-xs sm:text-sm">
                <a href="#prayer-time" class="px-4 py-2 rounded-full bg-emerald-900/60 hover:bg-emerald-800/80 border border-emerald-700/50 text-emerald-200 transition flex items-center gap-1.5">
                    <span>⏰</span> নামাজের সময়
                </a>
                <a href="#quran-today" class="px-4 py-2 rounded-full bg-emerald-900/60 hover:bg-emerald-800/80 border border-emerald-700/50 text-emerald-200 transition flex items-center gap-1.5">
                    <span>📖</span> আজকের আয়াত
                </a>
                <a href="#hadith-today" class="px-4 py-2 rounded-full bg-emerald-900/60 hover:bg-emerald-800/80 border border-emerald-700/50 text-emerald-200 transition flex items-center gap-1.5">
                    <span>📜</span> আজকের হাদিস
                </a>
                <a href="#dua-today" class="px-4 py-2 rounded-full bg-emerald-900/60 hover:bg-emerald-800/80 border border-emerald-700/50 text-emerald-200 transition flex items-center gap-1.5">
                    <span>🤲</span> আজকের দোয়া
                </a>
                <a href="#tools" class="px-4 py-2 rounded-full bg-amber-950/60 hover:bg-amber-900/80 border border-amber-700/50 text-amber-200 transition flex items-center gap-1.5">
                    <span>🛠️</span> ইসলামিক টুলস
                </a>
            </div>
        </div>
    </section>

    <!-- 2. Prayer Time Section -->
    <section id="prayer-time" class="py-14 bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 px-3 py-1 rounded-full border border-emerald-200 dark:border-emerald-800">
                        Prayer Times
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        আজকের নামাজের সময়সূচি
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        📍 ঢাকা, বাংলাদেশ &bull; <span class="text-emerald-600 dark:text-emerald-400 font-medium">১ রবিউল আউয়াল ১৪৪৮ হিজরি</span>
                    </p>
                </div>

                <!-- Next Prayer Highlight -->
                <div class="inline-flex items-center gap-3 px-4 py-2.5 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-700 text-white shadow-md">
                    <div class="w-3 h-3 rounded-full bg-amber-400 animate-pulse"></div>
                    <div class="text-xs sm:text-sm font-medium">
                        পরবর্তী নামাজ: <span class="font-bold text-amber-300">আসর (০৪:৩৫ PM)</span> &bull; বাকি ০১ ঘ. ২০ মি.
                    </div>
                </div>
            </div>

            <!-- Prayer Cards Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
                <!-- Fajr -->
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-gray-800/80 border border-gray-200/70 dark:border-gray-700 text-center hover:border-emerald-500/50 transition">
                    <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">ফজর (Fajr)</span>
                    <div class="text-xl sm:text-2xl font-extrabold text-gray-900 dark:text-white my-1">০৪:১২ AM</div>
                    <span class="text-[11px] text-gray-400">সূর্যোদয় পর্যন্ত</span>
                </div>

                <!-- Sunrise -->
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-gray-800/80 border border-gray-200/70 dark:border-gray-700 text-center opacity-80">
                    <span class="text-xs text-amber-600 dark:text-amber-400 font-medium">সূর্যোদয় (Sunrise)</span>
                    <div class="text-xl sm:text-2xl font-bold text-amber-600 dark:text-amber-400 my-1">০৫:৩০ AM</div>
                    <span class="text-[11px] text-gray-400">নিষিদ্ধ সময়</span>
                </div>

                <!-- Dhuhr -->
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-gray-800/80 border border-gray-200/70 dark:border-gray-700 text-center hover:border-emerald-500/50 transition">
                    <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">যোহর (Dhuhr)</span>
                    <div class="text-xl sm:text-2xl font-extrabold text-gray-900 dark:text-white my-1">১২:০৫ PM</div>
                    <span class="text-[11px] text-gray-400">ওয়াক্ত শুরু</span>
                </div>

                <!-- Asr (Active / Next Prayer) -->
                <div class="p-4 rounded-2xl bg-emerald-500/10 dark:bg-emerald-950/60 border-2 border-emerald-500 text-center relative shadow-sm">
                    <span class="absolute -top-2.5 left-1/2 -translate-x-1/2 px-2 py-0.5 rounded-full bg-emerald-600 text-[10px] text-white font-bold uppercase">
                        Current
                    </span>
                    <span class="text-xs text-emerald-700 dark:text-emerald-300 font-bold">আসর (Asr)</span>
                    <div class="text-xl sm:text-2xl font-extrabold text-emerald-700 dark:text-emerald-300 my-1">০৪:৩৫ PM</div>
                    <span class="text-[11px] text-emerald-600 dark:text-emerald-400">বর্তমান ওয়াক্ত</span>
                </div>

                <!-- Maghrib -->
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-gray-800/80 border border-gray-200/70 dark:border-gray-700 text-center hover:border-emerald-500/50 transition">
                    <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">মাগরিব (Maghrib)</span>
                    <div class="text-xl sm:text-2xl font-extrabold text-gray-900 dark:text-white my-1">০৬:৩২ PM</div>
                    <span class="text-[11px] text-gray-400">ইফতারের সময়</span>
                </div>

                <!-- Isha -->
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-gray-800/80 border border-gray-200/70 dark:border-gray-700 text-center hover:border-emerald-500/50 transition">
                    <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">ইশা (Isha)</span>
                    <div class="text-xl sm:text-2xl font-extrabold text-gray-900 dark:text-white my-1">০৭:৪৮ PM</div>
                    <span class="text-[11px] text-gray-400">তাহাজ্জুদ পর্যন্ত</span>
                </div>
            </div>

            <!-- View Full Prayer Times CTA -->
            <div class="mt-8 text-center">
                <a href="{{ route('prayer-times.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold shadow-lg shadow-emerald-600/30 transition group">
                    <span>View Full Prayer Times &amp; Location Switcher</span>
                    <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- 3. Quran of the Day Section -->
    <section id="quran-today" class="py-16 bg-slate-50 dark:bg-gray-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-white dark:bg-gray-900 rounded-3xl border border-emerald-100 dark:border-gray-800 shadow-xl overflow-hidden">
                
                <!-- Card Header with Arch Motif -->
                <div class="bg-gradient-to-r from-emerald-800 via-teal-800 to-emerald-900 text-white px-6 py-5 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-400/20 text-amber-300 flex items-center justify-center text-xl">
                            📖
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">আজকের আয়াত (Ayah of the Day)</h3>
                            <p class="text-xs text-emerald-200">সূরা আল-বাক্বারাহ &bull; আয়াত ১৫২ (মাদানী সূরা)</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-emerald-950/60 text-xs font-semibold text-amber-300 border border-amber-400/30">
                        দৈনিক হেদায়েত
                    </span>
                </div>

                <!-- Ayah Content -->
                <div class="p-6 sm:p-10 space-y-6">
                    <!-- Arabic Ayah -->
                    <div class="text-right leading-loose text-2xl sm:text-3xl md:text-4xl text-gray-900 dark:text-emerald-200 font-normal py-4" style="font-family: 'Amiri', serif; direction: rtl;">
                        فَاذْكُرُونِي أَذْكُرْكُمْ وَاشْكُرُوا لِي وَلَا تَكْفُرُونِ ﴿١٥٢﴾
                    </div>

                    <div class="border-t border-gray-100 dark:border-gray-800"></div>

                    <!-- Pronunciation & Meaning -->
                    <div class="space-y-3">
                        <div>
                            <span class="text-xs font-semibold uppercase text-emerald-600 dark:text-emerald-400">উচ্চারণ:</span>
                            <p class="text-sm sm:text-base text-gray-700 dark:text-gray-300 italic mt-0.5">
                                "ফাজকুরূনী আযকুরকুম ওয়াশকুরূ লী ওয়ালা তাকফুরূন।"
                            </p>
                        </div>

                        <div>
                            <span class="text-xs font-semibold uppercase text-emerald-600 dark:text-emerald-400">বাংলা অর্থ:</span>
                            <p class="text-base sm:text-lg text-gray-900 dark:text-gray-100 font-medium mt-0.5 leading-relaxed">
                                "অতএব তোমরা আমাকে স্মরণ কর, আমিও তোমাদের স্মরণ করব। আর তোমরা আমার প্রতি কৃতজ্ঞ হও এবং অকৃতজ্ঞ হয়ো না।"
                            </p>
                        </div>
                    </div>

                    <!-- Action Bar -->
                    <div class="pt-4 flex flex-wrap items-center justify-between gap-3 border-t border-gray-100 dark:border-gray-800">
                        <div class="flex items-center gap-2">
                            <button type="button" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-medium transition shadow-sm">
                                <span>▶</span> অডিও তিলাওয়াত
                            </button>
                            <button type="button" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 text-xs sm:text-sm transition">
                                <span>🔖</span> বুকমার্ক
                            </button>
                        </div>

                        <a href="{{ url('/quran') }}" class="text-xs sm:text-sm font-semibold text-emerald-600 dark:text-emerald-400 hover:underline flex items-center gap-1">
                            সম্পূর্ণ সূরা পড়ুন &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Hadith of the Day Section -->
    <section id="hadith-today" class="py-16 bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-gradient-to-br from-teal-50/70 via-white to-emerald-50/70 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900/90 rounded-3xl border border-teal-200/80 dark:border-gray-800 shadow-xl overflow-hidden">
                
                <!-- Hadith Header -->
                <div class="bg-gradient-to-r from-teal-800 to-emerald-900 text-white px-6 py-5 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-teal-400/20 text-teal-300 flex items-center justify-center text-xl">
                            📜
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">আজকের হাদিস (Hadith of the Day)</h3>
                            <p class="text-xs text-teal-200">সহিহ বুখারি &bull; হাদিস ৬০৩৫ &bull; সহিহ (Sahih)</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-teal-950/60 text-xs font-semibold text-teal-200 border border-teal-500/30">
                        উত্তম চরিত্র
                    </span>
                </div>

                <!-- Hadith Content -->
                <div class="p-6 sm:p-10 space-y-6">
                    <!-- Arabic Hadith -->
                    <div class="text-right leading-loose text-xl sm:text-2xl text-gray-800 dark:text-teal-200 font-normal py-2" style="font-family: 'Amiri', serif; direction: rtl;">
                        «إِنَّ مِنْ خِيَارِكُمْ أَحْسَنَكُمْ أَخْلَاقًا»
                    </div>

                    <div class="border-t border-gray-200/60 dark:border-gray-800"></div>

                    <!-- Narrator & Bangla Meaning -->
                    <div class="space-y-3">
                        <div class="text-xs font-semibold text-teal-700 dark:text-teal-400">
                            হযরত আব্দুল্লাহ ইবনে আমর (রা.) থেকে বর্ণিত:
                        </div>
                        <p class="text-base sm:text-lg text-gray-900 dark:text-gray-100 font-medium leading-relaxed">
                            রাসূলুল্লাহ সাল্লাল্লাহু আলাইহি ওয়া সাল্লাম বলেছেন: <br>
                            <span class="text-teal-900 dark:text-teal-300 font-bold">"তোমাদের মধ্যে সর্বোত্তম ব্যক্তি সে, যার চরিত্র ও আচরণ সবচেয়ে সুন্দর।"</span>
                        </p>
                    </div>

                    <!-- Reference badge -->
                    <div class="pt-3 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 border-t border-gray-200/60 dark:border-gray-800">
                        <span>গ্রন্থ: সহিহ আল-বুখারি, অধ্যায়: শিষ্টাচার (كتاب الأدب)</span>
                        <a href="{{ url('/hadith') }}" class="font-semibold text-teal-600 dark:text-teal-400 hover:underline">
                            আরও হাদিস পড়ুন &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Dua of the Day Section -->
    <section id="dua-today" class="py-16 bg-slate-50 dark:bg-gray-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-white dark:bg-gray-900 rounded-3xl border border-amber-200/80 dark:border-gray-800 shadow-xl overflow-hidden">
                
                <!-- Dua Header -->
                <div class="bg-gradient-to-r from-amber-700 via-amber-800 to-yellow-800 text-white px-6 py-5 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/20 text-white flex items-center justify-center text-xl">
                            🤲
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">আজকের দোয়া (Dua of the Day)</h3>
                            <p class="text-xs text-amber-100">মা-বাবার মাগফিরাত ও কল্যাণের দোয়া &bull; কুরআন মাজিদ</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-amber-950/60 text-xs font-semibold text-amber-200 border border-amber-400/30">
                        দৈনন্দিন দোয়া
                    </span>
                </div>

                <!-- Dua Body -->
                <div class="p-6 sm:p-10 space-y-6">
                    <!-- Arabic Text -->
                    <div class="text-right leading-loose text-2xl sm:text-3xl text-gray-900 dark:text-amber-200 font-normal py-2" style="font-family: 'Amiri', serif; direction: rtl;">
                        رَّبِّ ارْحَمْهُمَا كَمَا رَبَّيَانِي صَغِيرًا
                    </div>

                    <div class="border-t border-gray-100 dark:border-gray-800"></div>

                    <!-- Pronunciation & Bangla Meaning -->
                    <div class="space-y-3">
                        <div>
                            <span class="text-xs font-semibold uppercase text-amber-700 dark:text-amber-400">উচ্চারণ:</span>
                            <p class="text-sm sm:text-base text-gray-700 dark:text-gray-300 italic mt-0.5">
                                "রাব্বির হামহুমা কামা রাব্বায়ানী সাগীরা।"
                            </p>
                        </div>

                        <div>
                            <span class="text-xs font-semibold uppercase text-amber-700 dark:text-amber-400">বাংলা অর্থ:</span>
                            <p class="text-base sm:text-lg text-gray-900 dark:text-gray-100 font-medium mt-0.5 leading-relaxed">
                                "হে আমার প্রতিপালক! তাঁদের উভয়ের প্রতি দয়া করুন, যেমনিভাবে শৈশবে তাঁরা আমাকে লালন-পালন করেছেন।"
                            </p>
                        </div>
                    </div>

                    <!-- Reference & Link -->
                    <div class="pt-3 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 border-t border-gray-100 dark:border-gray-800">
                        <span>রেফারেন্স: সূরা আল-ইসরা (বনি ইসরাঈল), আয়াত ২৪</span>
                        <a href="{{ route('duas.index') }}" class="font-semibold text-amber-600 dark:text-amber-400 hover:underline">
                            সমস্ত দোয়া ও জিকির দেখুন &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Popular Articles Section -->
    <section id="articles" class="py-16 bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 px-3 py-1 rounded-full border border-emerald-200 dark:border-emerald-800">
                        Knowledge &amp; Articles
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        জনপ্রিয় ইসলামিক প্রবন্ধ
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        জীবনঘনিষ্ঠ ও শিক্ষণীয় সমকালীন ইসলামিক আলোচনা
                    </p>
                </div>

                <a href="{{ url('/articles') }}" class="inline-flex items-center text-sm font-semibold text-emerald-600 dark:text-emerald-400 hover:underline">
                    সবগুলো প্রবন্ধ &rarr;
                </a>
            </div>

            <!-- Articles Grid (3 Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Article 1 -->
                <article class="bg-slate-50 dark:bg-gray-800/80 rounded-2xl overflow-hidden border border-gray-200/70 dark:border-gray-700 shadow-sm hover:shadow-md transition duration-200 flex flex-col">
                    <div class="h-48 bg-gradient-to-br from-emerald-700 to-teal-900 relative flex items-center justify-center text-white">
                        <span class="text-5xl opacity-40">🕌</span>
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-xs font-semibold text-white">
                            নামাজ ও ইবাদত
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="text-xs text-gray-400 mb-2">১৬ আগস্ট ২০২৬ &bull; ৫ মিনিট পড়ার সময়</div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white hover:text-emerald-600 transition">
                                নামাজে একাগ্রতা (খুশু-খুজু) অর্জনের ১০টি কার্যকরী উপায়
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 line-clamp-2">
                                দৈনন্দিন ব্যস্ততার মাঝে কীভাবে নামাজকে জীবন্ত ও প্রাণবন্ত করে তোলা যায় তার সুন্নাহ নির্দেশিত পথ...
                            </p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between text-xs">
                            <span class="font-medium text-gray-700 dark:text-gray-300">মাওলানা আব্দুল্লাহ</span>
                            <span class="text-emerald-600 font-semibold">পড়ুন &rarr;</span>
                        </div>
                    </div>
                </article>

                <!-- Article 2 -->
                <article class="bg-slate-50 dark:bg-gray-800/80 rounded-2xl overflow-hidden border border-gray-200/70 dark:border-gray-700 shadow-sm hover:shadow-md transition duration-200 flex flex-col">
                    <div class="h-48 bg-gradient-to-br from-teal-700 to-slate-900 relative flex items-center justify-center text-white">
                        <span class="text-5xl opacity-40">🌙</span>
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-xs font-semibold text-white">
                            কুরআনিক জ্ঞান
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="text-xs text-gray-400 mb-2">১৫ আগস্ট ২০২৬ &bull; ৭ মিনিট পড়ার সময়</div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white hover:text-teal-600 transition">
                                পবিত্র কুরআনের অলৌকিক বাণী ও আধুনিক বিজ্ঞান
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 line-clamp-2">
                                মহাবিশ্বের সৃষ্টি, মানবভ্রূণের বিকাশ এবং মহাসমুদ্রের রহস্য নিয়ে পবিত্র কুরআনের নির্ভুল আয়াতসমূহের আলোচনা...
                            </p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between text-xs">
                            <span class="font-medium text-gray-700 dark:text-gray-300">ড. আহমাদ উল্লাহ</span>
                            <span class="text-teal-600 font-semibold">পড়ুন &rarr;</span>
                        </div>
                    </div>
                </article>

                <!-- Article 3 -->
                <article class="bg-slate-50 dark:bg-gray-800/80 rounded-2xl overflow-hidden border border-gray-200/70 dark:border-gray-700 shadow-sm hover:shadow-md transition duration-200 flex flex-col">
                    <div class="h-48 bg-gradient-to-br from-amber-700 to-emerald-950 relative flex items-center justify-center text-white">
                        <span class="text-5xl opacity-40">💰</span>
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-xs font-semibold text-white">
                            যাকাত ও অর্থনীতি
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="text-xs text-gray-400 mb-2">১৪ আগস্ট ২০২৬ &bull; ৬ মিনিট পড়ার সময়</div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white hover:text-amber-600 transition">
                                যাকাত আদায়ের নিয়মাবলী ও দারিদ্র্য বিমোচনে এর গুরুত্ব
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 line-clamp-2">
                                নিসাব পরিমাণ সম্পদের সঠিক হিসাব ও হকদারদের মাঝে যাকাতের অর্থ সুষম বণ্টনের বিস্তারিত বিধি-বিধান...
                            </p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between text-xs">
                            <span class="font-medium text-gray-700 dark:text-gray-300">মুফতি মাহমুদ হাসান</span>
                            <span class="text-amber-600 font-semibold">পড়ুন &rarr;</span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- 7. Islamic Tools Showcase Section -->
    <section id="tools" class="py-16 bg-slate-50 dark:bg-gray-950 border-t border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 px-3 py-1 rounded-full border border-emerald-200 dark:border-emerald-800">
                    Interactive Utilities
                </span>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mt-2">
                    ইসলামিক টুলস ও সুযোগ-সুবিধা
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    আপনার দৈনন্দিন আমলকে সহজ করার জন্য প্রয়োজনীয় ডিজিটাল টুলসমূহ
                </p>
            </div>

            <!-- Tools Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Tasbih Tool Card -->
                <div class="p-6 rounded-3xl bg-white dark:bg-gray-900 border border-emerald-100 dark:border-gray-800 shadow-md flex flex-col justify-between group hover:border-emerald-500/40 transition" x-data="{ count: 33 }">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                            📿
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white">ডিজিটাল তাসবিহ</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            সুবহানাল্লাহ, আলহামদুলিল্লাহ ও অন্যান্য জিকির গণনা করুন।
                        </p>
                    </div>

                    <!-- Mini Interactive Counter Mockup -->
                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-800 text-center">
                        <div class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400 mb-2" x-text="count">33</div>
                        <div class="flex gap-2">
                            <button @click="count++" type="button" class="flex-1 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-semibold transition">
                                জিকির (+১)
                            </button>
                            <button @click="count = 0" type="button" class="px-3 py-1.5 bg-gray-100 dark:bg-gray-800 text-gray-500 rounded-xl text-xs hover:bg-gray-200 transition">
                                রিসেট
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Qibla Direction Card -->
                <div class="p-6 rounded-3xl bg-white dark:bg-gray-900 border border-teal-100 dark:border-gray-800 shadow-md flex flex-col justify-between group hover:border-teal-500/40 transition">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-teal-100 dark:bg-teal-950 text-teal-600 dark:text-teal-400 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                            🧭
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white">কিবলা কম্পাস</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            বিশ্বের যেকোনো প্রান্ত থেকে পবিত্র কাবার সঠিক দিক জানুন।
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-800 text-center">
                        <div class="text-xs font-semibold text-teal-600 dark:text-teal-400 mb-2">কিবলার কোণ: ২৭৮° (পশ্চিম)</div>
                        <a href="{{ url('/tools/qibla') }}" class="block w-full py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-xl text-xs font-semibold transition">
                            কম্পাস খুলুন
                        </a>
                    </div>
                </div>

                <!-- Zakat Calculator Card -->
                <div class="p-6 rounded-3xl bg-white dark:bg-gray-900 border border-amber-100 dark:border-gray-800 shadow-md flex flex-col justify-between group hover:border-amber-500/40 transition">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-amber-100 dark:bg-amber-950 text-amber-600 dark:text-amber-400 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                            💰
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white">যাকাত ক্যালকুলেটর</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            স্বর্ণ, রৌপ্য ও সঞ্চিত অর্থের উপর বার্ষিক যাকাতের নিখুঁত হিসাব।
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-800 text-center">
                        <div class="text-xs font-semibold text-amber-600 dark:text-amber-400 mb-2">হার: ২.৫% (আড়াই শতাংশ)</div>
                        <a href="{{ url('/tools/zakat') }}" class="block w-full py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-semibold transition">
                            হিসাব করুন
                        </a>
                    </div>
                </div>

                <!-- Islamic Quiz Card -->
                <div class="p-6 rounded-3xl bg-white dark:bg-gray-900 border border-purple-100 dark:border-gray-800 shadow-md flex flex-col justify-between group hover:border-purple-500/40 transition">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-purple-100 dark:bg-purple-950 text-purple-600 dark:text-purple-400 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                            ❓
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white">ইসলামিক কুইজ</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            কুরআন, হাদিস ও নবীদের জীবনী সম্পর্কিত জ্ঞান যাচাই করুন।
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-800 text-center">
                        <div class="text-xs font-semibold text-purple-600 dark:text-purple-400 mb-2">আজকের কুইজ: ১০টি প্রশ্ন</div>
                        <a href="{{ url('/tools/quiz') }}" class="block w-full py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-xl text-xs font-semibold transition">
                            কুইজে অংশ নিন
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
