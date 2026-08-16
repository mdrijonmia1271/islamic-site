@extends('layouts.admin')

@section('title', 'দোয়া ক্যাটাগরি সম্পাদনা (Edit: ' . $duaCategory->name . ')')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white">দোয়া ক্যাটাগরি সম্পাদনা</h2>
            <p class="text-xs text-slate-400 mt-0.5">{{ $duaCategory->name }} এর তথ্য পরিবর্তন করুন</p>
        </div>
        <a href="{{ route('admin.dua-categories.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white transition">
            &larr; ক্যাটাগরি তালিকায় ফিরে যান
        </a>
    </div>

    <!-- Form Card -->
    <div class="p-6 sm:p-8 rounded-3xl bg-slate-950 border border-slate-800 shadow-xl">
        <form method="POST" action="{{ route('admin.dua-categories.update', $duaCategory) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Category English Name -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">ক্যাটাগরির ইংরেজি নাম (Category Name: English) *</label>
                <input type="text" name="name" value="{{ old('name', $duaCategory->name) }}" required
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Bangla Name -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">ক্যাটাগরির বাংলা নাম (Category Name: Bangla)</label>
                <input type="text" name="name_bangla" value="{{ old('name_bangla', $duaCategory->name_bangla) }}"
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('name_bangla') border-red-500 @enderror">
                @error('name_bangla')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Slug -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">ইউআরএল স্লাগ (Slug) *</label>
                    <input type="text" name="slug" value="{{ old('slug', $duaCategory->slug) }}" required
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('slug') border-red-500 @enderror">
                    @error('slug')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">ক্রমিক নম্বর (Sort Order)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $duaCategory->sort_order) }}" min="0"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">বিবরণ (Description)</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">{{ old('description', $duaCategory->description) }}</textarea>
            </div>

            <!-- Status Checkbox -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="status" {{ old('status', $duaCategory->status) ? 'checked' : '' }}
                       class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-emerald-600 focus:ring-emerald-500">
                <label for="status" class="text-xs font-semibold text-slate-300 cursor-pointer">প্রকাশিত ও সক্রিয় রাখুন (Active & Published)</label>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
                <a href="{{ route('admin.dua-categories.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-sm font-semibold transition">
                    বাতিল করুন
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold shadow-md shadow-emerald-900/40 transition">
                    আপডেট করুন (Update Category)
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
