@extends('layouts.admin')

@section('title', 'হাদিস গ্রন্থ সম্পাদনা (Edit: ' . $hadithBook->name . ')')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white">হাদিস গ্রন্থ তথ্য সম্পাদনা</h2>
            <p class="text-xs text-slate-400 mt-0.5">{{ $hadithBook->name }} ({{ $hadithBook->name_bangla }}) এর তথ্য সংশোধন করুন</p>
        </div>
        <a href="{{ route('admin.hadith-books.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white transition">
            &larr; গ্রন্থ তালিকায় ফিরে যান
        </a>
    </div>

    <!-- Form Card -->
    <div class="p-6 sm:p-8 rounded-3xl bg-slate-950 border border-slate-800 shadow-xl">
        <form method="POST" action="{{ route('admin.hadith-books.update', $hadithBook) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Book English Name -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">গ্রন্থের ইংরেজি নাম (Book Name: English) *</label>
                <input type="text" name="name" value="{{ old('name', $hadithBook->name) }}" required
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Bangla Name -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">গ্রন্থের বাংলা নাম (Book Name: Bangla)</label>
                <input type="text" name="name_bangla" value="{{ old('name_bangla', $hadithBook->name_bangla) }}"
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('name_bangla') border-red-500 @enderror">
                @error('name_bangla')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Author -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">সংকলক / লেখক (Author)</label>
                    <input type="text" name="author" value="{{ old('author', $hadithBook->author) }}"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                </div>

                <!-- Slug -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">ইউআরএল স্লাগ (Slug) *</label>
                    <input type="text" name="slug" value="{{ old('slug', $hadithBook->slug) }}" required
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('slug') border-red-500 @enderror">
                    @error('slug')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">সংক্ষিপ্ত পরিচিতি ও বিবরণ (Description)</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">{{ old('description', $hadithBook->description) }}</textarea>
            </div>

            <!-- Status Checkbox -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="status" {{ old('status', $hadithBook->status) ? 'checked' : '' }}
                       class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-emerald-600 focus:ring-emerald-500">
                <label for="status" class="text-xs font-semibold text-slate-300 cursor-pointer">প্রকাশিত ও সক্রিয় রাখুন (Active & Published)</label>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
                <a href="{{ route('admin.hadith-books.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-sm font-semibold transition">
                    বাতিল করুন
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold shadow-md shadow-emerald-900/40 transition">
                    আপডেট করুন (Update Book)
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
