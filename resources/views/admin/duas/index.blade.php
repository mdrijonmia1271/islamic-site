@extends('layouts.admin')

@section('title', 'দু\'আ ও আযকার ব্যবস্থাপনা (Duas CMS)')

@section('content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-white">দু'আ ও আযকার তালিকা</h2>
            <p class="text-xs text-slate-400 mt-0.5">দৈনন্দিন জীবনের মাসনূন দু'আ ও যিকির পরিচালনা করুন</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.dua-categories.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-xs font-semibold border border-slate-700 transition">
                📂 ক্যাটাগরি তালিকা
            </a>
            <a href="{{ route('admin.duas.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white text-sm font-semibold shadow-md shadow-emerald-900/40 transition">
                <span>+</span>
                <span>নতুন দু'আ যোগ করুন</span>
            </a>
        </div>
    </div>

    <!-- Filters & Search Bar -->
    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800">
        <form method="GET" action="{{ route('admin.duas.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <!-- Search Keyword -->
            <div class="relative sm:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="দু'আর নাম, আরবি টেক্সট বা অর্থ দিয়ে খুঁজুন..." 
                       class="w-full pl-10 pr-4 py-2 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500">
                <div class="absolute left-3 top-2.5 text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Category Filter -->
            <div class="flex gap-2">
                <select name="category_id" class="flex-1 px-3 py-2 rounded-xl bg-slate-900 border border-slate-700 text-sm text-slate-300 focus:outline-none focus:border-emerald-500">
                    <option value="">সকল ক্যাটাগরি</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name_bangla ?? $cat->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold transition">
                    ফিল্টার
                </button>
                @if (request()->hasAny(['search', 'category_id']))
                    <a href="{{ route('admin.duas.index') }}" class="px-3 py-2 rounded-xl bg-red-950/60 hover:bg-red-900/80 text-red-300 text-xs font-semibold flex items-center">
                        রিসেট
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Duas Table -->
    <div class="rounded-3xl bg-slate-950 border border-slate-800 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="text-xs uppercase bg-slate-900/90 text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="px-5 py-3.5">শিরোনাম / নাম</th>
                        <th class="px-5 py-3.5">ক্যাটাগরি</th>
                        <th class="px-5 py-3.5">আরবি অংশ</th>
                        <th class="px-5 py-3.5">রেফারেন্স</th>
                        <th class="px-5 py-3.5">স্ট্যাটাস</th>
                        <th class="px-5 py-3.5 text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/80">
                    @forelse ($duas as $dua)
                        <tr class="hover:bg-slate-900/50 transition">
                            <td class="px-5 py-4 font-bold text-white max-w-xs">
                                <div>{{ $dua->title_bangla ?? $dua->title }}</div>
                                <div class="text-xs text-slate-400 font-normal mt-0.5">{{ $dua->title }}</div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-950/60 text-emerald-300 border border-emerald-800/50">
                                    {{ $dua->category->name_bangla ?? $dua->category->name }}
                                </span>
                            </td>
                            <td class="px-5 py-4 font-serif text-amber-300/90 text-base max-w-sm truncate" dir="rtl" style="font-family: 'Amiri', serif;">
                                {{ Str::limit($dua->arabic_text, 60) }}
                            </td>
                            <td class="px-5 py-4 text-xs text-slate-400 font-medium">
                                {{ $dua->reference ?? '—' }}
                            </td>
                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $dua->status ? 'bg-emerald-950/80 text-emerald-300 border border-emerald-700/50' : 'bg-red-950/80 text-red-300 border border-red-700/50' }}">
                                    {{ $dua->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.duas.edit', $dua) }}" class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-xs font-medium text-slate-200 transition">
                                        এডিট
                                    </a>

                                    <form method="POST" action="{{ route('admin.duas.destroy', $dua) }}" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই দু\'আটি মুছে ফেলতে চান?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-950/60 hover:bg-red-900/80 text-xs font-medium text-red-300 transition">
                                            ডিলিট
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-slate-500">
                                কোনো দু'আ পাওয়া যায়নি।
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($duas->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $duas->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
