@extends('layouts.app')

@section('title', 'কুইজ ফলাফল: ' . $category->name . ' — Islamic Site')
@section('meta_description', 'ইসলামিক কুইজ ফলাফল ও সঠিক উত্তরের পর্যালোচনা।')

@section('content')
<div class="bg-slate-50 dark:bg-gray-950 min-h-screen pb-24">

    <!-- Hero Result Header -->
    <section class="relative overflow-hidden bg-slate-900 text-white py-14 sm:py-20 border-b border-teal-800/40">
        <div class="absolute inset-0 bg-gradient-to-br from-teal-950 via-slate-900 to-indigo-950"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-teal-500/20 via-transparent to-transparent"></div>
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#2dd4bf_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 text-center space-y-6">
            
            <!-- Congratulatory Badge -->
            <div class="inline-flex items-center gap-2 px-5 py-1.5 rounded-full bg-amber-500/10 border border-amber-400/30 text-amber-300 backdrop-blur-md shadow-lg shadow-amber-950/30">
                <span class="text-xl sm:text-2xl font-serif tracking-wide" style="font-family: 'Amiri', serif;">
                    نَتِيجَةُ المُسَابَقَةِ
                </span>
            </div>

            <!-- Result Title -->
            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight flex items-center justify-center gap-3 drop-shadow-md">
                <span>🏆</span>
                <span>কুইজের <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-amber-300 bg-clip-text text-transparent">ফলাফল</span></span>
            </h1>

            <p class="text-sm sm:text-base text-teal-100/90 max-w-xl mx-auto leading-relaxed font-medium">
                বিষয়: <strong class="text-white">{{ $category->name }}</strong>
            </p>

            <!-- Score Circular / Large Card -->
            <div class="max-w-md mx-auto p-6 sm:p-8 rounded-3xl bg-white/10 dark:bg-gray-900/60 border border-white/15 backdrop-blur-md shadow-2xl space-y-4">
                <div class="text-5xl sm:text-6xl font-black font-mono {{ $percentage >= 80 ? 'text-amber-400' : ($percentage >= 50 ? 'text-teal-300' : 'text-rose-400') }}">
                    {{ $score }} <span class="text-2xl sm:text-3xl text-gray-300 font-normal">/ {{ $totalQuestions }}</span>
                </div>
                
                <div class="inline-block px-4 py-1.5 rounded-full text-xs font-bold {{ $percentage >= 80 ? 'bg-amber-500/20 text-amber-300 border border-amber-400/40' : ($percentage >= 50 ? 'bg-teal-500/20 text-teal-300 border border-teal-400/40' : 'bg-rose-500/20 text-rose-300 border border-rose-400/40') }}">
                    @if($percentage >= 80)
                        🌟 মাশাআল্লাহ্‌! অসাধারণ জ্ঞান ও চমৎকার ফলাফল!
                    @elseif($percentage >= 50)
                        👍 আলহামদুলিল্লাহ! সন্তোষজনক পারফরম্যান্স।
                    @else
                        📖 আরও অধ্যয়ন করুন এবং পুনরায় চেষ্টা করুন।
                    @endif
                </div>

                <!-- Stats 3-Pills -->
                <div class="grid grid-cols-3 gap-2 pt-2 text-center text-xs">
                    <div class="p-3 rounded-2xl bg-emerald-950/60 border border-emerald-800/60 text-emerald-300">
                        <span class="block text-[11px] text-emerald-400/80">সঠিক উত্তর</span>
                        <strong class="text-lg font-mono font-bold">{{ $correctCount }}</strong>
                    </div>
                    <div class="p-3 rounded-2xl bg-rose-950/60 border border-rose-800/60 text-rose-300">
                        <span class="block text-[11px] text-rose-400/80">ভুল উত্তর</span>
                        <strong class="text-lg font-mono font-bold">{{ $wrongCount }}</strong>
                    </div>
                    <div class="p-3 rounded-2xl bg-slate-950/60 border border-slate-800/60 text-slate-300">
                        <span class="block text-[11px] text-slate-400/80">উত্তরহীন</span>
                        <strong class="text-lg font-mono font-bold">{{ $unansweredCount }}</strong>
                    </div>
                </div>
            </div>

            <!-- Action CTAs -->
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('quiz.start', $category) }}" 
                   class="px-6 py-3 rounded-2xl bg-teal-600 hover:bg-teal-500 text-white font-bold text-sm shadow-lg shadow-teal-900/40 flex items-center gap-2 transition hover:scale-105">
                    <span>🔁</span> <span>আবার চেষ্টা করুন (Play Again)</span>
                </a>
                <a href="{{ route('quiz.index') }}" 
                   class="px-6 py-3 rounded-2xl bg-slate-800 hover:bg-slate-700 text-gray-200 border border-slate-700 font-bold text-sm transition">
                    <span>📚</span> <span>অন্যান্য কুইজ দেখুন</span>
                </a>
            </div>

        </div>
    </section>

    <!-- Detailed Question-by-Question Review -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-10 space-y-6">
        <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 pb-4">
            <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <span>📝</span> <span>বিস্তারিত উত্তর পর্যালোচনা ও রেফারেন্স</span>
            </h2>
            <span class="text-xs text-gray-500">
                মোট {{ $questions->count() }}টি প্রশ্ন
            </span>
        </div>

        @foreach($questions as $index => $question)
            @php
                $userAns = $answers[$question->id] ?? null;
                $isCorrect = ($userAns !== null && strtolower($userAns) === strtolower($question->correct_answer));
                $isUnanswered = ($userAns === null);
            @endphp

            <div class="rounded-3xl bg-white dark:bg-gray-900 border {{ $isCorrect ? 'border-emerald-200 dark:border-emerald-900/60' : ($isUnanswered ? 'border-gray-200 dark:border-gray-800' : 'border-rose-200 dark:border-rose-900/60') }} p-6 sm:p-7 shadow-sm space-y-5">
                
                <!-- Question Header -->
                <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 pb-3">
                    <div class="inline-flex items-center gap-2">
                        <span class="w-7 h-7 rounded-xl bg-slate-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-mono font-bold text-xs flex items-center justify-center">
                            {{ $index + 1 }}
                        </span>
                        <span class="text-xs font-bold text-gray-400">প্রশ্ন {{ $index + 1 }}</span>
                    </div>

                    <div>
                        @if($isCorrect)
                            <span class="px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 text-xs font-bold flex items-center gap-1">
                                <span>✓</span> <span>সঠিক উত্তর</span>
                            </span>
                        @elseif($isUnanswered)
                            <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 text-xs font-bold">
                                ⚠️ উত্তর দেননি
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-rose-100 dark:bg-rose-950 text-rose-700 dark:text-rose-300 text-xs font-bold flex items-center gap-1">
                                <span>✗</span> <span>ভুল উত্তর</span>
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Question Text -->
                <h3 class="text-base font-bold text-gray-900 dark:text-white leading-relaxed">
                    {{ $question->question }}
                </h3>

                <!-- 4 Options Review Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 pt-1">
                    @foreach(['a' => $question->option_a, 'b' => $question->option_b, 'c' => $question->option_c, 'd' => $question->option_d] as $optKey => $optVal)
                        @php
                            $isThisCorrect = (strtolower($optKey) === strtolower($question->correct_answer));
                            $isUserChoice = (strtolower($userAns ?? '') === strtolower($optKey));
                        @endphp

                        <div class="p-3.5 rounded-2xl border text-xs flex items-center justify-between gap-2 transition {{ $isThisCorrect ? 'bg-emerald-50 dark:bg-emerald-950/60 border-emerald-400 text-emerald-900 dark:text-emerald-200 font-bold' : ($isUserChoice ? 'bg-rose-50 dark:bg-rose-950/60 border-rose-400 text-rose-900 dark:text-rose-200 font-medium line-through' : 'bg-slate-50/50 dark:bg-gray-800/40 border-gray-100 dark:border-gray-800 text-gray-600 dark:text-gray-300') }}">
                            <div class="flex items-center gap-2.5">
                                <span class="w-6 h-6 rounded-lg {{ $isThisCorrect ? 'bg-emerald-600 text-white' : ($isUserChoice ? 'bg-rose-600 text-white' : 'bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-300') }} font-bold text-[11px] flex items-center justify-center shadow-xs">
                                    {{ strtoupper($optKey) }}
                                </span>
                                <span>{{ $optVal }}</span>
                            </div>
                            @if($isThisCorrect)
                                <span class="text-emerald-600 dark:text-emerald-400 text-xs font-bold whitespace-nowrap">✓ সঠিক উত্তর</span>
                            @elseif($isUserChoice)
                                <span class="text-rose-600 dark:text-rose-400 text-xs font-bold whitespace-nowrap">✗ আপনার ভুল উত্তর</span>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Explanation Box -->
                @if($question->explanation)
                    <div class="p-4 rounded-2xl bg-teal-50/70 dark:bg-teal-950/40 border border-teal-200/60 dark:border-teal-800/60 text-xs space-y-1">
                        <div class="font-bold text-teal-800 dark:text-teal-300 flex items-center gap-1.5">
                            <span>📖</span> <span>ব্যাখ্যা ও দলিল:</span>
                        </div>
                        <p class="text-teal-900 dark:text-teal-200 leading-relaxed font-normal">
                            {{ $question->explanation }}
                        </p>
                    </div>
                @endif

            </div>
        @endforeach

        <!-- Bottom Actions -->
        <div class="text-center pt-6">
            <a href="{{ route('quiz.index') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-2xl bg-teal-600 hover:bg-teal-500 text-white font-bold text-sm shadow-md transition hover:scale-105">
                <span>📚</span> <span>সকল কুইজ ক্যাটাগরিতে ফিরে যান</span>
            </a>
        </div>

    </div>

</div>
@endsection
