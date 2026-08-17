@extends('layouts.app')

@section('title', 'ক্বিবলা দিক নির্ণায়ক (Qibla Direction Finder) — Islamic Site')
@section('meta_description', 'অনলাইন ক্বিবলা কম্পাস ও দিক নির্ণায়ক। পবিত্র কাবার সঠিক দিক, ডিগ্রি এবং দূরত্ব বের করুন সহজে।')

@section('content')
<div class="bg-gray-50 dark:bg-gray-950 min-h-screen pb-24">

    <!-- Signature Hero Header -->
    <section class="relative overflow-hidden bg-gradient-to-b from-emerald-950 via-teal-950 to-slate-950 text-white py-12 sm:py-16 border-b border-emerald-900/40">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 text-center space-y-3">
            <span class="text-2xl sm:text-3xl font-serif text-amber-300 block" style="font-family: 'Amiri', serif;">
                اِتِّجَاهُ القِبْلَةِ الشَّرِيفَةِ
            </span>

            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight flex items-center justify-center gap-3">
                <span>🧭</span> <span>ক্বিবলা <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-amber-300 bg-clip-text text-transparent">দিক নির্ণায়ক</span></span>
            </h1>

            <p class="text-sm sm:text-base text-emerald-100/90 max-w-xl mx-auto leading-relaxed">
                পবিত্র কাবা শরীফের সঠিক দিক ও কৌণিক দূরত্ব (Qibla Bearing Degree) নির্ণয় করুন।
            </p>
        </div>
    </section>

    <!-- Main Qibla Application Container -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Side: Interactive Visual Compass (7 Cols) -->
            <div class="lg:col-span-7 bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 p-6 sm:p-10 shadow-lg flex flex-col items-center justify-center text-center space-y-6 relative overflow-hidden">
                
                <!-- Compass Calibration Info -->
                <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-xs font-bold text-emerald-700 dark:text-emerald-300">
                    <span id="compassStatusDot" class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span id="compassStatusText">কম্পাস সক্রিয়</span>
                </div>

                <!-- Circular Interactive Compass Container -->
                <div class="relative w-64 h-64 sm:w-72 sm:h-72 flex items-center justify-center my-2">
                    
                    <!-- Outer Degree Dial & Compass Rose -->
                    <div id="compassDial" class="absolute inset-0 rounded-full border-4 border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 shadow-inner flex items-center justify-center transition-transform duration-300 ease-out">
                        
                        <!-- Cardinal Directions -->
                        <span class="absolute top-2 text-xs font-black text-rose-500 font-mono tracking-widest">N (উ)</span>
                        <span class="absolute bottom-2 text-xs font-black text-gray-400 font-mono tracking-widest">S (দ)</span>
                        <span class="absolute right-3 text-xs font-black text-gray-400 font-mono tracking-widest">E (পূ)</span>
                        <span class="absolute left-3 text-xs font-black text-gray-400 font-mono tracking-widest">W (প)</span>

                        <!-- Subtle Crosshairs -->
                        <div class="w-full h-[1px] bg-gray-200 dark:bg-gray-700 absolute"></div>
                        <div class="h-full w-[1px] bg-gray-200 dark:bg-gray-700 absolute"></div>
                    </div>

                    <!-- Qibla Arrow Pointer Needle -->
                    <div id="qiblaArrow" class="absolute inset-0 flex items-center justify-center transition-transform duration-500 ease-out pointer-events-none" style="transform: rotate(277.6deg);">
                        <div class="flex flex-col items-center h-full justify-between py-3">
                            <!-- Kaaba & Needle Tip -->
                            <div class="flex flex-col items-center">
                                <span class="text-2xl filter drop-shadow-md animate-bounce">🕋</span>
                                <div class="w-0 h-0 border-l-[8px] border-l-transparent border-r-[8px] border-r-transparent border-b-[20px] border-b-emerald-600 dark:border-b-emerald-400"></div>
                            </div>
                            <!-- Needle Tail -->
                            <div class="w-0 h-0 border-l-[6px] border-l-transparent border-r-[6px] border-r-transparent border-t-[14px] border-t-slate-400"></div>
                        </div>
                    </div>

                    <!-- Center Pivot Bead -->
                    <div class="w-8 h-8 rounded-full bg-emerald-600 dark:bg-emerald-500 border-2 border-white shadow-md z-10 flex items-center justify-center text-white text-xs font-black">
                        ✦
                    </div>
                </div>

                <!-- Degree Readout Banner -->
                <div class="space-y-1">
                    <div class="text-3xl sm:text-4xl font-black text-gray-900 dark:text-white font-mono tracking-tight">
                        <span id="qiblaDegree">277.6</span><span class="text-emerald-600 dark:text-emerald-400">°</span>
                    </div>
                    <p id="qiblaDirection" class="text-xs sm:text-sm font-bold text-emerald-700 dark:text-emerald-300">
                        West (পশ্চিম-উত্তর-পশ্চিম)
                    </p>
                </div>

                <!-- Action Button & Location Message -->
                <div class="w-full space-y-3 pt-2">
                    <button type="button" id="findQibla" class="w-full py-3.5 px-6 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md shadow-emerald-600/20 transition flex items-center justify-center gap-2 cursor-pointer">
                        <span>📍</span> <span>আমার বর্তমান অবস্থান সনাক্ত করুন (Auto Detect)</span>
                    </button>
                    
                    <div id="locationMessage" class="text-xs font-medium min-h-[20px]">
                        <span class="text-gray-500 dark:text-gray-400">ডিফল্ট অবস্থান: ঢাকা, বাংলাদেশ</span>
                    </div>
                </div>

            </div>

            <!-- Right Side: Location Presets, Coordinates & Distance (5 Cols) -->
            <div class="lg:col-span-5 space-y-6">
                
                <!-- City Selector Card -->
                <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 p-6 shadow-sm space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-gray-100 dark:border-gray-800">
                        <span class="text-lg">🏙️</span>
                        <div>
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white">শহর নির্বাচন করুন</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">জিপিএস ছাড়াই ১-ক্লিকে ক্বিবলা দেখুন</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <select id="citySelect" class="w-full text-sm font-semibold rounded-xl border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white py-3 px-4 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition shadow-xs cursor-pointer">
                            <option value="dhaka" selected>ঢাকা (Dhaka, BD) — 277.6°</option>
                            <option value="chittagong">চট্টগ্রাম (Chittagong, BD) — 275.9°</option>
                            <option value="sylhet">সিলেট (Sylhet, BD) — 276.8°</option>
                            <option value="khulna">খুলনা (Khulna, BD) — 278.4°</option>
                            <option value="rajshahi">রাজশাহী (Rajshahi, BD) — 278.9°</option>
                            <option value="barisal">বরিশাল (Barisal, BD) — 277.4°</option>
                            <option value="rangpur">রংপুর (Rangpur, BD) — 278.5°</option>
                            <option value="mymensingh">ময়মনসিংহ (Mymensingh, BD) — 277.9°</option>
                            <option value="london">লন্ডন (London, UK) — 118.9°</option>
                            <option value="newyork">নিউইয়র্ক (New York, USA) — 58.5°</option>
                            <option value="tokyo">টোকিও (Tokyo, Japan) — 293.0°</option>
                        </select>
                    </div>
                </div>

                <!-- Coordinates & Distance Summary Card -->
                <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 p-6 shadow-sm space-y-4">
                    <div class="flex items-center gap-2 pb-2 border-b border-gray-100 dark:border-gray-800">
                        <span class="text-lg">🕋</span>
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white">অবস্থান ও দূরত্বের বিবরণ</h3>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="flex items-center justify-between py-1.5 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-gray-500 dark:text-gray-400">বর্তমান অবস্থান:</span>
                            <strong id="activeLocName" class="font-bold text-gray-900 dark:text-white">ঢাকা, বাংলাদেশ</strong>
                        </div>
                        <div class="flex items-center justify-between py-1.5 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-gray-500 dark:text-gray-400">অক্ষাংশ ও দ্রাঘিমাংশ:</span>
                            <strong id="activeCoords" class="font-mono text-gray-900 dark:text-white font-bold">23.8103° N, 90.4125° E</strong>
                        </div>
                        <div class="flex items-center justify-between py-1.5 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-gray-500 dark:text-gray-400">পবিত্র কাবার অবস্থান:</span>
                            <strong class="font-mono text-gray-900 dark:text-white font-bold">21.4225° N, 39.8262° E</strong>
                        </div>
                        <div class="flex items-center justify-between py-1.5">
                            <span class="text-gray-500 dark:text-gray-400">কাবা শরীফ থেকে দূরত্ব:</span>
                            <strong id="kaabaDistance" class="font-mono text-emerald-600 dark:text-emerald-400 font-bold text-sm">৫,১৭২ কিমি</strong>
                        </div>
                    </div>
                </div>

                <!-- Guidance & Hadith Card -->
                <div class="p-5 rounded-3xl bg-emerald-50/60 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/60 space-y-2 text-xs text-emerald-900 dark:text-emerald-200 leading-relaxed">
                    <div class="font-bold flex items-center gap-1.5 text-emerald-800 dark:text-emerald-300">
                        <span>📖</span> <span>কুরআনুল কারিমের নির্দেশ:</span>
                    </div>
                    <p class="italic">
                        "অতএব আপনি মসজিদুল হারামের (কাবার) দিকে আপনার মুখমণ্ডল ফিরিয়ে নিন; এবং তোমরা যেখানেই থাক না কেন, সেদিকেই তোমাদের মুখমণ্ডল ফিরাও।" — (সূরা আল-বাক্বারাহ: ১৪৪)
                    </p>
                </div>

            </div>

        </div>
    </div>

