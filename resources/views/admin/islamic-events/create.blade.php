@extends('layouts.admin')

@section('title', 'নতুন ইসলামিক দিবস যোগ করুন (Add Islamic Event)')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white">নতুন ইসলামিক দিবস এন্ট্রি</h2>
            <p class="text-xs text-slate-400 mt-0.5">দিবসের নাম, হিজরি তারিখ ও বিবরণ নির্ধারণ করুন</p>
        </div>
        <a href="{{ route('admin.islamic-events.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white transition">
            &larr; দিবস তালিকায় ফিরে যান
        </a>
    </div>

    <!-- Form Card -->
    <div class="p-6 sm:p-8 rounded-3xl bg-slate-950 border border-slate-800 shadow-xl">
        <form method="POST" action="{{ route('admin.islamic-events.store') }}" class="space-y-6">
            @csrf

            <!-- Event Title (English) -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">দিবসের ইংরেজি নাম (Event Title: English) *</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Laylat al-Qadr" required
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('title') border-red-500 @enderror">
                @error('title')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Title Bangla -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">দিবসের বাংলা নাম (Event Title: Bangla)</label>
                <input type="text" name="title_bangla" value="{{ old('title_bangla') }}" placeholder="যেমন: পবিত্র শবে কদর"
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('title_bangla') border-red-500 @enderror">
                @error('title_bangla')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hijri Day & Month -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">হিজরি দিন (Hijri Day) *</label>
                    <input type="number" name="hijri_day" value="{{ old('hijri_day', 1) }}" min="1" max="30" required
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('hijri_day') border-red-500 @enderror">
                    @error('hijri_day')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-300 mb-2">হিজরি মাস (Hijri Month) *</label>
                    <select name="hijri_month" required
                            class="form-control w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('hijri_month') border-red-500 @enderror">
                        @foreach(config('hijri.months') as $number => $month)
                            <option value="{{ $number }}" @selected(old('hijri_month') == $number)>
                                {{ $number }} - {{ $month }} ({{ config("hijri.months_bn.{$number}") }})
                            </option>
                        @endforeach
                    </select>
                    @error('hijri_month')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Gregorian Date & Slug -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">গ্রেগরিয়ান সম্ভাব্য তারিখ (Gregorian Date - ঐচ্ছিক)</label>
                    <input type="date" name="gregorian_date" value="{{ old('gregorian_date') }}"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">ইউআরএল স্লাগ (Slug - ঐচ্ছিক)</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" placeholder="যেমন: laylat-al-qadr"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('slug') border-red-500 @enderror">
                    @error('slug')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">দিবসের তাৎপর্য ও বিবরণ (Description)</label>
                <textarea name="description" rows="3" placeholder="এই দিবসের ফযিলত ও ঐতিহাসিক গুরুত্ব..."
                          class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">{{ old('description') }}</textarea>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
                <a href="{{ route('admin.islamic-events.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-sm font-semibold transition">
                    বাতিল করুন
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold shadow-md shadow-emerald-900/40 transition">
                    সংরক্ষণ করুন (Save Event)
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
