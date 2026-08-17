<x-app-layout>
    <div x-data="{ arabicSize: 28, copiedIndex: null }" class="bg-slate-50 dark:bg-gray-950 min-h-screen pb-20">
        
        <!-- Sticky Navigation Header -->
        <div class="sticky top-20 z-30 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 shadow-sm py-3">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <a href="{{ route('duas.index') }}" class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline flex items-center gap-1">
                        &larr; <span>সকল দু'আ ক্যাটাগরি</span>
                    </a>
                    <span class="text-gray-300 dark:text-gray-700">&bull;</span>
                    <span class="text-xs font-bold text-gray-800 dark:text-gray-200">{{ $duaCategory->name_bangla ?? $duaCategory->name }}</span>
                </div>

                <!-- Font Size Controls -->
                <div class="inline-flex items-center rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-0.5 text-xs">
                    <button @click="if (arabicSize > 20) arabicSize -= 2" type="button" class="px-2.5 py-1 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg font-semibold" title="ফন্ট ছোট করুন">
                        A-
                    </button>
                    <span class="px-2 text-[11px] font-semibold text-gray-500" x-text="arabicSize + 'px'"></span>
                    <button @click="if (arabicSize < 48) arabicSize += 2" type="button" class="px-2.5 py-1 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg font-semibold" title="ফন্ট বড় করুন">
                        A+
                    </button>
                </div>
            </div>
        </div>

        <!-- Category Hero Banner -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-8">
            <div class="p-8 sm:p-10 rounded-3xl bg-gradient-to-br from-emerald-900 via-teal-900 to-slate-950 text-white shadow-xl relative overflow-hidden border border-emerald-800/40 text-center space-y-2">
                <h1 class="text-3xl sm:text-5xl font-extrabold text-white">
                    {{ $duaCategory->name }}
                </h1>
                
                @if ($duaCategory->name_bangla)
                    <h2 class="text-xl sm:text-2xl font-bold text-emerald-300">
                        {{ $duaCategory->name_bangla }}
                    </h2>
                @endif

                @if ($duaCategory->description)
                    <p class="text-xs sm:text-sm text-slate-300 max-w-xl mx-auto pt-2 leading-relaxed">
                        {{ $duaCategory->description }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Duas Feed List -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @forelse ($duas as $dua)
                <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-md hover:shadow-lg transition space-y-5" id="dua-{{ $dua->id }}">
                    
                    <!-- Dua Title Header & Actions -->
                    <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 pb-3.5">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                {{ $dua->title }}
                            </h3>
                            @if ($dua->title_bangla)
                                <h4 class="text-sm font-semibold text-emerald-600 dark:text-emerald-400 mt-0.5">
                                    {{ $dua->title_bangla }}
                                </h4>
                            @endif
                        </div>

                        <div class="flex items-center gap-2">
                            <!-- Bookmark & Favorite Buttons -->
                            @auth
                                @php
                                    $isFavDua = $dua->favorites()->where('user_id', auth()->id())->exists();
                                    $isBmDua = $dua->bookmarks()->where('user_id', auth()->id())->exists();
                                @endphp

                                <!-- Bookmark Button -->
                                @if($isBmDua)
                                    <form method="POST" action="{{ route('bookmark.destroy') }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="type" value="dua">
                                        <input type="hidden" name="id" value="{{ $dua->id }}">
                                        <button type="submit" class="p-2 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 border border-amber-200 dark:border-amber-800 text-xs font-bold flex items-center gap-1 transition shadow-sm" title="বুকমার্ক থেকে সরান">
                                            <span>🔖</span>
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('bookmark.store') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="type" value="dua">
                                        <input type="hidden" name="id" value="{{ $dua->id }}">
                                        <button type="submit" class="p-2 rounded-xl text-gray-400 hover:text-amber-600 hover:bg-amber-50 dark:hover:bg-gray-800 text-xs font-semibold flex items-center gap-1 transition" title="পরে পড়ার জন্য বুকমার্ক করুন">
                                            <span>🏷️</span>
                                        </button>
                                    </form>
                                @endif

                                <!-- Favorite Button -->
                                @if($isFavDua)
                                    <form method="POST" action="{{ route('favorites.destroy') }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="type" value="dua">
                                        <input type="hidden" name="id" value="{{ $dua->id }}">
                                        <button type="submit" class="p-2 rounded-xl bg-red-50 dark:bg-red-950/60 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800 text-xs font-bold flex items-center gap-1 transition shadow-sm" title="সংরক্ষিত তালিকা থেকে সরান">
                                            <span>❤️</span>
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('favorites.store') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="type" value="dua">
                                        <input type="hidden" name="id" value="{{ $dua->id }}">
                                        <button type="submit" class="p-2 rounded-xl text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-gray-800 text-xs font-semibold flex items-center gap-1 transition" title="পছন্দের তালিকায় রাখুন">
                                            <span>🤍</span>
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="p-2 rounded-xl text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-gray-800 text-xs font-semibold flex items-center gap-1 transition" title="সেভ বা বুকমার্ক করতে লগইন করুন">
                                    <span>🔖</span>
                                </a>
                            @endauth

                            <!-- 1-Click Copy Button -->
                            <button @click="navigator.clipboard.writeText('{{ addslashes($dua->arabic_text) }} \n\nউচ্চারণ: {{ addslashes($dua->transliteration ?? '') }} \n\nঅর্থ: {{ addslashes($dua->bangla_meaning ?? '') }} \n\n[{{ addslashes($dua->reference ?? '') }}]'); copiedIndex = {{ $dua->id }}; setTimeout(() => copiedIndex = null, 2000)" 
                                    type="button" class="p-2 rounded-xl text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-gray-800 transition text-xs font-semibold flex items-center gap-1" title="দু'আ কপি করুন">
                                <span x-show="copiedIndex !== {{ $dua->id }}">📋 কপি</span>
                                <span x-show="copiedIndex === {{ $dua->id }}" class="text-emerald-600 font-bold">✓ কপি হয়েছে!</span>
                            </button>
                        </div>
                    </div>

                    <!-- Arabic Text -->
                    <div dir="rtl" class="text-right leading-loose text-gray-900 dark:text-amber-200 font-normal py-2 select-text" 
                         :style="'font-size: ' + arabicSize + 'px; font-family: \'Amiri\', serif; line-height: 2.3;'">
                        {{ $dua->arabic_text }}
                    </div>

                    <!-- Transliteration (উচ্চারণ) -->
                    @if ($dua->transliteration)
                        <div class="p-4 rounded-2xl bg-emerald-50/60 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/40 space-y-1">
                            <span class="text-[11px] font-bold text-emerald-700 dark:text-emerald-300 uppercase tracking-wider block">
                                উচ্চারণ:
                            </span>
                            <p class="text-sm text-gray-800 dark:text-gray-200 italic leading-relaxed">
                                {{ $dua->transliteration }}
                            </p>
                        </div>
                    @endif

                    <!-- Bangla Meaning (বাংলা অর্থ) -->
                    @if ($dua->bangla_meaning)
                        <div class="space-y-1 pt-1">
                            <span class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider block">
                                বাংলা অর্থ:
                            </span>
                            <p class="text-base text-gray-800 dark:text-gray-200 font-medium leading-relaxed">
                                {{ $dua->bangla_meaning }}
                            </p>
                        </div>
                    @endif

                    <!-- English Meaning -->
                    @if ($dua->english_meaning)
                        <div class="text-xs text-gray-500 dark:text-gray-400 pt-1">
                            <span class="font-semibold text-gray-600 dark:text-gray-300">English:</span> {{ $dua->english_meaning }}
                        </div>
                    @endif

                    <!-- Audio URL Player -->
                    @if ($dua->audio_url)
                        <div class="pt-2">
                            <audio controls class="w-full h-10 rounded-xl">
                                <source src="{{ $dua->audio_url }}" type="audio/mpeg">
                                আপনার ব্রাউজার অডিও সাপোর্ট করে না।
                            </audio>
                        </div>
                    @endif

                    <!-- Footer: Reference & Source -->
                    @if ($dua->reference || $dua->source)
                        <div class="pt-3 border-t border-gray-100 dark:border-gray-800 flex flex-wrap items-center justify-between text-xs text-gray-400">
                            @if ($dua->reference)
                                <span>রেফারেন্স: <strong class="text-gray-600 dark:text-gray-300">{{ $dua->reference }}</strong></span>
                            @endif
                            @if ($dua->source)
                                <span>উৎস: {{ $dua->source }}</span>
                            @endif
                        </div>
                    @endif

                </div>
            @empty
                <div class="p-16 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 text-center shadow-md">
                    <div class="text-5xl mb-3">🤲</div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">No Dua available.</h3>
                    <p class="text-xs text-gray-500 mt-1">
                        এই ক্যাটাগরির দু'আসমূহ শীঘ্রই যুক্ত করা হবে।
                    </p>
                    <a href="{{ route('duas.index') }}" class="mt-4 inline-block px-5 py-2 rounded-xl bg-emerald-600 text-white text-xs font-semibold shadow-md">
                        অন্যান্য ক্যাটাগরি দেখুন &rarr;
                    </a>
                </div>
            @endforelse
        </div>

    </div>

    <!-- Automatic Reading History Recording for Dua -->
    @auth
        @if(isset($duas) && $duas->first())
            <form id="dua-history-form" method="POST" action="{{ route('history.store') }}" class="hidden">
                @csrf
                <input type="hidden" name="type" value="dua">
                <input type="hidden" name="id" value="{{ $duas->first()->id }}">
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const form = document.getElementById('dua-history-form');
                    if (form) {
                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams(new FormData(form))
                        }).catch(err => console.error('Dua history tracking error:', err));
                    }
                });
            </script>
        @endif
    @endauth
</x-app-layout>