</div>

<!-- Qibla Calculation Engine (STEP 9 & STEP 10) -->
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Holy Kaaba Coordinates (Constant)
    const KAABA_LAT = 21.4225;
    const KAABA_LNG = 39.8262;

    // City Coordinates Dictionary
    const cities = {
        'dhaka': { name: 'ঢাকা, বাংলাদেশ', lat: 23.8103, lng: 90.4125 },
        'chittagong': { name: 'চট্টগ্রাম, বাংলাদেশ', lat: 22.3569, lng: 91.7832 },
        'sylhet': { name: 'সিলেট, বাংলাদেশ', lat: 24.8949, lng: 91.8687 },
        'khulna': { name: 'খুলনা, বাংলাদেশ', lat: 22.8456, lng: 89.5403 },
        'rajshahi': { name: 'রাজশাহী, বাংলাদেশ', lat: 24.3636, lng: 88.6241 },
        'barisal': { name: 'বরিশাল, বাংলাদেশ', lat: 22.7010, lng: 90.3535 },
        'rangpur': { name: 'রংপুর, বাংলাদেশ', lat: 25.7439, lng: 89.2752 },
        'mymensingh': { name: 'ময়মনসিংহ, বাংলাদেশ', lat: 24.7471, lng: 90.4203 },
        'london': { name: 'লন্ডন, যুক্তরাজ্য', lat: 51.5074, lng: -0.1278 },
        'newyork': { name: 'নিউইয়র্ক, যুক্তরাষ্ট্র', lat: 40.7128, lng: -74.0060 },
        'tokyo': { name: 'টোকিও, জাপান', lat: 35.6762, lng: 139.6503 }
    };

    // DOM Elements
    const qiblaArrow = document.getElementById('qiblaArrow');
    const qiblaDegreeElem = document.getElementById('qiblaDegree');
    const qiblaDirectionElem = document.getElementById('qiblaDirection');
    const locationMessage = document.getElementById('locationMessage');
    const activeLocName = document.getElementById('activeLocName');
    const activeCoords = document.getElementById('activeCoords');
    const kaabaDistanceElem = document.getElementById('kaabaDistance');
    const citySelect = document.getElementById('citySelect');
    const findQiblaBtn = document.getElementById('findQibla');
    const compassDial = document.getElementById('compassDial');

    let currentQiblaBearing = 277.6;

    function toRadians(degrees) {
        return degrees * Math.PI / 180;
    }

    function toDegrees(radians) {
        return radians * 180 / Math.PI;
    }

    // Great-Circle Rhumb / Spherical Trigonometry Bearing Formula
    function calculateQibla(latitude, longitude) {
        const lat1 = toRadians(latitude);
        const lat2 = toRadians(KAABA_LAT);
        const deltaLng = toRadians(KAABA_LNG - longitude);

        const y = Math.sin(deltaLng) * Math.cos(lat2);
        const x = Math.cos(lat1) * Math.sin(lat2) - Math.sin(lat1) * Math.cos(lat2) * Math.cos(deltaLng);

        let bearing = toDegrees(Math.atan2(y, x));
        bearing = (bearing + 360) % 360;
        return bearing;
    }

    // Haversine Distance to Kaaba in KM
    function calculateDistance(latitude, longitude) {
        const R = 6371; // Earth radius in KM
        const dLat = toRadians(KAABA_LAT - latitude);
        const dLng = toRadians(KAABA_LNG - longitude);
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                  Math.cos(toRadians(latitude)) * Math.cos(toRadians(KAABA_LAT)) *
                  Math.sin(dLng / 2) * Math.sin(dLng / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return Math.round(R * c);
    }

    function getDirection(degree) {
        if (degree >= 337.5 || degree < 22.5) {
            return 'North (উত্তর)';
        }
        if (degree < 67.5) {
            return 'North-East (উত্তর-পূর্ব)';
        }
        if (degree < 112.5) {
            return 'East (পূর্ব)';
        }
        if (degree < 157.5) {
            return 'South-East (দক্ষিণ-পূর্ব)';
        }
        if (degree < 202.5) {
            return 'South (দক্ষিণ)';
        }
        if (degree < 247.5) {
            return 'South-West (দক্ষিণ-পশ্চিম)';
        }
        if (degree < 292.5) {
            return 'West (পশ্চিম-উত্তর-পশ্চিম)';
        }
        return 'North-West (উত্তর-পশ্চিম)';
    }

    function updateQiblaUI(lat, lng, locationLabel) {
        const bearing = calculateQibla(lat, lng);
        currentQiblaBearing = bearing;
        const distance = calculateDistance(lat, lng);

        if (qiblaDegreeElem) qiblaDegreeElem.innerText = bearing.toFixed(1);
        if (qiblaDirectionElem) qiblaDirectionElem.innerText = getDirection(bearing);
        if (qiblaArrow) qiblaArrow.style.transform = `rotate(${bearing}deg)`;

        if (activeLocName) activeLocName.innerText = locationLabel;
        if (activeCoords) activeCoords.innerText = `${lat.toFixed(4)}° N, ${lng.toFixed(4)}° E`;
        if (kaabaDistanceElem) kaabaDistanceElem.innerText = `${distance.toLocaleString('bn-BD')} কিমি (${distance.toLocaleString('en-US')} km)`;
    }

    // Geolocation Auto Detect
    function findQibla() {
        if (!navigator.geolocation) {
            locationMessage.innerHTML = '<span class="text-rose-500 font-bold">⚠️ আপনার ব্রাউজারে জিওলোকেশন সাপোর্ট করে না।</span>';
            return;
        }

        locationMessage.innerHTML = '<span class="text-emerald-600 font-bold animate-pulse">📡 আপনার অবস্থান সনাক্ত করা হচ্ছে...</span>';

        navigator.geolocation.getCurrentPosition(
            function (position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                updateQiblaUI(lat, lng, 'আপনার সনাক্তকৃত অবস্থান');
                locationMessage.innerHTML = '<span class="text-emerald-600 font-bold">✓ জিপিএস অবস্থান সফলভাবে সনাক্ত হয়েছে!</span>';
            },
            function (error) {
                locationMessage.innerHTML = '<span class="text-amber-600 dark:text-amber-400 font-medium">⚠️ অবস্থান এক্সেস পাওয়া যায়নি। ড্রপডাউন থেকে আপনার শহর নির্বাচন করুন।</span>';
            },
            { timeout: 10000, enableHighAccuracy: true }
        );
    }

    // City Dropdown Change Handler
    citySelect.addEventListener('change', function () {
        const cityKey = this.value;
        const city = cities[cityKey] || cities['dhaka'];
        updateQiblaUI(city.lat, city.lng, city.name);
        locationMessage.innerHTML = `<span class="text-gray-500">নির্বাচিত শহর: ${city.name}</span>`;
    });

    findQiblaBtn.addEventListener('click', findQibla);

    // Mobile Device Orientation Gyro Compass Listener
    if (window.DeviceOrientationEvent) {
        window.addEventListener('deviceorientation', function (event) {
            let heading = null;
            if (event.webkitCompassHeading) {
                // iOS WebKit
                heading = event.webkitCompassHeading;
            } else if (event.alpha !== null) {
                // Android Chrome / Standard
                heading = 360 - event.alpha;
            }

            if (heading !== null && compassDial) {
                // Rotate compass dial against phone heading
                compassDial.style.transform = `rotate(${-heading}deg)`;
                qiblaNeedle.style.transform = `rotate(${currentQiblaBearing - heading}deg)`;
            }
        }, true);
    }

    // Initial Load: Dhaka Default
    updateQiblaUI(cities['dhaka'].lat, cities['dhaka'].lng, cities['dhaka'].name);
});
</script>
@endpush
@endsection
