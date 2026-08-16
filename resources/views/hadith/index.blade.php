<x-app-layout>
    <!-- Hadith Hero Header -->
    <section class="relative overflow-hidden bg-gradient-to-b from-emerald-950 via-teal-950 to-slate-950 text-white py-14 sm:py-20 border-b border-emerald-900/40">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="text-3xl sm:text-4xl text-amber-300 font-serif block mb-3" style="font-family: 'Amiri', serif;">
                الحديث الشريف
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight mb-4">
                সহীহ <span class="bg-gradient-to-r from-emerald-400 to-amber-300 bg-clip-text text-transparent">হাদিস কিতাবসমূহ</span>
            </h1>
            <p class="max-w-2xl mx-auto text-sm sm:text-base text-emerald-200/90 leading-relaxed">
                সিহাহ সিত্তাহ ও বিশুদ্ধ হাদিস গ্রন্থের বাংলা অনুবাদ, আরবি পাঠ, রাবি ও সনদ যাচাইসহ পাঠ করুন।
            </p>
        </div>
    </section>

    <!-- Books Directory -->
    <section class="py-12 bg-slate-50 dark:bg-gray-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-800">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">হাদিস কিতাব তালিকা (Hadith Books)</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Explore authentic Hadith collections</p>
                </div>
                <span class="text-xs font-semibold text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/60 px-3 py-1.5 rounded-full border border-emerald-200 dark:border-emerald-800">
                    মোট গ্রন্থ: {{ $books->count() }} টি
                </span>
            </div>

            <!-- Books Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($books as $book)
                    <a href="{{ route('hadith.show', $book->slug ?? $book->id) }}" 
                       class="p-6 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-xl hover:border-emerald-500/40 hover:-translate-y-1 transition duration-200 flex flex-col justify-between group">
                        
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="w-10 h-10 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 flex items-center justify-center text-lg shadow-sm border border-emerald-200/50 dark:border-emerald-800/40">
                                    📜
                                </span>
                                <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">
                                    {{ $book->hadiths_count }} Hadiths
                                </span>
                            </div>

                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                    {{ $book->name }}
                                </h3>
                                @if ($book->name_bangla)
                                    <h4 class="text-sm font-semibold text-emerald-600 dark:text-emerald-400 mt-0.5">
                                        {{ $book->name_bangla }}
                                    </h4>
                                @endif
                            </div>

                            @if ($book->author)
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">
                                    {{ $book->author }}
                                </p>
                            @endif

                            @if ($book->description)
                                <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2 leading-relaxed">
                                    {{ $book->description }}
                                </p>
                            @endif
                        </div>

                        <div class="pt-4 mt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between text-xs">
                            <span class="text-emerald-600 dark:text-emerald-400 font-semibold group-hover:translate-x-1 transition-transform flex items-center gap-1">
                                অধ্যায়সমূহ দেখুন &rarr;
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-16 text-center text-gray-500">
                        <div class="text-5xl mb-3">📜</div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">No Hadith books available.</h3>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
