@extends('layouts.admin')

@section('title', 'দোয়া ক্যাটাগরি ব্যবস্থাপনা (Dua Categories CMS)')

@section('content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-white">দোয়া ও আযকার ক্যাটাগরি তালিকা</h2>
            <p class="text-xs text-slate-400 mt-0.5">মাসনূন দু'আ ও যিকিরের ক্যাটাগরি তৈরি, পরিমার্জন ও পরিচালনা করুন</p>
        </div>

        <a href="{{ route('admin.dua-categories.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white text-sm font-semibold shadow-md shadow-emerald-900/40 transition">
            <span>+</span>
            <span>নতুন ক্যাটাগরি যোগ করুন</span>
        </a>
    </div>

    <!-- Dua Categories Table -->
    <div class="rounded-3xl bg-slate-950 border border-slate-800 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="text-xs uppercase bg-slate-900/90 text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="px-5 py-3.5">ক্রম</th>
                        <th class="px-5 py-3.5">ক্যাটাগরির নাম (English)</th>
                        <th class="px-5 py-3.5">বাংলা নাম</th>
                        <th class="px-5 py-3.5">স্লাগ (Slug)</th>
                        <th class="px-5 py-3.5">মোট দু'আ</th>
                        <th class="px-5 py-3.5">স্ট্যাটাস</th>
                        <th class="px-5 py-3.5 text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/80">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-slate-900/50 transition">
                            <td class="px-5 py-4 font-bold text-emerald-400">#{{ $category->sort_order }}</td>
                            <td class="px-5 py-4 font-bold text-white flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                <span>{{ $category->name }}</span>
                            </td>
                            <td class="px-5 py-4 text-emerald-400 font-semibold">{{ $category->name_bangla ?? '—' }}</td>
                            <td class="px-5 py-4 text-xs font-mono text-amber-300/90">{{ $category->slug }}</td>
                            <td class="px-5 py-4 text-white font-bold">{{ $category->duas_count ?? $category->duas()->count() }}</td>
                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $category->status ? 'bg-emerald-950/80 text-emerald-300 border border-emerald-700/50' : 'bg-red-950/80 text-red-300 border border-red-700/50' }}">
                                    {{ $category->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.dua-categories.edit', $category) }}" class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-xs font-medium text-slate-200 transition">
                                        এডিট
                                    </a>

                                    <form method="POST" action="{{ route('admin.dua-categories.destroy', $category) }}" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই ক্যাটাগরি মুছে ফেলতে চান?');" class="inline">
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
                            <td colspan="7" class="px-5 py-12 text-center text-slate-500">
                                কোনো দোয়া ক্যাটাগরি পাওয়া যায়নি। উপরের বাটনে ক্লিক করে নতুন ক্যাটাগরি তৈরি করুন।
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($categories->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $categories->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
