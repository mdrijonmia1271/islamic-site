@extends('layouts.app')

@section('title', 'কুইজ: ' . $category->name . ' — Islamic Site')
@section('meta_description', 'ইসলামিক কুইজে অংশগ্রহণ করুন।')

@section('content')
<div class="bg-gray-50 dark:bg-gray-950 min-h-screen py-8 sm:py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

        <!-- Top Navigation & Header -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-gray-200 dark:border-gray-800">
            <div>
                <a href="{{ route('quiz.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline mb-2">
                    &larr; কুইজ ক্যাটাগরিতে ফিরে যান
                </a>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 px-2 py-0.5 rounded-md">
                        🧠 কুইজ চলছে
                    </span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                    {{ $category->name }}
                </h1>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">
                    মোট {{ $questions->count() }}টি প্রশ্ন • প্রতিটি প্রশ্নের সঠিক উত্তর নির্বাচন করুন
                </p>
            </div>

            <!-- Progress Badge -->
            <div class="self-start sm:self-center flex items-center gap-2 px-4 py-2 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                <span class="text-xs font-bold text-gray-500 dark:text-gray-400">উত্তর দেওয়া হয়েছে:</span>
                <span id="answeredCountBadge" class="text-sm font-black text-emerald-600 dark:text-emerald-400 font-mono">০ / {{ $questions->count() }}</span>
            </div>
        </div>

        <!-- Quiz Form -->
        <form id="quizForm" method="POST" action="{{ route('quiz.submit', $category) }}" class="space-y-6">
            @csrf

            <!-- Hidden Question IDs -->
            @foreach($questions as $question)
                <input type="hidden" name="question_ids[]" value="{{ $question->id }}">
            @endforeach

            <!-- Questions List -->
            @foreach($questions as $index => $question)
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 sm:p-8 shadow-sm transition-all question-block" data-qid="{{ $question->id }}">
                    
                    <!-- Question Header & Number -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 font-bold text-xs">
                            প্রশ্ন {{ $index + 1 }}
                        </span>
                        <span class="status-indicator text-xs font-medium text-gray-400 hidden">
                            ✓ নির্বাচিত
                        </span>
                    </div>

                    <!-- Question Text (Large & Super Clear) -->
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white leading-relaxed mb-6">
                        {{ $question->question }}
                    </h2>

                    <!-- 4 Options Stacked for Maximum Readability -->
                    <div class="space-y-3">
                        @foreach([
                            'a' => ['label' => 'ক', 'text' => $question->option_a],
                            'b' => ['label' => 'খ', 'text' => $question->option_b],
                            'c' => ['label' => 'গ', 'text' => $question->option_c],
                            'd' => ['label' => 'ঘ', 'text' => $question->option_d],
                        ] as $key => $opt)
                            <label class="quiz-option flex items-center gap-4 p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/40 hover:bg-emerald-50/40 dark:hover:bg-emerald-950/30 hover:border-emerald-400 dark:hover:border-emerald-600 cursor-pointer transition-all">
                                <input type="radio" 
                                       name="answers[{{ $question->id }}]" 
                                       value="{{ $key }}" 
                                       class="sr-only"
                                       onchange="onSelectAnswer(this, {{ $question->id }})">
                                
                                <!-- Custom Radio Circle -->
                                <div class="radio-indicator w-7 h-7 rounded-full border-2 border-gray-300 dark:border-gray-600 flex items-center justify-center flex-shrink-0 transition-colors bg-white dark:bg-gray-800">
                                    <span class="option-letter text-xs font-bold text-gray-600 dark:text-gray-400">{{ $opt['label'] }}</span>
                                </div>

                                <!-- Option Text -->
                                <span class="option-text text-sm sm:text-base font-medium text-gray-800 dark:text-gray-200 leading-normal flex-grow">
                                    {{ $opt['text'] }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                </div>
            @endforeach

            <!-- Submit Box -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 sm:p-8 text-center space-y-4 shadow-sm">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    সবগুলো প্রশ্নের উত্তর নিশ্চিত করার পর ফলাফল দেখতে সাবমিট করুন।
                </p>

                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ route('quiz.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs sm:text-sm font-semibold transition">
                        বাতিল করুন
                    </a>
                    <button type="submit" class="px-8 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm sm:text-base font-bold shadow-md shadow-emerald-600/20 hover:shadow-lg transition cursor-pointer">
                        কুইজ জমা দিন (Submit Quiz) &rarr;
                    </button>
                </div>
            </div>

        </form>

    </div>
</div>

<style>
/* Clean & Clear Active Selection Style */
.quiz-option.active-selected {
    border-color: #059669 !important; /* emerald-600 */
    background-color: #ecfdf5 !important; /* emerald-50 */
}
.dark .quiz-option.active-selected {
    border-color: #10b981 !important; /* emerald-500 */
    background-color: rgba(6, 78, 59, 0.4) !important; /* emerald-950 */
}
.quiz-option.active-selected .radio-indicator {
    border-color: #059669 !important;
    background-color: #059669 !important;
}
.dark .quiz-option.active-selected .radio-indicator {
    border-color: #10b981 !important;
    background-color: #10b981 !important;
}
.quiz-option.active-selected .option-letter {
    color: #ffffff !important;
}
.quiz-option.active-selected .option-text {
    font-weight: 700 !important;
    color: #064e3b !important; /* emerald-900 */
}
.dark .quiz-option.active-selected .option-text {
    color: #a7f3d0 !important; /* emerald-200 */
}
</style>

@push('scripts')
<script>
const totalQuestionsCount = {{ $questions->count() }};

function onSelectAnswer(inputElem, qid) {
    const block = document.querySelector(`.question-block[data-qid="${qid}"]`);
    if (!block) return;

    // Reset previous selections in this question
    const options = block.querySelectorAll('.quiz-option');
    options.forEach(opt => opt.classList.remove('active-selected'));

    // Highlight the selected option
    const parentLabel = inputElem.closest('.quiz-option');
    if (parentLabel) {
        parentLabel.classList.add('active-selected');
    }

    // Show indicator
    const indicator = block.querySelector('.status-indicator');
    if (indicator) {
        indicator.classList.remove('hidden');
        indicator.classList.add('text-emerald-600', 'dark:text-emerald-400');
    }

    // Update count badge
    updateProgressBadge();
}

function updateProgressBadge() {
    const answered = document.querySelectorAll('input[type="radio"]:checked').length;
    const badge = document.getElementById('answeredCountBadge');
    if (badge) {
        badge.innerText = `${answered} / ${totalQuestionsCount}`;
    }
}

document.getElementById('quizForm').addEventListener('submit', function (e) {
    const answered = document.querySelectorAll('input[type="radio"]:checked').length;
    if (answered < totalQuestionsCount) {
        if (!confirm(`আপনি মোট ${totalQuestionsCount}টি প্রশ্নের মধ্যে ${answered}টির উত্তর দিয়েছেন।\n\nআপনি কি বাকি প্রশ্নের উত্তর না দিয়েই কুইজ জমা দিতে চান?`)) {
            e.preventDefault();
        }
    }
});
</script>
@endpush
@endsection
