<x-app-layout>
    <div class="bg-slate-50 dark:bg-gray-950 min-h-screen pb-20">
        
        <!-- Sticky Navigation Header -->
        <div class="sticky top-20 z-30 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 shadow-sm py-3">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ route('hadith.index') }}" class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline flex items-center gap-1">
                        &larr; <span>সকল হাদিস গ্রন্থ</span>
                    </a>
                    <span class="text-gray-300 dark:text-gray-700">&bull;</span>
                    <span class="text-xs font-bold text-gray-800 dark:text-gray-200">{{ $hadithBook->name }}</span>
                </div>

                <span class="text-xs px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 font-semibold">
                    {{ $hadithBook->chapters->count() }} টি অধ্যায়
                </span>
            </div>
        </div>

        <!-- Hadith Book Hero Header -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-8">
            <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-br from-emerald-900 via-teal-900 to-slate-950 text-white shadow-xl relative overflow-hidden border border-emerald-800/40 text-center space-y-3">
                <div class="relative z-10 space-y-2">
                    <h1 class="text-3xl sm:text-5xl font-extrabold text-white">
                        {{ $hadithBook->name }}
                    </h1>
                    
                    @if ($hadithBook->name_bangla)
                        <h2 class="text-xl sm:text-2xl font-bold text-emerald-300">
                            {{ $hadithBook->name_bangla }}
                        </h2>
                    @endif

                    @if ($hadithBook->author)
                        <p class="text-sm text-slate-300 font-medium pt-1">
                            {{ $hadithBook->author }}
                        </p>
                    @endif

                    @if ($hadithBook->description)
                        <p class="text-xs text-slate-400 max-w-xl mx-auto pt-2 leading-relaxed">
                            {{ $hadithBook->description }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Chapters List Section -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 pb-3">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    অধ্যায়সমূহ (Chapters)
                </h3>
                <span class="text-xs text-gray-500 dark:text-gray-400">ধারাবাহিক ক্রমানুসারে</span>
            </div>

            <div class="space-y-4">
                @forelse ($hadithBook->chapters as $chapter)
                    <div class="p-6 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md hover:border-emerald-500/40 transition space-y-4">
                        
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-emerald-50 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 font-bold text-sm flex items-center justify-center border border-emerald-200 dark:border-emerald-800 shrink-0">
                                    {{ $chapter->chapter_number }}
                                </div>
                                <div>
                                    <h4 class="text-base font-bold text-gray-900 dark:text-white">
                                        Chapter {{ $chapter->chapter_number }}: {{ $chapter->name }}
                                    </h4>
                                    @if ($chapter->name_bangla)
                                        <p class="text-sm font-semibold text-emerald-600 dark:text-emerald-400 mt-0.5">
                                            {{ $chapter->name_bangla }}
                                        </p>
                                    @endif
                                    @if ($chapter->description)
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {{ $chapter->description }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <span class="text-xs font-semibold px-3 py-1.5 rounded-full bg-slate-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 self-start sm:self-center">
                                {{ $chapter->hadiths()->count() }} হাদিস
                            </span>
                        </div>

                        <!-- If chapter has hadiths, show them nicely -->
                        @if ($chapter->hadiths()->exists())
                            <div class="pt-4 border-t border-gray-100 dark:border-gray-800 space-y-4">
                                @foreach ($chapter->hadiths as $hadith)
                                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-gray-800/60 border border-gray-200/70 dark:border-gray-700/60 space-y-3">
                                        <div class="flex items-center justify-between text-xs">
                                            <div class="flex items-center gap-2">
                                                <span class="font-bold text-emerald-700 dark:text-emerald-300">
                                                    হাদিস নং #{{ $hadith->hadith_number }}
                                                </span>
                                                @if ($hadith->grade)
                                                    <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800/60">
                                                        মান: {{ $hadith->grade }}
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Hadith Bookmark & Favorite Buttons -->
                                            <div class="flex items-center gap-1.5">
                                                @auth
                                                    @php
                                                        $isFavHadith = $hadith->favorites()->where('user_id', auth()->id())->exists();
                                                        $isBmHadith = $hadith->bookmarks()->where('user_id', auth()->id())->exists();
                                                    @endphp

                                                    <!-- Bookmark Button -->
                                                    @if($isBmHadith)
                                                        <form method="POST" action="{{ route('bookmark.destroy') }}" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="type" value="hadith">
                                                            <input type="hidden" name="id" value="{{ $hadith->id }}">
                                                            <button type="submit" class="px-2 py-1 rounded-lg bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 border border-amber-200 dark:border-amber-800 text-xs font-bold flex items-center gap-1 transition shadow-sm" title="বুকমার্ক থেকে সরান">
                                                                <span>🔖</span>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form method="POST" action="{{ route('bookmark.store') }}" class="inline">
                                                            @csrf
                                                            <input type="hidden" name="type" value="hadith">
                                                            <input type="hidden" name="id" value="{{ $hadith->id }}">
                                                            <button type="submit" class="px-2 py-1 rounded-lg text-gray-400 hover:text-amber-600 hover:bg-amber-50 dark:hover:bg-gray-800 text-xs font-semibold flex items-center gap-1 transition" title="পরে পড়ার জন্য বুকমার্ক করুন">
                                                                <span>🏷️</span>
                                                            </button>
                                                        </form>
                                                    @endif

                                                    <!-- Favorite Button -->
                                                    @if($isFavHadith)
                                                        <form method="POST" action="{{ route('favorites.destroy') }}" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="type" value="hadith">
                                                            <input type="hidden" name="id" value="{{ $hadith->id }}">
                                                            <button type="submit" class="px-2.5 py-1 rounded-lg bg-red-50 dark:bg-red-950/60 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800 text-xs font-bold flex items-center gap-1 transition shadow-sm" title="সংরক্ষিত তালিকা থেকে সরান">
                                                                <span>❤️</span> <span class="hidden sm:inline">Saved</span>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form method="POST" action="{{ route('favorites.store') }}" class="inline">
                                                            @csrf
                                                            <input type="hidden" name="type" value="hadith">
                                                            <input type="hidden" name="id" value="{{ $hadith->id }}">
                                                            <button type="submit" class="px-2.5 py-1 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-gray-800 text-xs font-semibold flex items-center gap-1 transition" title="পছন্দের তালিকায় রাখুন">
                                                                <span>🤍</span> <span class="hidden sm:inline">Save</span>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @else
                                                    <a href="{{ route('login') }}" class="px-2 py-1 rounded-lg text-gray-400 hover:text-emerald-600 text-xs font-semibold transition" title="সেভ বা বুকমার্ক করতে লগইন করুন">
                                                        <span>🔖</span>
                                                    </a>
                                                @endauth
                                            </div>
                                        </div>

                                        @if ($hadith->narrator)
                                            <div class="text-xs font-semibold text-gray-600 dark:text-gray-300">
                                                👤 বর্ণনাকারী: {{ $hadith->narrator }}
                                            </div>
                                        @endif

                                        <div dir="rtl" class="text-right leading-loose text-gray-900 dark:text-emerald-100 font-normal py-1" style="font-family: 'Amiri', serif; font-size: 24px; line-height: 2.2;">
                                            {{ $hadith->arabic_text }}
                                        </div>

                                        @if ($hadith->bangla_text)
                                            <p class="text-sm sm:text-base text-gray-800 dark:text-gray-200 font-medium leading-relaxed">
                                                {{ $hadith->bangla_text }}
                                            </p>
                                        @endif

                                        @if ($hadith->reference)
                                            <div class="text-right text-[11px] text-gray-400">
                                                রেফারেন্স: {{ $hadith->reference }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                @empty
                    <div class="p-16 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 text-center shadow-md">
                        <div class="text-4xl mb-3">📑</div>
                        <h4 class="text-base font-bold text-gray-900 dark:text-white">No chapters available.</h4>
                        <p class="text-xs text-gray-500 mt-1">
                            এই কিতাবের অধ্যায় ও হাদিসসমূহ শীঘ্রই যুক্ত করা হবে।
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Automatic Reading History Recording for Hadith -->
    @auth
        @if(isset($hadiths) && $hadiths->first())
            <form id="hadith-history-form" method="POST" action="{{ route('history.store') }}" class="hidden">
                @csrf
                <input type="hidden" name="type" value="hadith">
                <input type="hidden" name="id" value="{{ $hadiths->first()->id }}">
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const form = document.getElementById('hadith-history-form');
                    if (form) {
                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams(new FormData(form))
                        }).catch(err => console.error('Hadith history tracking error:', err));
                    }
                });
            </script>
        @endif
    @endauth
</x-app-layout>
