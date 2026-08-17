@extends('layouts.app')

@section('title', 'যাকাত ক্যালকুলেটর (Zakat Calculator) — Islamic Site')
@section('meta_description', 'অনলাইন ইসলামিক যাকাত ক্যালকুলেটর। স্বর্ণ, রূপা, নগদ টাকা ও ব্যবসায়িক সম্পদের ওপর ২.৫% যাকাতের নির্ভুল হিসাব।')

@section('content')
<div class="bg-gray-50 dark:bg-gray-950 min-h-screen pb-24">

    <!-- Signature Hero Header -->
    <section class="relative overflow-hidden bg-gradient-to-b from-emerald-950 via-teal-950 to-slate-950 text-white py-12 sm:py-16 border-b border-emerald-900/40">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 text-center space-y-3">
            <span class="text-2xl sm:text-3xl font-serif text-amber-300 block" style="font-family: 'Amiri', serif;">
                حَاسِبَةُ الزَّكَاةِ
            </span>

            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight flex items-center justify-center gap-3">
                <span>💰</span> <span>যাকাত <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-amber-300 bg-clip-text text-transparent">ক্যালকুলেটর</span></span>
            </h1>

            <p class="text-sm sm:text-base text-emerald-100/90 max-w-xl mx-auto leading-relaxed">
                আপনার নগদ অর্থ, ব্যাংকে গচ্ছিত সঞ্চয়, স্বর্ণ, রূপা ও ব্যবসায়িক সম্পদের ওপর আনুমানিক ২.৫% যাকাত হিসাব করুন।
            </p>
        </div>
    </section>

    <!-- Main Calculator Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Side: Asset & Liability Input Form (7 Cols) -->
            <div class="lg:col-span-7 space-y-6">
                
                <form id="zakatForm" class="space-y-6">
                    <!-- Section 1: Cash & Bank -->
                    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 p-6 sm:p-7 shadow-sm space-y-4">
                        <div class="flex items-center gap-2 pb-3 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-xl">💵</span>
                            <div>
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">নগদ টাকা ও ব্যাংক সঞ্চয়</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">হাতে থাকা নগদ অর্থ এবং ব্যাংকে জমাকৃত ব্যালেন্স</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="cash" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                                    নগদ অর্থ (হাতে বা ঘরে রক্ষিত)
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-500 font-bold text-sm">৳</span>
                                    <input type="number" id="cash" step="any" min="0" placeholder="0.00" 
                                           class="zakat-input w-full pl-8 pr-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition shadow-xs">
                                </div>
                            </div>

                            <div>
                                <label for="bank" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                                    ব্যাংক একাউন্ট ও সেভিংস
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-500 font-bold text-sm">৳</span>
                                    <input type="number" id="bank" step="any" min="0" placeholder="0.00" 
                                           class="zakat-input w-full pl-8 pr-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition shadow-xs">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Gold & Silver -->
                    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 p-6 sm:p-7 shadow-sm space-y-4">
                        <div class="flex items-center gap-2 pb-3 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-xl">✨</span>
                            <div>
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">স্বর্ণ ও রূপার মূল্য</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">মালিকানাধীন স্বর্ণ ও রূপার বর্তমান বাজারমূল্য</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="gold" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                                    স্বর্ণের বর্তমান বাজারমূল্য
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-500 font-bold text-sm">৳</span>
                                    <input type="number" id="gold" step="any" min="0" placeholder="0.00" 
                                           class="zakat-input w-full pl-8 pr-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition shadow-xs">
                                </div>
                            </div>

                            <div>
                                <label for="silver" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                                    রূপার বর্তমান বাজারমূল্য
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-500 font-bold text-sm">৳</span>
                                    <input type="number" id="silver" step="any" min="0" placeholder="0.00" 
                                           class="zakat-input w-full pl-8 pr-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition shadow-xs">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Business & Other Assets -->
                    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 p-6 sm:p-7 shadow-sm space-y-4">
                        <div class="flex items-center gap-2 pb-3 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-xl">🏬</span>
                            <div>
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">ব্যবসায়িক পণ্য ও অন্যান্য সম্পদ</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">ব্যবসায়ের মালামাল, শেয়ার, প্রাইজবন্ড বা বিনিয়োগ</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="business" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                                    ব্যবসায়িক পণ্যের বিক্রয়মূল্য
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-500 font-bold text-sm">৳</span>
                                    <input type="number" id="business" step="any" min="0" placeholder="0.00" 
                                           class="zakat-input w-full pl-8 pr-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition shadow-xs">
                                </div>
                            </div>

                            <div>
                                <label for="other" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                                    অন্যান্য যাকাতযোগ্য সম্পদ/বিনিয়োগ
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-500 font-bold text-sm">৳</span>
                                    <input type="number" id="other" step="any" min="0" placeholder="0.00" 
                                           class="zakat-input w-full pl-8 pr-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition shadow-xs">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Liabilities & Debts -->
                    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 p-6 sm:p-7 shadow-sm space-y-4">
                        <div class="flex items-center gap-2 pb-3 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-xl">📉</span>
                            <div>
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">বাদযোগ্য দেনা ও ঋণ</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">তাৎক্ষণিক পরিশোধযোগ্য ঋণ বা দেনা (যা মোট সম্পদ থেকে বাদ যাবে)</p>
                            </div>
                        </div>

                        <div>
                            <label for="liabilities" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                                মোট ঋণ ও দেনার পরিমাণ
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-500 font-bold text-sm">৳</span>
                                <input type="number" id="liabilities" step="any" min="0" placeholder="0.00" 
                                       class="zakat-input w-full pl-8 pr-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition shadow-xs">
                            </div>
                        </div>
                    </div>

                    <!-- Control Buttons -->
                    <div class="flex items-center gap-3 pt-2">
                        <button type="button" id="calcBtn" class="flex-grow py-3.5 px-6 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm sm:text-base shadow-md shadow-emerald-600/20 transition flex items-center justify-center gap-2 cursor-pointer">
                            <span>🧮</span> <span>যাকাত হিসাব করুন (Calculate)</span>
                        </button>
                        <button type="button" id="resetBtn" class="py-3.5 px-6 rounded-2xl bg-gray-100 dark:bg-gray-800 hover:bg-red-50 dark:hover:bg-red-950/40 text-gray-700 dark:text-gray-300 hover:text-red-600 text-xs sm:text-sm font-semibold transition border border-gray-200 dark:border-gray-700 cursor-pointer">
                            <span>🔄</span> <span>রিসেট</span>
                        </button>
                    </div>
                </form>

            </div>

            <!-- Right Side: Live Results & Nisab Guide (5 Cols) -->
            <div class="lg:col-span-5 space-y-6 lg:sticky lg:top-20">
                
                <!-- Result Card -->
                <div id="zakatResultCard" class="bg-white dark:bg-gray-900 rounded-3xl border-2 border-emerald-500/30 p-6 sm:p-8 shadow-xl space-y-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10 text-6xl pointer-events-none">
                        💰
                    </div>

                    <div class="text-center space-y-1">
                        <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider block">
                            আপনার আনুমানিক যাকাত
                        </span>
                        <h2 class="text-xl font-black text-gray-900 dark:text-white">
                            যাকাতের হিসাব বিবরণী
                        </h2>
                    </div>

                    <!-- Large Highlighted Zakat Amount -->
                    <div class="p-5 rounded-2xl bg-emerald-50/80 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-center space-y-1">
                        <span class="text-xs font-semibold text-emerald-800 dark:text-emerald-300">প্রদেয় মোট যাকাত (২.৫%)</span>
                        <div class="text-3xl sm:text-4xl font-black text-emerald-600 dark:text-emerald-400 font-mono tracking-tight">
                            <span id="zakatCurrency">৳</span> <span id="zakatAmount">0.00</span>
                        </div>
                    </div>

                    <!-- Detailed Breakdown Rows -->
                    <div class="space-y-3 text-xs sm:text-sm pt-2">
                        <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-gray-600 dark:text-gray-400">সর্বমোট যাকাতযোগ্য সম্পদ:</span>
                            <strong class="font-mono font-bold text-gray-900 dark:text-white">৳ <span id="totalAssets">0.00</span></strong>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-gray-600 dark:text-gray-400">বাদযোগ্য ঋণ ও দেনা:</span>
                            <strong class="font-mono font-bold text-red-500">- ৳ <span id="totalLiabilities">0.00</span></strong>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-gray-600 dark:text-gray-400">নীট যাকাতযোগ্য সম্পদ:</span>
                            <strong class="font-mono font-bold text-emerald-600 dark:text-emerald-400">৳ <span id="netWealth">0.00</span></strong>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-gray-600 dark:text-gray-400">যাকাত নির্ধারণ হার:</span>
                            <span class="font-bold text-gray-800 dark:text-gray-200">২.৫% (১/৪০ অংশ)</span>
                        </div>
                    </div>

                    <!-- Copy / Note Footer -->
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 text-center space-y-2">
                        <button type="button" id="copySummaryBtn" class="w-full py-2.5 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 text-gray-700 dark:text-gray-200 hover:text-emerald-600 text-xs font-bold transition flex items-center justify-center gap-1.5 cursor-pointer">
                            <span>📋</span> <span>হিসাবের সারাংশ কপি করুন</span>
                        </button>
                        <p class="text-[11px] text-gray-400 dark:text-gray-500 leading-normal">
                            * এটি একটি শিক্ষামূলক ও আনুমানিক হিসাব। বিস্তারিত মাসআলার জন্য বিজ্ঞ আলেমের পরামর্শ নিন।
                        </p>
                    </div>
                </div>

                <!-- Nisab Guide Card -->
                <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 p-6 shadow-sm space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">📜</span>
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white">যাকাত ও নিসাবের সাধারণ নিয়মাবলী</h3>
                    </div>

                    <div class="space-y-2.5 text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                        <div class="p-3 rounded-xl bg-amber-50/60 dark:bg-amber-950/30 border border-amber-200/60 dark:border-amber-900/60 text-amber-900 dark:text-amber-200">
                            <strong>স্বর্ণের নিসাব:</strong> ৭.৫ ভরি বা তোলা (৮৭.৪৮ গ্রাম)।
                        </div>
                        <div class="p-3 rounded-xl bg-slate-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200">
                            <strong>রূপার নিসাব:</strong> ৫২.৫ ভরি বা তোলা (৬১২.৩৬ গ্রাম)।
                        </div>
                        <p>
                            • নিসাব পরিমাণ সম্পদের মালিক হওয়ার পর পূর্ণ এক চন্দ্রবছর (হাওলানুল হাওল) অতিবাহিত হলে যাকাত ফরজ হয়।
                        </p>
                        <p>
                            • দৈনন্দিন ব্যবহার্য বাড়ি, গাড়ি, পরিধেয় পোশাক ও গৃহস্থালি সামগ্রীর ওপর যাকাত প্রযোজ্য নয়।
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

