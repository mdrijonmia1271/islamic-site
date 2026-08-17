<x-app-layout>
    <div x-data="prayerCountdown({
            fajr: '{{ is_object($prayerTime) ? (is_string($prayerTime->fajr) ? substr($prayerTime->fajr, 0, 5) : $prayerTime->fajr?->format('H:i')) : '04:12' }}',
            sunrise: '{{ is_object($prayerTime) ? (is_string($prayerTime->sunrise) ? substr($prayerTime->sunrise, 0, 5) : $prayerTime->sunrise?->format('H:i')) : '05:30' }}',
            dhuhr: '{{ is_object($prayerTime) ? (is_string($prayerTime->dhuhr) ? substr($prayerTime->dhuhr, 0, 5) : $prayerTime->dhuhr?->format('H:i')) : '12:05' }}',
            asr: '{{ is_object($prayerTime) ? (is_string($prayerTime->asr) ? substr($prayerTime->asr, 0, 5) : $prayerTime->asr?->format('H:i')) : '16:35' }}',
            maghrib: '{{ is_object($prayerTime) ? (is_string($prayerTime->maghrib) ? substr($prayerTime->maghrib, 0, 5) : $prayerTime->maghrib?->format('H:i')) : '18:32' }}',
            isha: '{{ is_object($prayerTime) ? (is_string($prayerTime->isha) ? substr($prayerTime->isha, 0, 5) : $prayerTime->isha?->format('H:i')) : '19:48' }}'
         })" class="bg-slate-50 dark:bg-gray-950 min-h-screen pb-20">

        <!-- Hero Header -->
        <section class="relative overflow-hidden bg-gradient-to-b from-emerald-950 via-teal-950 to-slate-950 text-white py-14 sm:py-20 border-b border-emerald-900/40">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-3">
                <span class="text-3xl sm:text-4xl text-amber-300 font-serif block" style="font-family: 'Amiri', serif;">
                    مَوَاقِيتُ الصَّلَاةِ
                </span>
                <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
                    🕌 Prayer Times
                </h1>
                <p class="text-lg font-semibold text-emerald-300">
                    {{ $city }}
                </p>
                <p class="text-xs sm:text-sm text-slate-300">
                    {{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}
                </p>

                <!-- Step 12: Location Select Form -->
                <div class="pt-3 max-w-md mx-auto">
                    <form action="{{ route('prayer-times.index') }}" method="GET" class="flex items-center gap-2 bg-white/10 backdrop-blur-md p-1.5 rounded-2xl border border-emerald-700/50 shadow-lg">
                        <span class="pl-3 text-amber-300">📍</span>
                        <select name="city" onchange="this.form.submit()" class="form-select flex-1 bg-transparent text-white text-sm font-semibold border-none focus:ring-0 focus:outline-none cursor-pointer">
                            <option value="Dhaka" class="bg-gray-900 text-white" {{ $city === 'Dhaka' ? 'selected' : '' }}>Dhaka (ঢাকা)</option>
                            <option value="Chittagong" class="bg-gray-900 text-white" {{ $city === 'Chittagong' ? 'selected' : '' }}>Chittagong (চট্টগ্রাম)</option>
                            <option value="Rajshahi" class="bg-gray-900 text-white" {{ $city === 'Rajshahi' ? 'selected' : '' }}>Rajshahi (রাজশাহী)</option>
                            <option value="Khulna" class="bg-gray-900 text-white" {{ $city === 'Khulna' ? 'selected' : '' }}>Khulna (খুলনা)</option>
                            <option value="Sylhet" class="bg-gray-900 text-white" {{ $city === 'Sylhet' ? 'selected' : '' }}>Sylhet (সিলেট)</option>
                            <option value="Barisal" class="bg-gray-900 text-white" {{ $city === 'Barisal' ? 'selected' : '' }}>Barisal (বরিশাল)</option>
                            <option value="Makkah" class="bg-gray-900 text-white" {{ $city === 'Makkah' ? 'selected' : '' }}>Makkah (মক্কা)</option>
                            <option value="Madinah" class="bg-gray-900 text-white" {{ $city === 'Madinah' ? 'selected' : '' }}>Madinah (মদিনা)</option>
                        </select>
                    </form>
                </div>
            </div>
        </section>

        <!-- Main Body Content -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20 space-y-8">
            
            <!-- Step 10 & Step 11: Next Prayer Banner & Live Countdown -->
            @if ($nextPrayer)
                <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-emerald-800 via-teal-800 to-slate-900 text-white shadow-2xl border border-emerald-700/60 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="space-y-1 text-center md:text-left">
                        <div class="flex items-center justify-center md:justify-start gap-2 text-xs font-semibold text-emerald-300">
                            <span>📍 {{ $city }}, {{ $prayerTime->country ?? 'Bangladesh' }}</span>
                            <span>&bull;</span>
                            <span>{{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}</span>
                        </div>
                        <h4 class="text-xs uppercase font-bold tracking-widest text-emerald-200">
                            Next Prayer
                        </h4>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-amber-300">
                            {{ $nextPrayer['name'] }}
                        </h2>
                        <p class="text-sm font-semibold text-white">
                            ওয়াক্ত শুরু: {{ $nextPrayer['time']->format('h:i A') }}
                        </p>
                    </div>

                    <!-- Step 11: Pure JS & Alpine Countdown Element -->
                    <div class="px-6 py-4 rounded-2xl bg-black/40 border border-emerald-500/40 text-center space-y-1">
                        <div id="prayer-countdown" 
                             data-time="{{ $nextPrayer['time']->toIso8601String() }}"
                             class="text-3xl sm:text-4xl font-mono font-bold tracking-wider text-amber-300"
                             x-text="countdownText">
                            Loading...
                        </div>
                        <span class="text-[10px] uppercase font-bold text-emerald-300 tracking-wider">ঘণ্টা : মিনিট : সেকেন্ড বাকি</span>
                    </div>
                </div>
            @endif

            <!-- Step 6: Prayer Cards Grid -->
            @if ($prayerTime && ($prayerTime->fajr || $prayerTime->dhuhr))
                @php
                    $prayers = [
                        'Fajr' => ['label' => 'ফজর', 'icon' => '🌌', 'time' => $prayerTime->fajr],
                        'Sunrise' => ['label' => 'সূর্যোদয়', 'icon' => '☀️', 'time' => $prayerTime->sunrise],
                        'Dhuhr' => ['label' => 'যোহর', 'icon' => '☀️', 'time' => $prayerTime->dhuhr],
                        'Asr' => ['label' => 'আসর', 'icon' => '⛅', 'time' => $prayerTime->asr],
                        'Maghrib' => ['label' => 'মাগরিব', 'icon' => '🌇', 'time' => $prayerTime->maghrib],
                        'Isha' => ['label' => 'ইশা', 'icon' => '🌙', 'time' => $prayerTime->isha],
                    ];
                @endphp

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach ($prayers as $name => $pData)
                        @php
                            $formattedTime = $pData['time']
                                ? (is_string($pData['time']) ? date('h:i A', strtotime($pData['time'])) : $pData['time']->format('h:i A'))
                                : '--:--';
                            $isNext = ($nextPrayer && $nextPrayer['name'] === $name);
                        @endphp
                        <div class="p-5 rounded-3xl bg-white dark:bg-gray-900 border {{ $isNext ? 'border-amber-400 ring-2 ring-amber-400/50 bg-emerald-50 dark:bg-emerald-950/60' : 'border-gray-100 dark:border-gray-800' }} shadow-sm text-center space-y-2 transition hover:shadow-md">
                            <span class="text-2xl block">{{ $pData['icon'] }}</span>
                            <div>
                                <h4 class="text-xs font-bold uppercase text-gray-500 dark:text-gray-400">{{ $name }}</h4>
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">{{ $pData['label'] }}</h3>
                            </div>
                            <div class="text-lg sm:text-xl font-extrabold {{ $name === 'Sunrise' ? 'text-amber-600 dark:text-amber-400' : 'text-emerald-600 dark:text-emerald-400' }}">
                                {{ $formattedTime }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-12 rounded-3xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-900/60 text-center text-amber-800 dark:text-amber-300">
                    <div class="text-4xl mb-3">⚠️</div>
                    <h3 class="text-lg font-bold">Prayer time is not available for {{ $city }} today.</h3>
                    <p class="text-xs text-amber-600 dark:text-amber-400 mt-1">অনুগ্রহ করে অন্য কোনো শহর নির্বাচন করুন।</p>
                </div>
            @endif

            <!-- Hadith on Prayer Card -->
            <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-gray-900 border border-emerald-100 dark:border-gray-800 shadow-sm space-y-3">
                <div class="flex items-center gap-2 text-emerald-600 dark:text-emerald-400 font-bold text-sm">
                    <span>📖</span>
                    <span>সালাত সম্পর্কিত হাদিস</span>
                </div>
                <div dir="rtl" class="text-right leading-loose text-xl text-gray-800 dark:text-emerald-200 font-normal" style="font-family: 'Amiri', serif;">
                    «إِنَّ الصَّلَاةَ كَانَتْ عَلَى الْمُؤْمِنِينَ كِتَابًا مَوْقُوتًا»
                </div>
                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed font-medium">
                    "নিশ্চয়ই নির্ধারিত সময়ে সালাত কায়েম করা মুমিনদের ওপর ফরজ করা হয়েছে।" <br>
                    <span class="text-xs text-gray-400 font-normal">— সূরা আন-নিসা, আয়াত ১০৩</span>
                </p>
            </div>

            <!-- Related Articles on Salah & Tahajjud (Internal Linking) -->
            <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-emerald-950/60 to-slate-900 border border-emerald-800/40 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="space-y-1 text-center md:text-left">
                    <span class="text-xs font-bold text-amber-400 uppercase tracking-wider">গবেষণাধর্মী ইসলামিক প্রবন্ধ</span>
                    <h3 class="text-base sm:text-lg font-bold text-white">তাহাজ্জুদ নামাজের নিয়ম, সময় ও রাকাত নির্দেশিকা</h3>
                    <p class="text-xs text-slate-300">রাতের শেষ তৃতীয়াংশে আল্লাহর সন্তুষ্টি লাভের সর্বোত্তম নফল সালাতের পূর্ণাঙ্গ নিয়মাবলী পড়ুন।</p>
                </div>
                <a href="{{ url('/articles/how-to-perform-tahajjud') }}" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold whitespace-nowrap shadow-md transition">
                    প্রবন্ধটি পড়ুন &rarr;
                </a>
            </div>

        </div>

    </div>

    <!-- Step 11: Countdown JavaScript Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countdownEl = document.getElementById('prayer-countdown');
            if (countdownEl && countdownEl.dataset.time) {
                const target = new Date(countdownEl.dataset.time).getTime();

                function updateCountdown() {
                    const now = new Date().getTime();
                    const difference = target - now;

                    if (difference <= 0) {
                        countdownEl.innerHTML = 'Prayer time has started';
                        return;
                    }

                    const hours = Math.floor(difference / (1000 * 60 * 60));
                    const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((difference % (1000 * 60)) / 1000);

                    const pad = (n) => String(n).padStart(2, '0');
                    countdownEl.innerHTML = `${pad(hours)}h ${pad(minutes)}m ${pad(seconds)}s`;
                }

                updateCountdown();
                setInterval(updateCountdown, 1000);
            }
        });

        function prayerCountdown(times) {
            return {
                times: times,
                nextPrayerName: '{{ $nextPrayer ? $nextPrayer['name'] : 'Fajr' }}',
                countdownText: '00h 00m 00s',
                init() {
                    this.updateCountdown();
                    setInterval(() => this.updateCountdown(), 1000);
                },
                updateCountdown() {
                    const now = new Date();
                    const prayerOrder = [
                        { name: 'Fajr', timeStr: this.times.fajr },
                        { name: 'Dhuhr', timeStr: this.times.dhuhr },
                        { name: 'Asr', timeStr: this.times.asr },
                        { name: 'Maghrib', timeStr: this.times.maghrib },
                        { name: 'Isha', timeStr: this.times.isha }
                    ];

                    let targetDate = null;
                    let targetName = 'Fajr';

                    for (let p of prayerOrder) {
                        const [hours, minutes] = p.timeStr.split(':').map(Number);
                        const pDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), hours, minutes, 0);
                        if (pDate > now) {
                            targetDate = pDate;
                            targetName = p.name;
                            break;
                        }
                    }

                    if (!targetDate) {
                        const [fHours, fMinutes] = this.times.fajr.split(':').map(Number);
                        targetDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() + 1, fHours, fMinutes, 0);
                        targetName = 'Fajr';
                    }

                    this.nextPrayerName = targetName;

                    const diffMs = targetDate - now;
                    const diffSec = Math.max(0, Math.floor(diffMs / 1000));
                    const hours = String(Math.floor(diffSec / 3600)).padStart(2, '0');
                    const minutes = String(Math.floor((diffSec % 3600) / 60)).padStart(2, '0');
                    const seconds = String(diffSec % 60).padStart(2, '0');

                    this.countdownText = `${hours}h ${minutes}m ${seconds}s`;
                }
            };
        }
    </script>
</x-app-layout>
