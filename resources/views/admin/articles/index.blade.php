@extends('layouts.admin')

@section('title', 'প্রবন্ধ ও ব্লগ ব্যবস্থাপনা (Articles & SEO CMS)')

@section('content')
<div class="space-y-6">

    <!-- Top Action Bar & Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-white">ইসলামিক প্রবন্ধ ও গাইডলাইন (Articles)</h2>
            <p class="text-xs text-slate-400 mt-0.5">রমজান, যাকাত, নামাজ, দোয়া ও ইসলামিক ইতিহাসের আর্টিকেল ও এসইও (SEO) মেটা পরিচালনা করুন</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white text-sm font-semibold shadow-md shadow-emerald-900/40 transition">
                <span>+</span>
                <span>নতুন আর্টিকেল লিখুন</span>
            </a>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 flex flex-col md:flex-row gap-4 justify-between items-center">
        <form method="GET" action="{{ route('admin.articles.index') }}" class="w-full flex flex-wrap items-center gap-3">
            <!-- Search -->
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="শিরোনাম বা কীওয়ার্ড দিয়ে খুঁজুন..." 
                       class="w-full px-4 py-2 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 placeholder-slate-500">
            </div>

            <!-- Category Filter -->
            <div class="w-full sm:w-auto min-w-[180px]">
                <select name="category_id" class="w-full px-4 py-2 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                    <option value="">সব ক্যাটাগরি (All Categories)</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                            {{ $category->name_bangla ?? $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status Filter -->
            <div class="w-full sm:w-auto min-w-[140px]">
                <select name="status" class="w-full px-4 py-2 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                    <option value="">সব স্ট্যাটাস</option>
                    <option value="published" @selected(request('status') === 'published')>Published</option>
                    <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                </select>
            </div>

            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-sm font-semibold transition">
                ফিল্টার
            </button>

            @if(request()->hasAny(['search', 'category_id', 'status']))
                <a href="{{ route('admin.articles.index') }}" class="px-3 py-2 text-xs text-slate-400 hover:text-white transition">
                    রিসেট
                </a>
            @endif
        </form>
    </div>

    <!-- Articles Table -->
    <div class="rounded-3xl bg-slate-950 border border-slate-800 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="text-xs uppercase bg-slate-900/90 text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="px-5 py-3.5">আর্টিকেল ও শিরোনাম</th>
                        <th class="px-5 py-3.5">ক্যাটাগরি</th>
                        <th class="px-5 py-3.5">স্ট্যাটাস</th>
                        <th class="px-5 py-3.5">ভিউ সংখ্যা</th>
                        <th class="px-5 py-3.5">প্রকাশের তারিখ</th>
                        <th class="px-5 py-3.5 text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/80">
                    @forelse ($articles as $article)
                        <tr class="hover:bg-slate-900/50 transition">
                            <td class="px-5 py-4">
                                <div class="flex items-start gap-3">
                                    @if($article->featured_image)
                                        <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-12 h-12 object-cover rounded-xl border border-slate-700 flex-shrink-0">
                                    @else
                                        <div class="w-12 h-12 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-600 text-lg flex-shrink-0">
                                            📄
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <div class="font-bold text-white line-clamp-1 hover:text-emerald-400 transition">
                                            {{ $article->title }}
                                        </div>
                                        <div class="text-xs text-slate-500 font-mono mt-0.5 flex items-center gap-2">
                                            <span>/articles/{{ $article->slug }}</span>
                                            @if($article->meta_title || $article->meta_description)
                                                <span class="text-[10px] px-1.5 py-0.2 rounded bg-emerald-950 text-emerald-400 border border-emerald-800/40">SEO Ready</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                @if($article->category)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-950/80 text-emerald-300 border border-emerald-800/50">
                                        {{ $article->category->name_bangla ?? $article->category->name }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-500">সাধারণ</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                @if($article->status === 'published')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-950/80 text-emerald-300 border border-emerald-700/50">
                                        Published
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-950/80 text-amber-300 border border-amber-700/50">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-xs font-mono text-slate-300">
                                👁️ {{ number_format($article->views) }}
                            </td>
                            <td class="px-5 py-4 text-xs text-slate-400">
                                {{ $article->published_at ? $article->published_at->format('d M, Y') : '—' }}
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-xs font-medium text-slate-200 transition">
                                        এডিট
                                    </a>

                                    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই আর্টিকেলটি মুছে ফেলতে চান?');" class="inline">
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
                                কোনো আর্টিকেল পাওয়া যায়নি।
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($articles->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $articles->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
