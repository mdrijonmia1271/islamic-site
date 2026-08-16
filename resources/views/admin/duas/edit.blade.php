@extends('layouts.admin')

@section('title', 'দু\'আ সম্পাদনা (Edit Dua: ' . ($dua->title_bangla ?? $dua->title) . ')')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white">দু'আ তথ্য সম্পাদনা</h2>
            <p class="text-xs text-slate-400 mt-0.5">{{ $dua->title_bangla ?? $dua->title }} এর তথ্য সংশোধন করুন</p>
        </div>
        <a href="{{ route('admin.duas.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white transition">
            &larr; দু'আ তালিকায় ফিরে যান
        </a>
    </div>

    <!-- Form Card -->
    <div class="p-6 sm:p-8 rounded-3xl bg-slate-950 border border-slate-800 shadow-xl">
        <form method="POST" action="{{ route('admin.duas.update', $dua) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Category & Sort Order -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-300 mb-2">ক্যাটাগরি নির্বাচন করুন (Select Category) *</label>
                    <select name="dua_category_id" required
                            class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('dua_category_id') border-red-500 @enderror">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('dua_category_id', $dua->dua_category_id) == $category->id)>
                                {{ $category->name_bangla ? $category->name_bangla . ' (' . $category->name . ')' : $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('dua_category_id')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">ক্রমিক নম্বর (Sort Order)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $dua->sort_order) }}" min="0"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                </div>
            </div>

            <!-- Titles -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">দু'আর শিরোনাম (Title: English) *</label>
                    <input type="text" name="title" value="{{ old('title', $dua->title) }}" required
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('title') border-red-500 @enderror">
                    @error('title')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">বাংলা শিরোনাম (Title: Bangla)</label>
                    <input type="text" name="title_bangla" value="{{ old('title_bangla', $dua->title_bangla) }}"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                </div>
            </div>

            <!-- Arabic Text -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">আরবি মূল দু'আ (Arabic Text with Harakat) *</label>
                <textarea name="arabic_text" rows="4" required dir="rtl"
                          class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-2xl text-amber-300 focus:outline-none focus:border-emerald-500 leading-loose @error('arabic_text') border-red-500 @enderror" style="font-family: 'Amiri', serif;">{{ old('arabic_text', $dua->arabic_text) }}</textarea>
                @error('arabic_text')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Transliteration (উচ্চারণ) -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">বাংলা উচ্চারণ (Transliteration)</label>
                <textarea name="transliteration" rows="2"
                          class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">{{ old('transliteration', $dua->transliteration) }}</textarea>
            </div>

            <!-- Bangla & English Meaning -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">বাংলা অর্থ (Bangla Meaning)</label>
                    <textarea name="bangla_meaning" rows="4"
                              class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">{{ old('bangla_meaning', $dua->bangla_meaning) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">ইংরেজি অর্থ (English Meaning)</label>
                    <textarea name="english_meaning" rows="4"
                              class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">{{ old('english_meaning', $dua->english_meaning) }}</textarea>
                </div>
            </div>

            <!-- Reference & Source -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">হাদিস/কুরআন রেফারেন্স (Reference)</label>
                    <input type="text" name="reference" value="{{ old('reference', $dua->reference) }}"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">গ্রন্থের নাম/উৎস (Source)</label>
                    <input type="text" name="source" value="{{ old('source', $dua->source) }}"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                </div>
            </div>

            <!-- Audio URL & Status -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-300 mb-2">অডিও তিলাওয়াত লিংক (Audio URL)</label>
                    <input type="url" name="audio_url" value="{{ old('audio_url', $dua->audio_url) }}"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('audio_url') border-red-500 @enderror">
                </div>

                <div class="flex items-center pt-6">
                    <label class="flex items-center gap-2 text-xs font-semibold text-slate-300 cursor-pointer">
                        <input type="checkbox" name="status" value="1" {{ old('status', $dua->status) ? 'checked' : '' }}
                               class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-emerald-600 focus:ring-emerald-500">
                        <span>সক্রিয় রাখুন (Active)</span>
                    </label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
                <a href="{{ route('admin.duas.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-sm font-semibold transition">
                    বাতিল করুন
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold shadow-md shadow-emerald-900/40 transition">
                    আপডেট করুন (Update Dua)
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
