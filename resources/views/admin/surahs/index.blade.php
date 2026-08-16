@extends('layouts.admin')

@section('title', 'সূরা ব্যবস্থাপনা (Surahs CMS)')

@section('content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-white">পবিত্র কুরআনের সূরা তালিকা</h2>
            <p class="text-xs text-slate-400 mt-0.5">কুরআন মডিউলের জন্য সূরা তৈরি, পরিবর্তন ও পরিচালনা করুন</p>
        </div>

        <a href="{{ route('admin.surahs.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white text-sm font-semibold shadow-md shadow-emerald-900/40 transition">
            <span>+</span>
            <span>নতুন সূরা যোগ করুন</span>
        </a>
    </div>

    <!-- Filters & Search -->
    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800">
        <form method="GET" action="{{ route('admin.surahs.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <!-- Search Keyword -->
            <div class="relative sm:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="সূরার নাম (বাংলা, ইংরেজি, আরবি) বা নম্বর দিয়ে খুঁজুন..." 
                       class="w-full pl-10 pr-4 py-2 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500">
                <div class="absolute left-3 top-2.5 text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Revelation Place Filter -->
            <div class="flex gap-2">
                <select name="place" class="flex-1 px-3 py-2 rounded-xl bg-slate-900 border border-slate-700 text-sm text-slate-300 focus:outline-none focus:border-emerald-500">
                    <option value="">সকল অবতীর্ণ স্থান</option>
                    <option value="Makkah" {{ request('place') === 'Makkah' ? 'selected' : '' }}>মাক্কী (Makkah)</option>
                    <option value="Madinah" {{ request('place') === 'Madinah' ? 'selected' : '' }}>মাদানী (Madinah)</option>
                </select>

                <button type="submit" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold transition">
                    ফিল্টার
                </button>
                @if (request()->hasAny(['search', 'place']))
                    <a href="{{ route('admin.surahs.index') }}" class="px-3 py-2 rounded-xl bg-red-950/60 hover:bg-red-900/80 text-red-300 text-xs font-semibold flex items-center">
                        রিসেট
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Surah Table -->
    <div class="rounded-3xl bg-slate-950 border border-slate-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="text-xs uppercase bg-slate-900/90 text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="px-4 py-3.5">নং</th>
                        <th class="px-4 py-3.5">আরবি নাম</th>
                        <th class="px-4 py-3.5">বাংলা নাম</th>
                        <th class="px-4 py-3.5">ইংরেজি নাম</th>
                        <th class="px-4 py-3.5">অবতীর্ণের স্থান</th>
                        <th class="px-4 py-3.5">মোট আয়াত</th>
                        <th class="px-4 py-3.5 text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/80">
                    @forelse ($surahs as $surah)
                        <tr class="hover:bg-slate-900/50 transition">
                            <td class="px-4 py-4 font-bold text-emerald-400">#{{ $surah->number }}</td>
                            <td class="px-4 py-4 text-xl font-normal text-amber-300" style="font-family: 'Amiri', serif;">
                                {{ $surah->name_arabic }}
                            </td>
                            <td class="px-4 py-4 font-bold text-white">{{ $surah->name_bangla }}</td>
                            <td class="px-4 py-4 text-slate-400">{{ $surah->name_english }}</td>
                            <td class="px-4 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $surah->revelation_place === 'Makkah' ? 'bg-amber-950/60 text-amber-300 border border-amber-800/50' : 'bg-teal-950/60 text-teal-300 border border-teal-800/50' }}">
                                    {{ $surah->revelation_place === 'Makkah' ? 'মাক্কী' : 'মাদানী' }}
                                </span>
                            </td>
                            <td class="px-4 py-4 font-medium text-white">{{ $surah->ayah_count }}</td>
                            <td class="px-4 py-4 text-right">
                                <div class="inline-flex items-center gap-1.5">
                                    <a href="{{ route('admin.surahs.ayahs.index', $surah) }}" class="px-3 py-1.5 rounded-lg bg-emerald-950/80 hover:bg-emerald-900 border border-emerald-700/50 text-xs font-semibold text-emerald-300 transition flex items-center gap-1">
                                        <span>📖</span> আয়াতসমূহ ({{ $surah->ayahs()->count() }})
                                    </a>

                                    <a href="{{ route('admin.surahs.edit', $surah) }}" class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-xs font-medium text-slate-200 transition">
                                        এডিট
                                    </a>

                                    <form method="POST" action="{{ route('admin.surahs.destroy', $surah) }}" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই সূরাটি মুছে ফেলতে চান?');" class="inline">
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
                            <td colspan="7" class="px-4 py-10 text-center text-slate-500">
                                কোনো সূরার রেকর্ড পাওয়া যায়নি।
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        @if ($surahs->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $surahs->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
