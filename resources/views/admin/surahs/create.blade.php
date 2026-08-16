@extends('layouts.admin')

@section('title', 'নতুন সূরা যোগ করুন (Add New Surah)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white">নতুন সূরা নিবন্ধন ফর্ম</h2>
            <p class="text-xs text-slate-400 mt-0.5">পবিত্র কুরআনের সূরা সম্পর্কিত তথ্য প্রদান করুন</p>
        </div>
        <a href="{{ route('admin.surahs.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white transition">
            &larr; সূরা তালিকায় ফিরে যান
        </a>
    </div>

    <!-- Form Card -->
    <div class="p-6 sm:p-8 rounded-3xl bg-slate-950 border border-slate-800 shadow-xl">
        <form method="POST" action="{{ route('admin.surahs.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Surah Number -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">সূরা নম্বর (Surah Number: 1 - 114) *</label>
                    <input type="number" name="number" value="{{ old('number', $nextNumber ?? '') }}" min="1" max="114" required
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('number') border-red-500 @enderror">
                    @error('number')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Arabic Name -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">আরবি নাম (Arabic Name) *</label>
                    <input type="text" name="name_arabic" value="{{ old('name_arabic') }}" placeholder="যেমন: الفاتحة" required dir="rtl"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-lg text-amber-300 focus:outline-none focus:border-emerald-500 @error('name_arabic') border-red-500 @enderror" style="font-family: 'Amiri', serif;">
                    @error('name_arabic')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- English Name -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">ইংরেজি নাম (English Name) *</label>
                    <input type="text" name="name_english" value="{{ old('name_english') }}" placeholder="e.g. Al-Fatihah" required
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('name_english') border-red-500 @enderror">
                    @error('name_english')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bangla Name -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">বাংলা নাম (Bangla Name) *</label>
                    <input type="text" name="name_bangla" value="{{ old('name_bangla') }}" placeholder="যেমন: আল-ফাতিহা" required
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('name_bangla') border-red-500 @enderror">
                    @error('name_bangla')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Revelation Place -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">অবতীর্ণ হওয়ার স্থান (Revelation Place)</label>
                    <select name="revelation_place"
                            class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('revelation_place') border-red-500 @enderror">
                        <option value="">নির্বাচন করুন (Select)</option>
                        <option value="Makkah" {{ old('revelation_place') === 'Makkah' ? 'selected' : '' }}>মাক্কী (Makkah)</option>
                        <option value="Madinah" {{ old('revelation_place') === 'Madinah' ? 'selected' : '' }}>মাদানী (Madinah)</option>
                    </select>
                    @error('revelation_place')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Ayah Count -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">মোট আয়াত সংখ্যা (Ayah Count) *</label>
                    <input type="number" name="ayah_count" value="{{ old('ayah_count') }}" min="1" required
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('ayah_count') border-red-500 @enderror">
                    @error('ayah_count')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
                <a href="{{ route('admin.surahs.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-sm font-semibold transition">
                    ফিরে যান (Back)
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold shadow-md shadow-emerald-900/40 transition">
                    সংরক্ষণ করুন (Save Surah)
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
