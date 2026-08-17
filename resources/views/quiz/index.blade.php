@extends('layouts.app')

@section('title', 'ইসলামিক কুইজ (Islamic Quiz) — Test Your Islamic Knowledge')
@section('meta_description', 'পবিত্র কুরআন, সহিহ হাদিস, নবীগণের জীবনী ও ইসলামের মৌলিক বিষয়ের ওপর অনলাইন ইসলামিক কুইজ।')

@section('content')
<div class="bg-gray-50 dark:bg-gray-950 min-h-screen pb-20">

    <!-- Quiz Hero Header -->
    <section class="relative overflow-hidden bg-gradient-to-b from-emerald-950 via-teal-950 to-slate-950 text-white py-14 sm:py-20 border-b border-emerald-900/40">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 text-center space-y-3">
            <span class="text-3xl sm:text-4xl text-amber-300 font-serif block mb-2" style="font-family: 'Amiri', serif;">
                المُسَابَقَةُ الإِسْلَامِيَّةُ
            </span>

            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-400/30 text-emerald-300 text-xs font-bold tracking-wide shadow-sm">
                <span>🧠</span> <span>ইসলামিক জ্ঞান চর্চা ও যাচাই</span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
                ইসলামিক <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-amber-300 bg-clip-text text-transparent">কুইজ</span>
            </h1>

            <p class="text-sm sm:text-base text-emerald-100/90 max-w-xl mx-auto leading-relaxed font-medium">
                পবিত্র কুরআন, সুন্নাহ, আম্বিয়ায়ে কেরাম ও ইসলামের বুনিয়াদী বিষয়ের ওপর আপনার জ্ঞান যাচাই করুন ও নতুন তথ্য জানুন।
            </p>
        </div>
    </section>

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

        <!-- Flash Messages -->
        @if (session('error'))
            <div class="p-4 rounded-xl bg-red-50 dark:bg-red-950/80 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 text-sm font-semibold flex items-center gap-2 shadow-sm">
                <span>⚠️</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Guidelines Clean Box -->
        <div class="p-6 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl flex-shrink-0">
                    💡
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">কুইজের নিয়মাবলী</h3>
                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-0.5 leading-relaxed">
                        প্রতিটি কুইজে বহুনির্বাচনী প্রশ্ন থাকবে। কোনো নেগেটিভ মার্কিং নেই। কুইজ শেষে উত্তরের বিস্তারিত ব্যাখ্যা ও রেফারেন্স দেখতে পাবেন।
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-2 text-xs font-bold flex-shrink-0">
                <span class="px-3 py-1.5 rounded-lg bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                    ✓ তাৎক্ষণিক ফলাফল
                </span>
                <span class="px-3 py-1.5 rounded-lg bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                    📖 সহিহ রেফারেন্স
                </span>
            </div>
        </div>

        <!-- Quiz Categories Section -->
        <div>
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">
                        কুইজ ক্যাটাগরিসমূহ
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                        পছন্দের বিষয় নির্বাচন করে কুইজে অংশগ্রহণ করুন
                    </p>
                </div>
                <span class="text-xs font-bold text-gray-500 dark:text-gray-400 px-3 py-1 rounded-lg bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800">
                    মোট {{ $categories->count() }}টি বিষয়
                </span>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($categories as $category)
                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 sm:p-7 shadow-sm hover:shadow-md hover:border-emerald-500 transition flex flex-col justify-between group">
                        
                        <div class="space-y-4">
                            <!-- Category Top Bar -->
                            <div class="flex items-center justify-between">
                                <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-100 dark:border-emerald-900/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
                                    @if(str_contains($category->slug, 'quran'))
                                        📖
                                    @elseif(str_contains($category->slug, 'prophet'))
                                        🕋
                                    @elseif(str_contains($category->slug, 'ibadah') || str_contains($category->slug, 'fiqh'))
                                        🤲
                                    @elseif(str_contains($category->slug, 'hadith'))
                                        📜
                                    @else
                                        ✨
                                    @endif
                                </div>

                                <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-bold text-xs">
                                    📝 {{ $category->questions_count }}টি প্রশ্ন
                                </span>
                            </div>

                            <!-- Title & Description -->
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                    {{ $category->name }}
                                </h3>
                                <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-2 leading-relaxed line-clamp-3">
                                    {{ $category->description ?? 'এই বিষয়ের ওপর আকর্ষণীয় ইসলামিক প্রশ্নাবলীতে অংশগ্রহণ করে নিজের দ্বীনি ইলম বৃদ্ধি করুন।' }}
                                </p>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <div class="pt-6 mt-6 border-t border-gray-100 dark:border-gray-800">
                            @if($category->questions_count > 0)
                                <a href="{{ route('quiz.start', $category) }}" 
                                   class="w-full py-3 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-sm hover:shadow-md transition flex items-center justify-center gap-2 group-hover:translate-x-0.5">
                                    <span>কুইজ শুরু করুন</span>
                                    <span>&rarr;</span>
                                </a>
                            @else
                                <button disabled class="w-full py-3 px-4 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-400 text-xs font-semibold cursor-not-allowed">
                                    শীঘ্রই আসছে...
                                </button>
                            @endif
                        </div>

                    </div>
                @empty
                    <div class="col-span-full p-16 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-center shadow-sm">
                        <div class="text-5xl mb-3">🧠</div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white">বর্তমানে কোনো কুইজ পাওয়া যায়নি।</h4>
                        <p class="text-xs text-gray-500 mt-1">শীঘ্রই নতুন কুইজ ক্যাটাগরি ও প্রশ্নাবলী যুক্ত করা হবে ইনশাআল্লাহ।</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
