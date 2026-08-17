@extends('layouts.admin')

@section('title', 'আর্টিকেল সম্পাদনা করুন (Edit Article)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white">আর্টিকেল এডিট করুন</h2>
            <p class="text-xs text-slate-400 mt-0.5">{{ $article->title }}</p>
        </div>
        <a href="{{ route('admin.articles.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white transition">
            &larr; আর্টিকেল তালিকায় ফিরে যান
        </a>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 1. Basic Content Card -->
        <div class="p-6 sm:p-8 rounded-3xl bg-slate-950 border border-slate-800 shadow-xl space-y-6">
            <h3 class="text-base font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-3">
                <span>📝</span> মৌলিক তথ্য ও কন্টেন্ট
            </h3>

            <!-- Title -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">আর্টিকেলের শিরোনাম (Title) *</label>
                <input type="text" name="title" value="{{ old('title', $article->title) }}" required
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('title') border-red-500 @enderror">
                @error('title')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Slug & Category -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">ক্যাটাগরি (Category)</label>
                    <select name="article_category_id" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                        <option value="">ক্যাটাগরি সিলেক্ট করুন (ঐচ্ছিক)</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('article_category_id', $article->article_category_id) == $category->id)>
                                {{ $category->name_bangla ?? $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('article_category_id')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">ইউআরএল স্লাগ (Slug) *</label>
                    <input type="text" name="slug" value="{{ old('slug', $article->slug) }}" required
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500 @error('slug') border-red-500 @enderror">
                    @error('slug')
                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Excerpt -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">সংক্ষিপ্ত সারাংশ (Excerpt / Short Summary)</label>
                <textarea name="excerpt" rows="2"
                          class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">{{ old('excerpt', $article->excerpt) }}</textarea>
                @error('excerpt')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Content -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">সম্পূর্ণ আর্টিকেল কন্টেন্ট (Full Content / HTML) *</label>
                <textarea name="content" rows="12" required
                          class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white font-mono leading-relaxed focus:outline-none focus:border-emerald-500 @error('content') border-red-500 @enderror">{{ old('content', $article->content) }}</textarea>
                @error('content')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Featured Image -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">ফিচারড ছবি (Featured Image)</label>
                @if($article->featured_image)
                    <div class="mb-3 flex items-center gap-4 p-3 rounded-2xl bg-slate-900 border border-slate-800">
                        <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-20 h-20 object-cover rounded-xl border border-slate-700">
                        <div>
                            <p class="text-xs text-white font-semibold">বর্তমান ছবি সংযুক্ত রয়েছে</p>
                            <p class="text-[11px] text-slate-400">নতুন ছবি আপলোড করলে পুরনো ছবিটি প্রতিস্থাপিত হবে।</p>
                        </div>
                    </div>
                @endif
                <input type="file" name="featured_image" accept="image/*"
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-slate-300 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-600 file:text-white hover:file:bg-emerald-500">
                @error('featured_image')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- 2. SEO Meta Settings Card -->
        <div class="p-6 sm:p-8 rounded-3xl bg-slate-950 border border-slate-800 shadow-xl space-y-6">
            <div class="border-b border-slate-800 pb-3 flex items-center justify-between">
                <h3 class="text-base font-bold text-emerald-400 flex items-center gap-2">
                    <span>🔍</span> সার্চ ইঞ্জিন অপটিমাইজেশন (SEO Settings)
                </h3>
                <span class="text-[11px] text-slate-400">গুগল ও সোশ্যালের জন্য মেটা ট্যাগ</span>
            </div>

            <!-- Meta Title -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">Meta Title (গুগল সার্চে প্রদর্শিত শিরোনাম)</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $article->meta_title) }}"
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                @error('meta_title')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Meta Description -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">Meta Description (গুগলে সার্চ রেজাল্টের নিচের বিবরণ)</label>
                <textarea name="meta_description" rows="3"
                          class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">{{ old('meta_description', $article->meta_description) }}</textarea>
                @error('meta_description')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Meta Keywords & Canonical URL -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $article->meta_keywords) }}"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">Canonical URL</label>
                    <input type="url" name="canonical_url" value="{{ old('canonical_url', $article->canonical_url) }}"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                </div>
            </div>
        </div>

        <!-- 3. Publishing Settings Card -->
        <div class="p-6 sm:p-8 rounded-3xl bg-slate-950 border border-slate-800 shadow-xl space-y-6">
            <h3 class="text-base font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-3">
                <span>🚀</span> পাবলিশিং ও স্থিতি (Publishing Options)
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">স্ট্যাটাস (Status) *</label>
                    <select name="status" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                        <option value="published" @selected(old('status', $article->status) === 'published')>Published</option>
                        <option value="draft" @selected(old('status', $article->status) === 'draft')>Draft</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">প্রকাশের তারিখ ও সময় (Published At)</label>
                    <input type="datetime-local" name="published_at" 
                           value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-sm text-white focus:outline-none focus:border-emerald-500">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 border-t border-slate-800 flex items-center justify-between">
                <a href="{{ route('admin.articles.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-sm font-semibold transition">
                    বাতিল করুন
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white text-sm font-semibold shadow-md shadow-emerald-900/40 transition">
                    💾 পরিবর্তন সংরক্ষণ করুন (Update Article)
                </button>
            </div>
        </div>
    </form>

</div>
@endsection
