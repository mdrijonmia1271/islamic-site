@extends('layouts.app')

@section('title', 'ডিজিটাল তাসবীহ (Digital Tasbih Counter) — Islamic Site')
@section('meta_description', 'অনলাইন ডিজিটাল তাসবীহ কাউন্টার। জিকির ও ইস্তিগফারের হিসাব রাখুন সহজে ও নিরাপদে।')

@section('content')
<div class="bg-gray-50 dark:bg-gray-950 min-h-screen pb-20">

    <!-- Clean Hero Header -->
    <section class="bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950 text-white py-12 sm:py-16 border-b border-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center space-y-3">
            <span class="text-xl sm:text-2xl font-serif text-amber-300 block" style="font-family: 'Amiri', serif;">
                المِسْبَحَةُ الإِلِكْترُونِيَّةُ
            </span>

            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight flex items-center justify-center gap-3">
                <span>📿</span> <span>ডিজিটাল <span class="text-emerald-400">তাসবীহ</span></span>
            </h1>

            <p class="text-sm sm:text-base text-gray-300 max-w-xl mx-auto leading-relaxed">
                প্রতিদিনের জিকির, তাসবীহ ও ইস্তিগফারের হিসাব রাখুন সহজ ও আধুনিক ডিজিটাল কাউন্টারে।
            </p>
        </div>
    </section>

    <!-- Main Tasbih Application Card -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 p-6 sm:p-10 shadow-lg space-y-8">
            
            <!-- Top Controls: Dhikr Selection & Audio/Vibration Toggles -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 pb-6 border-b border-gray-100 dark:border-gray-800">
                
                <!-- Dhikr Selector -->
                <div class="flex-grow max-w-md">
                    <label for="dhikr" class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">
                        জিকির নির্বাচন করুন
                    </label>
                    <select id="dhikr" class="w-full text-sm font-semibold rounded-xl border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white py-3 px-4 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition shadow-sm cursor-pointer">
                        <option value="SubhanAllah" selected>سُبْحَانَ اللَّهِ (সুবহানাল্লাহ)</option>
                        <option value="Alhamdulillah">الْحَمْدُ لِلَّهِ (আলহামদুলিল্লাহ)</option>
                        <option value="AllahuAkbar">اللَّهُ أَكْبَرُ (আল্লাহু আকবার)</option>
                        <option value="LaIlahaIllallah">لَا إِلٰهَ إِلَّا اللَّهُ (লা ইলাহা ইল্লাল্লাহ)</option>
                        <option value="Astaghfirullah">أَسْتَغْفِرُ اللَّهَ (আস্তাগফিরুল্লাহ)</option>
                        <option value="SubhanAllahiWaBihamdihi">سُبْحَانَ اللَّهِ وَبِحَمْدِهِ سُبْحَانَ اللَّهِ الْعَظِيمِ (সুবহানাল্লাহি ওয়া বিহামদিহি)</option>
                        <option value="LaHawlaWaLaQuwwata">لَا حَوْلَ وَلَا قُوَّةَ إِلَّا بِاللَّهِ (লা হাওলা ওয়ালা কুওয়াতা)</option>
                        <option value="Salawat">اللَّهُمَّ صَلِّ عَلَىٰ مُحَمَّدٍ (দরূদ শরীফ)</option>
                        <option value="HasbunAllah">حَسْبُنَا اللَّهُ وَنِعْمَ الْوَكِيلُ (হাসবুনাল্লাহু ওয়া নিমাল ওয়াকিল)</option>
                        <option value="Custom">✨ কাস্টম জিকির (Custom Dhikr)</option>
                    </select>
                </div>

                <!-- Sound & Vibration Toggles -->
                <div class="flex items-center justify-end gap-2 pt-2 sm:pt-6">
                    <button id="soundToggle" type="button" class="px-4 py-2.5 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700 hover:border-emerald-500 hover:bg-emerald-50 text-xs font-bold transition flex items-center gap-1.5 shadow-sm cursor-pointer" title="শব্দ চালু/বন্ধ">
                        <span id="soundIcon">🔊</span>
                        <span class="hidden sm:inline">শব্দ</span>
                    </button>
                    <button id="vibrateToggle" type="button" class="px-4 py-2.5 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700 hover:border-emerald-500 hover:bg-emerald-50 text-xs font-bold transition flex items-center gap-1.5 shadow-sm cursor-pointer" title="ভাইব্রেশন চালু/বন্ধ">
                        <span id="vibrateIcon">📳</span>
                        <span class="hidden sm:inline">ভাইব্রেশন</span>
                    </button>
                </div>
            </div>

            <!-- Selected Dhikr Arabic Banner -->
            <div class="text-center space-y-2 py-4 px-6 rounded-2xl bg-emerald-50/60 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/60">
                <div id="dhikrArabic" dir="rtl" class="text-2xl sm:text-3xl font-serif text-emerald-900 dark:text-emerald-300 leading-relaxed font-bold" style="font-family: 'Amiri', serif;">
                    سُبْحَانَ اللَّهِ
                </div>
                <div id="dhikrMeaning" class="text-xs sm:text-sm text-emerald-800 dark:text-emerald-400 font-medium">
                    আল্লাহ মহাপবিত্র ও সমস্ত ত্রুটি থেকে মুক্ত
                </div>
            </div>

            <!-- Circular Progress & Counter Display -->
            <div class="flex flex-col items-center justify-center relative py-4">
                <!-- SVG Circular Ring -->
                <div class="relative w-64 h-64 sm:w-72 sm:h-72 flex items-center justify-center">
                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 240 240">
                        <circle cx="120" cy="120" r="100" class="text-gray-100 dark:text-gray-800 stroke-current" stroke-width="10" fill="transparent"></circle>
                        <circle id="progressRing" cx="120" cy="120" r="100" class="text-emerald-500 stroke-current transition-all duration-300 ease-out" stroke-width="10" stroke-linecap="round" fill="transparent" stroke-dasharray="628.3" stroke-dashoffset="628.3"></circle>
                    </svg>

                    <!-- Center Count Display -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center space-y-1">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">বর্তমান গণনা</span>
                        <div id="counter" class="text-6xl sm:text-7xl font-black text-gray-900 dark:text-white font-mono tracking-tight transform transition-transform duration-100">
                            0
                        </div>
                        <div class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950 text-xs font-bold text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                            <span>টার্গেট:</span>
                            <span id="target" class="font-mono">100</span>
                        </div>
                    </div>
                </div>

                <!-- Progress Info -->
                <div class="mt-4 flex items-center gap-2 text-xs font-bold text-gray-500 dark:text-gray-400">
                    <span id="progressText">0% সম্পন্ন</span>
                    <span class="text-gray-300 dark:text-gray-700">•</span>
                    <span id="cycleCount" class="text-emerald-600 dark:text-emerald-400">রাউন্ড: ০</span>
                </div>
            </div>

            <!-- Big Tactile Ergonomic TAP Button -->
            <div class="flex justify-center py-2">
                <button id="countButton" type="button" 
                        class="w-44 h-44 sm:w-52 sm:h-52 rounded-full bg-gradient-to-b from-emerald-500 to-teal-700 hover:from-emerald-400 hover:to-teal-600 active:scale-95 text-white font-black text-3xl sm:text-4xl shadow-xl shadow-emerald-600/30 border-4 border-emerald-300/40 flex flex-col items-center justify-center gap-1 transition-all duration-100 select-none group cursor-pointer focus:outline-none focus:ring-4 focus:ring-emerald-400/50">
                    <span class="tracking-widest drop-shadow-md">TAP</span>
                    <span class="text-xs font-normal text-emerald-100 tracking-normal opacity-85 group-hover:opacity-100">স্পর্শ করুন / Space</span>
                </button>
            </div>

            <!-- Target Presets & Quick Action Controls -->
            <div class="space-y-5 pt-6 border-t border-gray-100 dark:border-gray-800">
                
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <!-- Presets -->
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold text-gray-500 dark:text-gray-400">টার্গেট:</span>
                        <button type="button" onclick="setTargetPreset(33)" class="preset-btn px-3.5 py-2 rounded-xl text-xs font-bold bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-emerald-600 hover:text-white transition cursor-pointer">33</button>
                        <button type="button" onclick="setTargetPreset(100)" class="preset-btn px-3.5 py-2 rounded-xl text-xs font-bold bg-emerald-600 text-white shadow-sm transition cursor-pointer">100</button>
                        <button type="button" onclick="setTargetPreset(500)" class="preset-btn px-3.5 py-2 rounded-xl text-xs font-bold bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-emerald-600 hover:text-white transition cursor-pointer">500</button>
                        <button type="button" onclick="setTargetPreset(1000)" class="preset-btn px-3.5 py-2 rounded-xl text-xs font-bold bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-emerald-600 hover:text-white transition cursor-pointer">1000</button>
                    </div>

                    <!-- Target +100 and Reset Buttons -->
                    <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                        <button id="targetButton" type="button" class="px-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-emerald-50 hover:text-emerald-700 text-gray-700 dark:text-gray-300 text-xs font-bold transition border border-gray-200 dark:border-gray-700 shadow-sm flex items-center gap-1.5 cursor-pointer">
                            <span>🎯</span> <span>Target +100</span>
                        </button>
                        <button id="resetButton" type="button" class="px-4 py-2 rounded-xl bg-red-50 dark:bg-red-950/40 hover:bg-red-100 dark:hover:bg-red-900/60 text-red-600 dark:text-red-400 text-xs font-bold transition border border-red-200 dark:border-red-800/80 shadow-sm flex items-center gap-1.5 cursor-pointer">
                            <span>🔄</span> <span>Reset</span>
                        </button>
                    </div>
                </div>

                <!-- Stats Summary -->
                <div class="grid grid-cols-3 gap-3 pt-2 text-center text-xs">
                    <div class="p-3.5 rounded-2xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-800">
                        <span class="text-gray-400 block text-[11px] mb-0.5">আজকের মোট জিকির</span>
                        <strong id="todayTotal" class="text-lg font-bold text-emerald-600 dark:text-emerald-400 font-mono">0</strong>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-800">
                        <span class="text-gray-400 block text-[11px] mb-0.5">সর্বমোট জিকির সংখ্যা</span>
                        <strong id="lifetimeTotal" class="text-lg font-bold text-gray-800 dark:text-gray-200 font-mono">0</strong>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-800">
                        <span class="text-gray-400 block text-[11px] mb-0.5">টার্গেট পূরণ</span>
                        <strong id="completedRounds" class="text-lg font-bold text-amber-500 font-mono">0 বার</strong>
                    </div>
                </div>

                <!-- Today's Dhikr Breakdown List -->
                <div class="pt-4 border-t border-gray-100 dark:border-gray-800">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300 flex items-center gap-1.5">
                            <span>📊</span> <span>আজকের জিকির বিবরণী (Today's Breakdown)</span>
                        </span>
                        <span class="text-xs font-semibold text-emerald-600 dark:text-emerald-400" id="todayBreakdownTotal">মোট: 0</span>
                    </div>

                    <div id="dhikrBreakdownContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2.5">
                        <!-- Dynamically populated from JS -->
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Target Celebration Modal -->
    <div id="celebrationModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div class="bg-white dark:bg-gray-900 border border-emerald-500/40 rounded-3xl p-8 max-w-sm w-full text-center space-y-5 shadow-2xl transform scale-90 transition-transform duration-300" id="celebrationCard">
            <div class="w-20 h-20 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 mx-auto flex items-center justify-center text-4xl shadow-inner animate-bounce">
                🎉
            </div>
            <div class="space-y-1">
                <span class="text-xl font-serif text-amber-500 block font-bold" style="font-family: 'Amiri', serif;">
                    مَا شَاءَ اللَّهُ
                </span>
                <h3 class="text-2xl font-black text-gray-900 dark:text-white">টার্গেট সম্পন্ন হয়েছে!</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                    আলহামদুলিল্লাহ! আপনার আজকের জিকিরের লক্ষ্যমাত্রা সফলভাবে পূরণ হয়েছে।
                </p>
            </div>
            <div class="pt-2 flex items-center justify-center gap-3">
                <button type="button" onclick="closeCelebration(true)" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition shadow-md flex items-center gap-1 cursor-pointer">
                    <span>🔁</span> <span>নতুন রাউন্ড শুরু করুন</span>
                </button>
                <button type="button" onclick="closeCelebration(false)" class="px-4 py-2.5 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 text-gray-700 dark:text-gray-300 text-xs font-bold transition cursor-pointer">
                    চালিয়ে যান
                </button>
            </div>
        </div>
    </div>

</div>

<!-- Tasbih Client-Side State Engine -->
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Dhikr Dictionary
    const dhikrData = {
        'SubhanAllah': {
            arabic: 'سُبْحَانَ اللَّهِ',
            meaning: 'আল্লাহ মহাপবিত্র ও সমস্ত ত্রুটি থেকে মুক্ত'
        },
        'Alhamdulillah': {
            arabic: 'الْحَمْدُ لِلَّهِ',
            meaning: 'সমস্ত প্রশংসা ও কৃতজ্ঞতা মহান আল্লাহর জন্য'
        },
        'AllahuAkbar': {
            arabic: 'اللَّهُ أَكْبَرُ',
            meaning: 'আল্লাহ সর্বশ্রেষ্ঠ ও সবচেয়ে মহান'
        },
        'LaIlahaIllallah': {
            arabic: 'لَا إِلٰهَ إِلَّا اللَّهُ',
            meaning: 'আল্লাহ ব্যতীত সত্য কোনো উপাস্য নেই'
        },
        'Astaghfirullah': {
            arabic: 'أَسْتَغْفِرُ اللَّهَ',
            meaning: 'আমি মহান আল্লাহর নিকট ক্ষমা প্রার্থনা করছি'
        },
        'SubhanAllahiWaBihamdihi': {
            arabic: 'سُبْحَانَ اللَّهِ وَبِحَمْدِهِ سُبْحَانَ اللَّهِ الْعَظِيمِ',
            meaning: 'আল্লাহর প্রশংসাসহ পবিত্রতা ঘোষণা করছি, মহান আল্লাহ অতীব পবিত্র'
        },
        'LaHawlaWaLaQuwwata': {
            arabic: 'لَا حَوْلَ وَلَا قُوَّةَ إِلَّا بِاللَّهِ',
            meaning: 'আল্লাহর সাহায্য ছাড়া পাপ থেকে বাঁচার বা পুণ্য করার কোনো শক্তি নেই'
        },
        'Salawat': {
            arabic: 'اللَّهُمَّ صَلِّ عَلَىٰ مُحَمَّدٍ وَعَلَىٰ آلِ مُحَمَّدٍ',
            meaning: 'হে আল্লাহ! মুহাম্মদ (সাঃ) ও তাঁর পরিবারের উপর রহমত বর্ষণ করুন'
        },
        'HasbunAllah': {
            arabic: 'حَسْبُنَا اللَّهُ وَنِعْمَ الْوَكِيلُ',
            meaning: 'আল্লাহই আমাদের জন্য যথেষ্ট এবং তিনিই উত্তম কর্মবিধায়ক'
        },
        'Custom': {
            arabic: 'ذِكْرُ اللَّهِ',
            meaning: 'আপনার নিজস্ব জিকির ও তাসবীহ'
        }
    };

    // State Variables
    let count = parseInt(localStorage.getItem('tasbih_count')) || 0;
    let target = parseInt(localStorage.getItem('tasbih_target')) || 100;
    let todayTotal = parseInt(localStorage.getItem('tasbih_today_total')) || 0;
    let lifetimeTotal = parseInt(localStorage.getItem('tasbih_lifetime_total')) || 0;
    let completedRounds = parseInt(localStorage.getItem('tasbih_completed_rounds')) || 0;
    let soundEnabled = localStorage.getItem('tasbih_sound') !== 'false';
    let vibrateEnabled = localStorage.getItem('tasbih_vibrate') !== 'false';
    let currentDhikr = localStorage.getItem('tasbih_dhikr') || 'SubhanAllah';
    let dhikrBreakdown = JSON.parse(localStorage.getItem('tasbih_dhikr_breakdown')) || {};

    // Check if new day for todayTotal reset
    const todayDate = new Date().toDateString();
    const lastSavedDate = localStorage.getItem('tasbih_last_date');
    if (lastSavedDate !== todayDate) {
        todayTotal = 0;
        dhikrBreakdown = {};
        localStorage.setItem('tasbih_today_total', todayTotal);
        localStorage.setItem('tasbih_dhikr_breakdown', JSON.stringify(dhikrBreakdown));
        localStorage.setItem('tasbih_last_date', todayDate);
    }

    // DOM Elements
    const counterElement = document.getElementById('counter');
    const targetElement = document.getElementById('target');
    const countButton = document.getElementById('countButton');
    const resetButton = document.getElementById('resetButton');
    const targetButton = document.getElementById('targetButton');
    const dhikr = document.getElementById('dhikr');
    const dhikrArabic = document.getElementById('dhikrArabic');
    const dhikrMeaning = document.getElementById('dhikrMeaning');
    const progressRing = document.getElementById('progressRing');
    const progressText = document.getElementById('progressText');
    const cycleCount = document.getElementById('cycleCount');
    const soundToggle = document.getElementById('soundToggle');
    const soundIcon = document.getElementById('soundIcon');
    const vibrateToggle = document.getElementById('vibrateToggle');
    const vibrateIcon = document.getElementById('vibrateIcon');
    const todayTotalElem = document.getElementById('todayTotal');
    const lifetimeTotalElem = document.getElementById('lifetimeTotal');
    const completedRoundsElem = document.getElementById('completedRounds');
    const dhikrBreakdownContainer = document.getElementById('dhikrBreakdownContainer');
    const todayBreakdownTotal = document.getElementById('todayBreakdownTotal');

    // Ring circumference (2 * pi * 100 = ~628.318)
    const circumference = 2 * Math.PI * 100;

    // Web Audio Synthesized Click Sound
    const AudioContext = window.AudioContext || window.webkitAudioContext;
    let audioCtx = null;

    function playClickSound() {
        if (!soundEnabled) return;
        try {
            if (!audioCtx) audioCtx = new AudioContext();
            if (audioCtx.state === 'suspended') audioCtx.resume();

            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();

            osc.type = 'sine';
            osc.frequency.setValueAtTime(800, audioCtx.currentTime);
            osc.frequency.exponentialRampToValueAtTime(300, audioCtx.currentTime + 0.04);

            gain.gain.setValueAtTime(0.3, audioCtx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.04);

            osc.connect(gain);
            gain.connect(audioCtx.destination);

            osc.start();
            osc.stop(audioCtx.currentTime + 0.05);
        } catch (e) {
            console.error(e);
        }
    }

    function triggerHaptic() {
        if (vibrateEnabled && 'vibrate' in navigator) {
            navigator.vibrate(35);
        }
    }

    // Render Today's Dhikr Breakdown
    function renderBreakdown() {
        if (!dhikrBreakdownContainer) return;
        dhikrBreakdownContainer.innerHTML = '';
        const keys = Object.keys(dhikrBreakdown);

        if (keys.length === 0) {
            dhikrBreakdownContainer.innerHTML = '<div class="text-gray-400 text-xs py-3 col-span-full text-center">আজকের কোনো জিকির এখনো রেকর্ড হয়নি।</div>';
            if (todayBreakdownTotal) todayBreakdownTotal.innerText = 'মোট: ০';
            return;
        }

        let total = 0;
        keys.forEach(key => {
            const countVal = dhikrBreakdown[key] || 0;
            total += countVal;
            const meta = dhikrData[key] || { arabic: key, meaning: '' };

            const card = document.createElement('div');
            card.className = 'p-3 rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-between text-xs';
            card.innerHTML = `
                <div class="overflow-hidden pr-2">
                    <span class="font-bold text-gray-900 dark:text-gray-100 block truncate">${meta.arabic}</span>
                    <span class="text-[11px] text-gray-500 dark:text-gray-400 block truncate">${key}</span>
                </div>
                <span class="px-2.5 py-1 rounded-lg bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 font-mono font-bold text-xs flex-shrink-0">${countVal}</span>
            `;
            dhikrBreakdownContainer.appendChild(card);
        });

        if (todayBreakdownTotal) {
            todayBreakdownTotal.innerText = `মোট: ${total}`;
        }
    }

    // Update Display & UI
    function updateDisplay() {
        counterElement.innerText = count;
        targetElement.innerText = target;

        // Progress Calculation
        const percentage = target > 0 ? Math.min(100, Math.round((count / target) * 100)) : 0;
        progressText.innerText = `${percentage}% সম্পন্ন`;

        const offset = circumference - (percentage / 100) * circumference;
        progressRing.style.strokeDashoffset = offset;

        // Progress color shift
        if (percentage >= 100) {
            progressRing.classList.remove('text-emerald-500');
            progressRing.classList.add('text-amber-400');
        } else {
            progressRing.classList.remove('text-amber-400');
            progressRing.classList.add('text-emerald-500');
        }

        // Stats Display
        todayTotalElem.innerText = todayTotal;
        lifetimeTotalElem.innerText = lifetimeTotal;
        completedRoundsElem.innerText = `${completedRounds} বার`;
        cycleCount.innerText = `রাউন্ড: ${completedRounds}`;

        // Dhikr Texts
        const activeData = dhikrData[currentDhikr] || dhikrData['SubhanAllah'];
        dhikrArabic.innerText = activeData.arabic;
        dhikrMeaning.innerText = activeData.meaning;
        dhikr.value = currentDhikr;

        // Sound & Vibration Icons
        soundIcon.innerText = soundEnabled ? '🔊' : '🔇';
        vibrateIcon.innerText = vibrateEnabled ? '📳' : '📴';

        // Render Breakdown
        renderBreakdown();

        // Save State to LocalStorage
        localStorage.setItem('tasbih_count', count);
        localStorage.setItem('tasbih_target', target);
        localStorage.setItem('tasbih_today_total', todayTotal);
        localStorage.setItem('tasbih_lifetime_total', lifetimeTotal);
        localStorage.setItem('tasbih_completed_rounds', completedRounds);
        localStorage.setItem('tasbih_dhikr', currentDhikr);
        localStorage.setItem('tasbih_sound', soundEnabled);
        localStorage.setItem('tasbih_vibrate', vibrateEnabled);
        localStorage.setItem('tasbih_dhikr_breakdown', JSON.stringify(dhikrBreakdown));
    }

    // Tap Action
    function tapCounter() {
        count++;
        todayTotal++;
        lifetimeTotal++;

        // Track per-Dhikr count
        dhikrBreakdown[currentDhikr] = (dhikrBreakdown[currentDhikr] || 0) + 1;

        playClickSound();
        triggerHaptic();

        // Bounce Animation
        counterElement.style.transform = 'scale(1.15)';
        setTimeout(() => {
            counterElement.style.transform = 'scale(1)';
        }, 100);

        // Check if Target is hit exactly
        if (count === target) {
            completedRounds++;
            showCelebration();
        }

        updateDisplay();
    }

    // Event Listeners
    countButton.addEventListener('click', tapCounter);

    // Keyboard spacebar / Enter tap support
    window.addEventListener('keydown', function (e) {
        if (e.code === 'Space' && e.target === document.body) {
            e.preventDefault();
            tapCounter();
        }
    });

    // Reset Counter
    resetButton.addEventListener('click', function () {
        if (count > 0 && confirm('আপনি কি বর্তমান গণনা ০ করতে চান?')) {
            count = 0;
            updateDisplay();
        }
    });

    // Target +100
    targetButton.addEventListener('click', function () {
        target += 100;
        updateDisplay();
    });

    // Dhikr Select Change
    dhikr.addEventListener('change', function () {
        currentDhikr = this.value;
        count = 0;
        updateDisplay();
    });

    // Sound Toggle
    soundToggle.addEventListener('click', function () {
        soundEnabled = !soundEnabled;
        updateDisplay();
    });

    // Vibration Toggle
    vibrateToggle.addEventListener('click', function () {
        vibrateEnabled = !vibrateEnabled;
        updateDisplay();
    });

    // Target Preset Helper (Window scope)
    window.setTargetPreset = function (val) {
        target = val;
        document.querySelectorAll('.preset-btn').forEach(btn => {
            if (parseInt(btn.innerText) === val) {
                btn.className = 'preset-btn px-3.5 py-2 rounded-xl text-xs font-bold bg-emerald-600 text-white shadow-sm transition cursor-pointer';
            } else {
                btn.className = 'preset-btn px-3.5 py-2 rounded-xl text-xs font-bold bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-emerald-600 hover:text-white transition cursor-pointer';
            }
        });
        updateDisplay();
    };

    // Celebration Modal Trigger
    function showCelebration() {
        const modal = document.getElementById('celebrationModal');
        const card = document.getElementById('celebrationCard');
        if (!modal || !card) return;

        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');
        card.classList.remove('scale-90');
        card.classList.add('scale-100');

        if ('vibrate' in navigator && vibrateEnabled) {
            navigator.vibrate([100, 50, 100, 50, 200]);
        }
    }

    window.closeCelebration = function (resetCount) {
        const modal = document.getElementById('celebrationModal');
        const card = document.getElementById('celebrationCard');
        if (!modal || !card) return;

        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100');
        card.classList.add('scale-90');
        card.classList.remove('scale-100');

        if (resetCount) {
            count = 0;
            updateDisplay();
        }
    };

    // Initial Load
    updateDisplay();
});
</script>
@endpush
@endsection
