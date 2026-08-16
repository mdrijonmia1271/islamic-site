<footer class="bg-gray-900 text-gray-300 border-t border-emerald-950 mt-auto">
    <!-- Top Decorative Gradient -->
    <div class="h-1 bg-gradient-to-r from-emerald-600 via-teal-500 to-amber-500"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            <!-- Brand Column -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-700 flex items-center justify-center text-white shadow-lg shadow-emerald-500/20">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79.09-.39.46-.65.85-.59.39.06.68.42.61.81-.11.51-.17 1.03-.17 1.57 0 3.86 3.14 7 7 7 .54 0 1.06-.06 1.57-.17.39-.07.75.22.81.61.06.39-.2.76-.59.85-.58.13-1.17.21-1.79.21zm4.86-5.83c-.36.16-.78-.01-.94-.37-.16-.36.01-.78.37-.94 1.09-.48 1.71-1.61 1.71-2.79 0-1.65-1.35-3-3-3-.45 0-.87.1-1.25.28-.35.17-.78.02-.95-.33-.17-.35-.02-.78.33-.95.58-.28 1.21-.43 1.87-.43 2.42 0 4.4 1.91 4.49 4.31.06 1.56-.71 3.01-2.23 3.72zM15 7.5a1.25 1.25 0 110-2.5 1.25 1.25 0 010 2.5z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-lg font-bold text-white tracking-tight">Islamic Site</div>
                        <div class="text-xs text-emerald-400">আলো ও হেদায়েতের প্ল্যাটফর্ম</div>
                    </div>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed">
                    সহজে কুরআন, হাদিস, দোয়া ও ইসলামিক টুলস এক জায়গায় নিয়ে আসার একটি আধুনিক প্ল্যাটফর্ম।
                </p>
                <div class="p-3.5 rounded-xl bg-emerald-950/40 border border-emerald-800/40 text-xs text-emerald-300 italic">
                    "নিশ্চয়ই কষ্টের সাথে স্বস্তি রয়েছে।" <br><span class="text-gray-400 not-italic">— সূরা আল-ইনশিরাহ (৯৪:৬)</span>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-emerald-400 mb-4">মৌলিক বিষয়সমূহ</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ url('/') }}" class="hover:text-emerald-400 transition-colors">Home</a></li>
                    <li><a href="{{ url('/quran') }}" class="hover:text-emerald-400 transition-colors">Quran (কুরআন)</a></li>
                    <li><a href="{{ url('/hadith') }}" class="hover:text-emerald-400 transition-colors">Hadith (হাদিস)</a></li>
                    <li><a href="{{ url('/dua-azkar') }}" class="hover:text-emerald-400 transition-colors">Dua &amp; Azkar (দোয়া ও জিকির)</a></li>
                    <li><a href="{{ url('/prayer-time') }}" class="hover:text-emerald-400 transition-colors">Prayer Time (নামাজের সময়)</a></li>
                </ul>
            </div>

            <!-- More & Islamic Tools -->
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-emerald-400 mb-4">ইসলামিক টুলস ও বিষয়</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ url('/calendar') }}" class="hover:text-emerald-400 transition-colors">Islamic Calendar (হিজরি ক্যালেন্ডার)</a></li>
                    <li><a href="{{ url('/articles') }}" class="hover:text-emerald-400 transition-colors">Articles (ইসলামিক প্রবন্ধ)</a></li>
                    <li><a href="{{ url('/tools/tasbih') }}" class="hover:text-emerald-400 transition-colors">Tasbih (ডিজিটাল তাসবিহ)</a></li>
                    <li><a href="{{ url('/tools/qibla') }}" class="hover:text-emerald-400 transition-colors">Qibla (কিবলা কম্পাস)</a></li>
                    <li><a href="{{ url('/tools/zakat') }}" class="hover:text-emerald-400 transition-colors">Zakat Calculator (যাকাত ক্যালকুলেটর)</a></li>
                    <li><a href="{{ url('/tools/quiz') }}" class="hover:text-emerald-400 transition-colors">Islamic Quiz (ইসলামিক কুইজ)</a></li>
                </ul>
            </div>

            <!-- Daily Reminder / Newsletter info -->
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-emerald-400 mb-4">দৈনিক হাদিস ও হেদায়েত</h3>
                <p class="text-xs text-gray-400 mb-4">
                    রাসূলুল্লাহ (সা.) বলেছেন: "তোমাদের মধ্যে সেই ব্যক্তি সর্বোত্তম, যে কুরআন শেখে এবং অন্যকে শেখায়।" (সহিহ বুখারি)
                </p>
                <div class="flex items-center gap-2 pt-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-900/60 text-emerald-300 border border-emerald-700/50">
                        Islamic Web Platform
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-900/60 text-amber-300 border border-amber-700/50">
                        Bismillah
                    </span>
                </div>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-500 gap-4">
            <p>&copy; {{ date('Y') }} Islamic Site. All rights reserved.</p>
            <p class="flex items-center gap-1 text-gray-400">
                Created with <span class="text-emerald-500">&hearts;</span> for the Muslim Ummah
            </p>
        </div>
    </div>
</footer>
