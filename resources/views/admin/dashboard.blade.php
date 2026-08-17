@extends('layouts.admin')

@section('title', 'ড্যাশবোর্ড ওভারভিউ (Dashboard Overview)')

@section('content')
<div class="space-y-8">
    
    <!-- Welcome Banner -->
    <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-emerald-900 via-teal-900 to-slate-950 border border-emerald-800/40 text-white relative overflow-hidden shadow-xl">
        <div class="relative z-10 max-w-2xl">
            <span class="text-xs font-semibold uppercase tracking-widest text-amber-300 bg-amber-950/60 px-3 py-1 rounded-full border border-amber-500/30">
                Islamic Site Control Panel
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold mt-3 mb-2">
                আসসালামু আলাইকুম, {{ Auth::user()->name }}! 👋
            </h2>
            <p class="text-emerald-200 text-sm sm:text-base leading-relaxed">
                ইসলামিক সাইটের কন্টেন্ট ম্যানেজমেন্ট সিস্টেম ও এডমিন কন্ট্রোল সেন্টারে স্বাগতম। এখান থেকে আপনি কুরআন, হাদিস, দোয়া ও অন্যান্য বিষয় নিয়ন্ত্রণ করতে পারবেন।
            </p>
        </div>
        <div class="absolute -right-6 -bottom-6 text-8xl opacity-10 pointer-events-none">
            🕋
        </div>
    </div>

    <!-- 4 Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Stat 1: Surahs -->
        <div class="p-5 rounded-2xl bg-slate-950 border border-slate-800 flex items-center justify-between shadow-sm hover:border-emerald-500/40 transition">
            <div>
                <span class="text-xs text-slate-400 font-medium">মোট সূরা (Surahs)</span>
                <div class="text-3xl font-extrabold text-white mt-1">{{ $totalSurahs }} <span class="text-xs text-slate-500 font-normal">/ ১১৪</span></div>
                <a href="{{ route('admin.surahs.index') }}" class="text-xs text-emerald-400 font-semibold hover:underline mt-2 inline-block">
                    সূরা তালিকা &rarr;
                </a>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-950 text-emerald-400 flex items-center justify-center text-2xl">
                📖
            </div>
        </div>

        <!-- Stat 2: Total Ayahs -->
        <div class="p-5 rounded-2xl bg-slate-950 border border-slate-800 flex items-center justify-between shadow-sm hover:border-teal-500/40 transition">
            <div>
                <span class="text-xs text-slate-400 font-medium">নিবন্ধিত মোট আয়াত</span>
                <div class="text-3xl font-extrabold text-teal-400 mt-1">{{ number_format($totalAyahs) }}</div>
                <span class="text-xs text-slate-500 mt-2 block">আয়াত সংখ্যা</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-teal-950 text-teal-400 flex items-center justify-center text-2xl">
                ✨
            </div>
        </div>

        <!-- Stat 3: Total Users -->
        <div class="p-5 rounded-2xl bg-slate-950 border border-slate-800 flex items-center justify-between shadow-sm hover:border-amber-500/40 transition">
            <div>
                <span class="text-xs text-slate-400 font-medium">মোট ব্যবহারকারী (Users)</span>
                <div class="text-3xl font-extrabold text-amber-400 mt-1">{{ $totalUsers }}</div>
                <span class="text-xs text-slate-500 mt-2 block">নিবন্ধিত ইউজার</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-950 text-amber-400 flex items-center justify-center text-2xl">
                👥
            </div>
        </div>

        <!-- Stat 4: Admins -->
        <div class="p-5 rounded-2xl bg-slate-950 border border-slate-800 flex items-center justify-between shadow-sm hover:border-purple-500/40 transition">
            <div>
                <span class="text-xs text-slate-400 font-medium">এডমিন সংখ্যা (Admins)</span>
                <div class="text-3xl font-extrabold text-purple-400 mt-1">{{ $totalAdmins }}</div>
                <span class="text-xs text-slate-500 mt-2 block">পূর্ণ অ্যাক্সেস</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-purple-950 text-purple-400 flex items-center justify-center text-2xl">
                🛡️
            </div>
        </div>
    </div>

    <!-- Quick Action / CMS Shortcuts -->
    <div>
        <h3 class="text-base font-bold text-white mb-4">দ্রুত কন্টেন্ট ম্যানেজমেন্ট (Quick Actions)</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="{{ route('admin.surahs.create') }}" class="p-4 rounded-2xl bg-emerald-950/40 hover:bg-emerald-900/60 border border-emerald-700/50 flex items-center gap-3 text-emerald-200 transition group">
                <span class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-xl group-hover:scale-110 transition-transform">+</span>
                <div>
                    <div class="font-bold text-white text-sm">নতুন সূরা যোগ করুন</div>
                    <div class="text-xs text-emerald-400/80">কুরআন CMS মডিউল</div>
                </div>
            </a>

            <a href="{{ route('admin.surahs.index') }}" class="p-4 rounded-2xl bg-slate-950 hover:bg-slate-800/80 border border-slate-800 flex items-center gap-3 text-slate-300 transition group">
                <span class="w-10 h-10 rounded-xl bg-teal-600 text-white flex items-center justify-center text-xl group-hover:scale-110 transition-transform">📋</span>
                <div>
                    <div class="font-bold text-white text-sm">সূরা তালিকা দেখুন</div>
                    <div class="text-xs text-slate-400">এডিট বা পরিবর্তন করুন</div>
                </div>
            </a>

            <a href="{{ route('admin.articles.create') }}" class="p-4 rounded-2xl bg-slate-950 hover:bg-slate-800/80 border border-slate-800 flex items-center gap-3 text-slate-300 transition group">
                <span class="w-10 h-10 rounded-xl bg-purple-600 text-white flex items-center justify-center text-xl group-hover:scale-110 transition-transform">✍️</span>
                <div>
                    <div class="font-bold text-white text-sm">নতুন আর্টিকেল লিখুন</div>
                    <div class="text-xs text-purple-400">ব্লগ ও এসইও (SEO) কন্টেন্ট</div>
                </div>
            </a>

            <a href="{{ url('/') }}" target="_blank" class="p-4 rounded-2xl bg-slate-950 hover:bg-slate-800/80 border border-slate-800 flex items-center gap-3 text-slate-300 transition group">
                <span class="w-10 h-10 rounded-xl bg-amber-600 text-white flex items-center justify-center text-xl group-hover:scale-110 transition-transform">🌐</span>
                <div>
                    <div class="font-bold text-white text-sm">লাইভ সাইট ভিজিট</div>
                    <div class="text-xs text-slate-400">ফ্রন্টএন্ড প্রিভিউ দেখুন</div>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Surahs Table Overview -->
    <div class="p-6 rounded-3xl bg-slate-950 border border-slate-800">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-base font-bold text-white">সম্প্রতি ডেটাবেজে যুক্ত সূরাসমূহ</h3>
                <p class="text-xs text-slate-400 mt-0.5">প্রথম CMS মডিউলের প্রাথমিক রেকর্ডসমূহ</p>
            </div>
            <a href="{{ route('admin.surahs.index') }}" class="text-xs font-semibold text-emerald-400 hover:underline">
                সকল সূরা দেখুন &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="text-xs uppercase bg-slate-900/80 text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="px-4 py-3">নং</th>
                        <th class="px-4 py-3">আরবি নাম</th>
                        <th class="px-4 py-3">বাংলা নাম</th>
                        <th class="px-4 py-3">ইংরেজি নাম</th>
                        <th class="px-4 py-3">অবতীর্ণ</th>
                        <th class="px-4 py-3">মোট আয়াত</th>
                        <th class="px-4 py-3 text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse ($recentSurahs as $surah)
                        <tr class="hover:bg-slate-900/50 transition">
                            <td class="px-4 py-3.5 font-bold text-emerald-400">{{ $surah->number }}</td>
                            <td class="px-4 py-3.5 text-lg font-normal text-amber-300" style="font-family: 'Amiri', serif;">{{ $surah->name_arabic }}</td>
                            <td class="px-4 py-3.5 font-semibold text-white">{{ $surah->name_bangla }}</td>
                            <td class="px-4 py-3.5 text-slate-400">{{ $surah->name_english }}</td>
                            <td class="px-4 py-3.5">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $surah->revelation_place === 'Makkah' ? 'bg-amber-950/60 text-amber-300 border border-amber-800/50' : 'bg-teal-950/60 text-teal-300 border border-teal-800/50' }}">
                                    {{ $surah->revelation_place === 'Makkah' ? 'মাক্কী' : 'মাদানী' }}
                                </span>
                            </td>
                            <td class="px-4 py-3.5 font-medium text-white">{{ $surah->ayah_count }}</td>
                            <td class="px-4 py-3.5 text-right">
                                <a href="{{ route('admin.surahs.edit', $surah) }}" class="px-3 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 text-xs text-slate-200 transition">
                                    এডিট
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-slate-500">কোনো সূরা পাওয়া যায়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
