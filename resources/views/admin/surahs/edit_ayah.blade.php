@extends('layouts.admin')

@section('title', 'আয়াত সম্পাদনা — সূরা ' . $surah->name_bangla . ' (আয়াত #' . $ayah->ayah_number . ')')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white">আয়াত সম্পাদনা</h2>
            <p class="text-xs text-slate-400 mt-0.5">সূরা {{ $surah->name_bangla }} &bull; আয়াত নং {{ $ayah->ayah_number }} এর তথ্য সংশোধন করুন</p>
        </div>
        <a href="{{ route('admin.surahs.ayahs.index', $surah) }}" class="text-xs font-semibold text-slate-400 hover:text-white transition">
            &larr; আয়াত তালিকায় ফিরে যান
        </a>
    </div>

    <!-- Form Card -->
    <div class="p-6 sm:p-8 rounded-3xl bg-slate-950 border border-slate-800 shadow-xl">
        <form method="POST" action="{{ route('admin.surahs.ayahs.update', [$surah, $ayah]) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Ayah Number -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">আয়াত নম্বর (Ayah Number) *</label>
                <input type="number" name="ayah_number" value="{{ old('ayah_number', $ayah->ayah_number) }}" min="1" max="{{ $surah->ayah_count }}" required
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
            </div>

            <!-- Arabic Text -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">আরবি আয়াত (Arabic Text with Harakat) *</label>
                <textarea name="arabic_text" rows="4" required dir="rtl"
                          class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-2xl text-amber-300 focus:outline-none focus:border-emerald-500 leading-loose" style="font-family: 'Amiri', serif;">{{ old('arabic_text', $ayah->arabic_text) }}</textarea>
            </div>

            <!-- Bangla Translation -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">বাংলা অনুবাদ (Bangla Translation)</label>
                <textarea name="bangla_text" rows="4"
                          class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 leading-relaxed">{{ old('bangla_text', $ayah->bangla_text) }}</textarea>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
                <a href="{{ route('admin.surahs.ayahs.index', $surah) }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-sm font-semibold transition">
                    বাতিল করুন
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold shadow-md shadow-emerald-900/40 transition">
                    আপডেট করুন (Update Ayah)
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
