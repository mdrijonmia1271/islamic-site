@extends('layouts.admin')

@section('title', 'আয়াত ব্যবস্থাপনা — ' . $surah->name_bangla . ' (' . $surah->name_arabic . ')')

@section('content')
<div class="space-y-8">

    <!-- Surah Info Banner -->
    <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-emerald-950 via-teal-950 to-slate-950 border border-emerald-800/40 text-white flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-xl">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 rounded-full bg-emerald-800/60 text-xs font-bold text-emerald-300">
                    সূরা নং #{{ $surah->number }}
                </span>
                <span class="px-3 py-1 rounded-full bg-amber-950/60 text-xs font-semibold text-amber-300 border border-amber-500/30">
                    {{ $surah->revelation_place === 'Makkah' ? 'মাক্কী' : 'মাদানী' }}
                </span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold mt-2 flex items-center gap-3">
                <span>{{ $surah->name_bangla }}</span>
                <span class="text-amber-300 font-normal text-3xl" style="font-family: 'Amiri', serif;">{{ $surah->name_arabic }}</span>
                <span class="text-sm font-normal text-slate-400">({{ $surah->name_english }})</span>
            </h2>
            <p class="text-xs text-slate-400 mt-1">
                নির্ধারিত মোট আয়াত: <span class="text-white font-bold">{{ $surah->ayah_count }}</span> &bull; ডাটাবেজে এন্ট্রি করা আয়াত: <span class="text-emerald-400 font-bold">{{ $surah->ayahs->count() }}</span>
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('quran.show', $surah->number) }}" target="_blank" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-xs font-semibold text-slate-200 transition flex items-center gap-1.5">
                <span>👁️</span> ফ্রন্টএন্ড প্রিভিউ
            </a>
            <a href="{{ route('admin.surahs.index') }}" class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-xs font-semibold text-slate-400 hover:text-white transition">
                &larr; সূরা তালিকা
            </a>
        </div>
    </div>

    <!-- 2 Column Layout: Add Ayah Form (Left/Top) & Ayahs List (Right/Bottom) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left: Add New Ayah Form Card -->
        <div class="lg:col-span-1">
            <div class="p-6 rounded-3xl bg-slate-950 border border-slate-800 shadow-xl sticky top-28">
                <h3 class="text-base font-bold text-white mb-1 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-emerald-600 text-white flex items-center justify-center text-sm">+</span>
                    <span>নতুন আয়াত যোগ করুন</span>
                </h3>
                <p class="text-xs text-slate-400 mb-5">সূরা {{ $surah->name_bangla }}-এ নতুন আয়াত এন্ট্রি দিন</p>

                <form method="POST" action="{{ route('admin.surahs.ayahs.store', $surah) }}" class="space-y-4">
                    @csrf

                    <!-- Ayah Number -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5">আয়াত নম্বর (Ayah Number) *</label>
                        <input type="number" name="ayah_number" value="{{ old('ayah_number', $nextAyahNumber) }}" min="1" max="{{ $surah->ayah_count }}" required
                               class="w-full px-3.5 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                    </div>

                    <!-- Arabic Text -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5">আরবি আয়াত (Arabic Text with Harakat) *</label>
                        <textarea name="arabic_text" rows="3" required dir="rtl" placeholder="এখানে আরবি আয়াত পেস্ট বা টাইপ করুন..."
                                  class="w-full px-3.5 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-lg text-amber-300 focus:outline-none focus:border-emerald-500 leading-loose" style="font-family: 'Amiri', serif;">{{ old('arabic_text') }}</textarea>
                    </div>

                    <!-- Bangla Translation -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5">বাংলা অনুবাদ (Bangla Translation)</label>
                        <textarea name="bangla_text" rows="3" placeholder="আয়াতের বাংলা অর্থ..."
                                  class="w-full px-3.5 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">{{ old('bangla_text') }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-sm shadow-md shadow-emerald-900/40 transition">
                        আয়াত সংরক্ষণ করুন (Save Ayah)
                    </button>
                </form>
            </div>
        </div>

        <!-- Right: Ayahs List -->
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-base font-bold text-white">বর্তমান আয়াত তালিকা ({{ $surah->ayahs->count() }})</h3>
                <span class="text-xs text-slate-400">ধারাবাহিক ক্রমানুসারে সাজানো</span>
            </div>

            @forelse ($surah->ayahs as $ayah)
                <div class="p-5 rounded-2xl bg-slate-950 border border-slate-800/90 shadow-sm hover:border-emerald-500/30 transition space-y-4 group">
                    <!-- Ayah Header Bar -->
                    <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-xl bg-emerald-950 text-emerald-400 flex items-center justify-center font-bold text-xs border border-emerald-800/40">
                                {{ $ayah->ayah_number }}
                            </span>
                            <span class="text-xs text-slate-400">আয়াত নং {{ $ayah->ayah_number }}</span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.surahs.ayahs.edit', [$surah, $ayah]) }}" class="px-3 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 text-xs font-medium text-slate-200 transition">
                                এডিট
                            </a>

                            <form method="POST" action="{{ route('admin.surahs.ayahs.destroy', [$surah, $ayah]) }}" onsubmit="return confirm('আপনি কি নিশ্চিত যে আয়াত নং {{ $ayah->ayah_number }} মুছে ফেলতে চান?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 rounded-lg bg-red-950/60 hover:bg-red-900/80 text-xs font-medium text-red-300 transition">
                                    ডিলিট
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Arabic Text -->
                    <div class="text-right leading-loose text-2xl sm:text-3xl text-amber-300 font-normal py-2" style="font-family: 'Amiri', serif; direction: rtl;">
                        {{ $ayah->arabic_text }} ﴿{{ $ayah->ayah_number }}﴾
                    </div>

                    <!-- Bangla Text -->
                    @if ($ayah->bangla_text)
                        <div class="pt-2 border-t border-slate-800/80 text-sm text-slate-300 leading-relaxed">
                            <span class="text-xs text-emerald-400 font-semibold uppercase block mb-0.5">বাংলা অর্থ:</span>
                            {{ $ayah->bangla_text }}
                        </div>
                    @endif
                </div>
            @empty
                <div class="p-12 rounded-3xl bg-slate-950 border border-slate-800 text-center">
                    <div class="text-4xl mb-3">📖</div>
                    <h4 class="text-base font-bold text-white">এখনও কোনো আয়াত যুক্ত করা হয়নি</h4>
                    <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">
                        বাম পাশের ফর্ম ব্যবহার করে এই সূরার প্রথম আয়াত যুক্ত করুন।
                    </p>
                </div>
            @endforelse
        </div>

    </div>

</div>
@endsection
