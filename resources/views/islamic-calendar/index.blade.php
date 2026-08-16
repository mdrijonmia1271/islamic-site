<x-app-layout>
    <!-- Calendar Hero Header -->
    <section class="relative overflow-hidden bg-gradient-to-b from-emerald-950 via-teal-950 to-slate-950 text-white py-14 sm:py-20 border-b border-emerald-900/40">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
            <span class="text-3xl sm:text-4xl text-amber-300 font-serif block" style="font-family: 'Amiri', serif;">
                التَّقْوِيمُ الْهِجْرِيُّ
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
                📅 Islamic <span class="bg-gradient-to-r from-emerald-400 to-amber-300 bg-clip-text text-transparent">Calendar</span>
            </h1>
            <p class="max-w-xl mx-auto text-xs sm:text-sm text-emerald-200/90 leading-relaxed">
                হিজরি ও গ্রেগরিয়ান ক্যালেন্ডার, গুরুত্বপূর্ণ ইসলামিক দিন ও বাৎসরিক বিশেষ দিবসসমূহ।
            </p>

            <!-- Step 14: Date Picker Form -->
            <div class="pt-2 max-w-md mx-auto">
                <form method="GET" action="{{ route('islamic-calendar.index') }}" class="flex flex-col sm:flex-row items-center gap-2 bg-white/10 backdrop-blur-md p-2 rounded-2xl border border-emerald-700/50 shadow-lg">
                    <div class="flex items-center gap-2 flex-1 w-full px-2">
                        <span class="text-amber-300">📅</span>
                        <input type="date" name="date" value="{{ $date->format('Y-m-d') }}" 
                               class="flex-1 bg-transparent text-white text-sm font-semibold border-none focus:ring-0 focus:outline-none cursor-pointer">
                    </div>
                    <button type="submit" class="w-full sm:w-auto px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-md transition">
                        View Date
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

        <!-- Step 13: Previous / Today / Next Day Navigation Bar -->
        <div class="flex flex-wrap items-center justify-between gap-3 p-3 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm">
            <a href="{{ route('islamic-calendar.index', ['date' => $date->copy()->subDay()->format('Y-m-d')]) }}" 
               class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 hover:bg-emerald-100 transition flex items-center gap-1">
                &larr; Previous Day
            </a>

            <a href="{{ route('islamic-calendar.index') }}" 
               class="px-5 py-2 rounded-xl text-xs sm:text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-500 shadow-md shadow-emerald-900/30 transition">
                Today
            </a>

            <a href="{{ route('islamic-calendar.index', ['date' => $date->copy()->addDay()->format('Y-m-d')]) }}" 
               class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 hover:bg-emerald-100 transition flex items-center gap-1">
                Next Day &rarr;
            </a>
        </div>
        
        <!-- Step 8: Date Dual Cards (Gregorian & Dynamic Hijri) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Gregorian Date Card -->
            <div class="p-8 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm text-center space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-2xl mx-auto border border-emerald-200/50 dark:border-emerald-800/40">
                    🗓️
                </div>
                <h4 class="text-xs uppercase font-bold tracking-wider text-gray-500 dark:text-gray-400">
                    Gregorian Date (ইংরেজি তারিখ)
                </h4>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">
                    {{ $date->format('d F Y') }}
                </h2>
                <p class="text-xs text-gray-400 font-medium">
                    {{ $date->format('l') }}
                </p>
            </div>

            <!-- Hijri Date Card (Step 8 Dynamic Conversion) -->
            <div class="p-8 rounded-3xl bg-gradient-to-br from-emerald-900 via-teal-900 to-slate-950 text-white shadow-xl border border-emerald-800/40 text-center space-y-3 relative overflow-hidden">
                <div class="w-12 h-12 rounded-2xl bg-amber-400/20 text-amber-300 flex items-center justify-center text-2xl mx-auto border border-amber-400/30">
                    🌙
                </div>
                <h4 class="text-xs uppercase font-bold tracking-wider text-emerald-200">
                    Hijri Date (হিজরি তারিখ)
                </h4>
                
                @if (isset($hijri['day']) && $hijri['day'])
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-amber-300">
                        {{ $hijri['day'] }} {{ $hijri['month_name_bn'] ?? $hijri['month_name'] }} {{ $hijri['year'] }} হিজরি
                    </h2>
                    <p class="text-xs text-emerald-300/80">
                        {{ $hijri['day'] }} {{ $hijri['month_name'] }} {{ $hijri['year'] }} AH &bull; চাঁদ দেখার ওপর নির্ভরশীল
                    </p>
                @else
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-400">
                        --
                    </h2>
                @endif
            </div>

        </div>

        <!-- Selected Date's Islamic Events Section -->
        <div class="space-y-4">
            <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 pb-3">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <span>📅</span>
                    <span>এই তারিখের ইসলামিক দিবস (Events on this date)</span>
                </h3>
                <span class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold bg-emerald-50 dark:bg-emerald-950/60 px-3 py-1 rounded-full border border-emerald-200 dark:border-emerald-800">
                    {{ $events->count() }} টি দিবস
                </span>
            </div>

            @forelse ($events as $event)
                <div class="p-6 rounded-3xl bg-white dark:bg-gray-900 border border-emerald-200 dark:border-gray-800 shadow-md space-y-2">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white">
                            {{ $event->title }}
                        </h4>
                        <span class="text-xs px-2.5 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 font-semibold">
                            হিজরি: {{ $event->hijri_day }} {{ config("hijri.months.{$event->hijri_month}", '') }}
                        </span>
                    </div>

                    @if ($event->title_bangla)
                        <h5 class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                            {{ $event->title_bangla }}
                        </h5>
                    @endif

                    @if ($event->description)
                        <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed pt-1">
                            {{ $event->description }}
                        </p>
                    @endif
                </div>
            @empty
                <div class="p-8 rounded-3xl bg-slate-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-center text-gray-500">
                    <span class="text-3xl block mb-2">ℹ️</span>
                    <p class="text-sm font-medium">No Islamic event recorded for this specific date.</p>
                    <p class="text-xs text-gray-400 mt-0.5">নিচের বাৎসরিক প্রধান প্রধান ইসলামিক দিবস তালিকা দেখুন।</p>
                </div>
            @endforelse
        </div>

        <!-- Annual Major Islamic Events Table / Feed -->
        @if (isset($allEvents) && $allEvents->count() > 0)
            <div class="space-y-4 pt-6">
                <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 pb-3">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <span>⭐</span>
                        <span>বাৎসরিক প্রধান প্রধান ইসলামিক দিবসসমূহ (Major Islamic Events)</span>
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($allEvents as $aEvent)
                        <div class="p-5 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md hover:border-emerald-500/40 transition space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 px-2.5 py-1 rounded-full border border-emerald-200 dark:border-emerald-800">
                                    {{ $aEvent->hijri_day }} {{ config("hijri.months.{$aEvent->hijri_month}") }} ({{ config("hijri.months_bn.{$aEvent->hijri_month}") }})
                                </span>
                                @if ($aEvent->gregorian_date)
                                    <span class="text-xs text-gray-400 font-medium">
                                        {{ $aEvent->gregorian_date->format('d M Y') }}
                                    </span>
                                @endif
                            </div>

                            <h4 class="text-base font-bold text-gray-900 dark:text-white">
                                {{ $aEvent->title }}
                            </h4>
                            @if ($aEvent->title_bangla)
                                <h5 class="text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                                    {{ $aEvent->title_bangla }}
                                </h5>
                            @endif

                            @if ($aEvent->description)
                                <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                                    {{ $aEvent->description }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</x-app-layout>
