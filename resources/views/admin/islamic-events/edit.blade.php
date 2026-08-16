@extends('layouts.admin')

@section('title', 'ইসলামিক দিবস সম্পাদনা (Edit: ' . $islamicEvent->title . ')')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white">ইসলামিক দিবস সম্পাদনা</h2>
            <p class="text-xs text-slate-400 mt-0.5">{{ $islamicEvent->title }} এর তথ্য সংশোধন করুন</p>
        </div>
        <a href="{{ route('admin.islamic-events.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white transition">
            &larr; দিবস তালিকায় ফিরে যান
        </a>
    </div>

    <!-- Form Card -->
    <div class="p-6 sm:p-8 rounded-3xl bg-slate-950 border border-slate-800 shadow-xl">
        <form method="POST" action="{{ route('admin.islamic-events.update', $islamicEvent) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Event Title (English) -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">দিবসের ইংরেজি নাম (Event Title: English) *</label>
                <input type="text" name="title" value="{{ old('title', $islamicEvent->title) }}" required
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('title') border-red-500 @enderror">
                @error('title')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Title Bangla -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">দিবসের বাংলা নাম (Event Title: Bangla)</label>
                <input type="text" name="title_bangla" value="{{ old('title_bangla', $islamicEvent->title_bangla) }}"
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('title_bangla') border-red-500 @enderror">
                @error('title_bangla')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hijri Day & Month -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">হিজরি দিন (Hijri Day) *</label>
                    <input type="number" name="hijri_day" value="{{ old('hijri_day', $islamicEvent->hijri_day) }}" min="1" max="30" required
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
                            <option value="{{ $number }}" @selected(old('hijri_month', $islamicEvent->hijri_month) == $number)>
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
                    <label class="block text-xs font-semibold text-slate-300 mb-2">গ্রেগরিয়ান সম্ভাব্য তারিখ (Gregorian Date)</label>
                    <input type="date" name="gregorian_date" value="{{ old('gregorian_date', $islamicEvent->gregorian_date?->format('Y-m-d')) }}"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">ইউআরএল স্লাগ (Slug) *</label>
                    <input type="text" name="slug" value="{{ old('slug', $islamicEvent->slug) }}" required
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('slug') border-red-500 @enderror">
                    @error('slug')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">দিবসের তাৎপর্য ও বিবরণ (Description)</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">{{ old('description', $islamicEvent->description) }}</textarea>
            </div>

            <!-- Status Checkbox -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="status" {{ old('status', $islamicEvent->status) ? 'checked' : '' }}
                       class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-emerald-600 focus:ring-emerald-500">
                <label for="status" class="text-xs font-semibold text-slate-300 cursor-pointer">সক্রিয় ও প্রকাশিত রাখুন (Active)</label>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
                <a href="{{ route('admin.islamic-events.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-sm font-semibold transition">
                    বাতিল করুন
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold shadow-md shadow-emerald-900/40 transition">
                    আপডেট করুন (Update Event)
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
