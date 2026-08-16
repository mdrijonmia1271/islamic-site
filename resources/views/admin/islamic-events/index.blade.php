@extends('layouts.admin')

@section('title', 'ইসলামিক দিবস ও ইভেন্টস ব্যবস্থাপনা (Islamic Events CMS)')

@section('content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-white">ইসলামিক দিবস ও ক্যালেন্ডার ইভেন্টস</h2>
            <p class="text-xs text-slate-400 mt-0.5">রমজান, ঈদ, শবে কদর, আশুরা সহ গুরুত্বপূর্ণ দিবস পরিচালনা করুন</p>
        </div>

        <a href="{{ route('admin.islamic-events.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white text-sm font-semibold shadow-md shadow-emerald-900/40 transition">
            <span>+</span>
            <span>নতুন দিবস যোগ করুন</span>
        </a>
    </div>

    <!-- Events Table -->
    <div class="rounded-3xl bg-slate-950 border border-slate-800 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="text-xs uppercase bg-slate-900/90 text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="px-5 py-3.5">দিবস / ইভেন্ট নাম</th>
                        <th class="px-5 py-3.5">বাংলা নাম</th>
                        <th class="px-5 py-3.5">হিজরি তারিখ</th>
                        <th class="px-5 py-3.5">গ্রেগরিয়ান তারিখ</th>
                        <th class="px-5 py-3.5">স্ট্যাটাস</th>
                        <th class="px-5 py-3.5 text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/80">
                    @forelse ($events as $event)
                        <tr class="hover:bg-slate-900/50 transition">
                            <td class="px-5 py-4 font-bold text-white flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                                <span>{{ $event->title }}</span>
                            </td>
                            <td class="px-5 py-4 text-emerald-400 font-semibold">
                                {{ $event->title_bangla ?? '—' }}
                            </td>
                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-950/80 text-emerald-300 border border-emerald-800/50">
                                    {{ $event->hijri_day }} {{ config("hijri.months.{$event->hijri_month}") }} ({{ config("hijri.months_bn.{$event->hijri_month}") }})
                                </span>
                            </td>
                            <td class="px-5 py-4 text-xs text-slate-300">
                                {{ $event->gregorian_date ? $event->gregorian_date->format('d M Y') : '—' }}
                            </td>
                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $event->status ? 'bg-emerald-950/80 text-emerald-300 border border-emerald-700/50' : 'bg-red-950/80 text-red-300 border border-red-700/50' }}">
                                    {{ $event->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.islamic-events.edit', $event) }}" class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-xs font-medium text-slate-200 transition">
                                        এডিট
                                    </a>

                                    <form method="POST" action="{{ route('admin.islamic-events.destroy', $event) }}" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই দিবসটি মুছে ফেলতে চান?');" class="inline">
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
                                কোনো ইসলামিক দিবস পাওয়া যায়নি।
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($events->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $events->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