<!-- Zakat Calculation Engine (STEP 4 & Real-Time Sync) -->
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fields = ['cash', 'bank', 'gold', 'silver', 'business', 'other'];
    const liabilitiesField = document.getElementById('liabilities');
    const totalAssetsElem = document.getElementById('totalAssets');
    const totalLiabilitiesElem = document.getElementById('totalLiabilities');
    const netWealthElem = document.getElementById('netWealth');
    const zakatAmountElem = document.getElementById('zakatAmount');
    const calcBtn = document.getElementById('calcBtn');
    const resetBtn = document.getElementById('resetBtn');
    const copySummaryBtn = document.getElementById('copySummaryBtn');

    function formatNumber(num) {
        return num.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function calculateZakat() {
        let totalAssets = 0;

        fields.forEach(function (fieldId) {
            const input = document.getElementById(fieldId);
            if (input) {
                const val = parseFloat(input.value) || 0;
                totalAssets += val;
            }
        });

        const liabilities = parseFloat(liabilitiesField ? liabilitiesField.value : 0) || 0;
        const netWealth = Math.max(totalAssets - liabilities, 0);
        const zakat = netWealth * 0.025;

        if (totalAssetsElem) totalAssetsElem.innerText = formatNumber(totalAssets);
        if (totalLiabilitiesElem) totalLiabilitiesElem.innerText = formatNumber(liabilities);
        if (netWealthElem) netWealthElem.innerText = formatNumber(netWealth);
        if (zakatAmountElem) zakatAmountElem.innerText = formatNumber(zakat);
    }

    // Attach real-time input listeners
    fields.forEach(function (fieldId) {
        const input = document.getElementById(fieldId);
        if (input) {
            input.addEventListener('input', calculateZakat);
        }
    });

    if (liabilitiesField) {
        liabilitiesField.addEventListener('input', calculateZakat);
    }

    if (calcBtn) {
        calcBtn.addEventListener('click', function () {
            calculateZakat();
            const resultCard = document.getElementById('zakatResultCard');
            if (resultCard) {
                resultCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    }

    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            fields.forEach(function (fieldId) {
                const input = document.getElementById(fieldId);
                if (input) input.value = '';
            });
            if (liabilitiesField) liabilitiesField.value = '';
            calculateZakat();
        });
    }

    if (copySummaryBtn) {
        copySummaryBtn.addEventListener('click', function () {
            const zakatVal = zakatAmountElem.innerText;
            const assetsVal = totalAssetsElem.innerText;
            const netVal = netWealthElem.innerText;

            const text = `💰 যাকাত হিসাব সারাংশ:\n• মোট সম্পদ: ৳ ${assetsVal}\n• নীট সম্পদ: ৳ ${netVal}\n• প্রদেয় যাকাত (২.৫%): ৳ ${zakatVal}\n(হিসাবটি Islamic Site যাকাত ক্যালকুলেটর থেকে প্রস্তুতকৃত)`;
            
            navigator.clipboard.writeText(text).then(() => {
                const originalText = copySummaryBtn.innerHTML;
                copySummaryBtn.innerHTML = '<span>✅</span> <span>সারাংশ কপি হয়েছে!</span>';
                setTimeout(() => {
                    copySummaryBtn.innerHTML = originalText;
                }, 2500);
            });
        });
    }

    // Initial run
    calculateZakat();
});
</script>
@endpush
@endsection
