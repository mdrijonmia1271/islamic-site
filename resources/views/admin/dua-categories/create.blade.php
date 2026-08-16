@extends('layouts.admin')

@section('title', 'নতুন দোয়া ক্যাটাগরি যোগ করুন (Add Dua Category)')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white">নতুন দোয়া ক্যাটাগরি তৈরি</h2>
            <p class="text-xs text-slate-400 mt-0.5">ক্যাটাগরির নাম, বাংলা নাম ও স্লাগ নির্ধারণ করুন</p>
        </div>
        <a href="{{ route('admin.dua-categories.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white transition">
            &larr; ক্যাটাগরি তালিকায় ফিরে যান
        </a>
    </div>

    <!-- Form Card -->
    <div class="p-6 sm:p-8 rounded-3xl bg-slate-950 border border-slate-800 shadow-xl">
        <form method="POST" action="{{ route('admin.dua-categories.store') }}" class="space-y-6">
            @csrf

            <!-- Category English Name -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">ক্যাটাগরির ইংরেজি নাম (Category Name: English) *</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Morning & Evening Azkar" required
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Bangla Name -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">ক্যাটাগরির বাংলা নাম (Category Name: Bangla)</label>
                <input type="text" name="name_bangla" value="{{ old('name_bangla') }}" placeholder="যেমন: সকাল ও সন্ধ্যার আযকার"
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('name_bangla') border-red-500 @enderror">
                @error('name_bangla')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Slug -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">ইউআরএল স্লাগ (Slug - ঐচ্ছিক)</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" placeholder="যেমন: morning-azkar"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('slug') border-red-500 @enderror">
                    @error('slug')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">ক্রমিক নম্বর (Sort Order)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">বিবরণ (Description)</label>
                <textarea name="description" rows="3" placeholder="এই ক্যাটাগরির দু'আসমূহ সম্পর্কে সংক্ষিপ্ত তথ্য..."
                          class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">{{ old('description') }}</textarea>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
                <a href="{{ route('admin.dua-categories.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-sm font-semibold transition">
                    বাতিল করুন
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold shadow-md shadow-emerald-900/40 transition">
                    সংরক্ষণ করুন (Save Category)
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
