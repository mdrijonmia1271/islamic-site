@extends('layouts.app')

@section('title', $article->meta_title ?: ($article->title . ' — Islamic Site'))
@section('meta_description', $article->meta_description ?: Str::limit(strip_tags($article->excerpt ?: $article->content), 160))
@section('canonical', $article->canonical_url ?: route('articles.show', $article))
@section('og_type', 'article')

@if($article->featured_image)
    @section('og_image', asset('storage/' . $article->featured_image))
@endif

@if($article->meta_keywords)
    @section('meta_keywords', $article->meta_keywords)
@endif

@section('meta')
    @if($article->published_at)
        <meta property="article:published_time" content="{{ $article->published_at->toIso8601String() }}">
    @endif
    @if($article->category)
        <meta property="article:section" content="{{ $article->category->name }}">
    @endif

    <!-- Schema.org JSON-LD Structured Data for Google Rich Results -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Article",
        "headline": {{ json_encode($article->title) }},
        "description": {{ json_encode($article->meta_description ?: Str::limit(strip_tags($article->excerpt ?: $article->content), 160)) }},
        @if($article->featured_image)
        "image": [
            "{{ asset('storage/' . $article->featured_image) }}"
        ],
        @endif
        "datePublished": "{{ $article->published_at ? $article->published_at->toIso8601String() : $article->created_at->toIso8601String() }}",
        "dateModified": "{{ $article->updated_at->toIso8601String() }}",
        "mainEntityOfPage": {
            "@@type": "WebPage",
            "@@id": "{{ url('/articles/' . $article->slug) }}"
        },
        "publisher": {
            "@@type": "Organization",
            "name": "{{ config('app.name', 'Islamic Site') }}",
            "logo": {
                "@@type": "ImageObject",
                "url": "{{ asset('favicon.ico') }}"
            }
        }
    }
    </script>
@endsection

@section('content')
    <!-- Article Header & Breadcrumbs -->
    <div class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-4 overflow-x-auto whitespace-nowrap">
                <a href="{{ url('/') }}" class="hover:text-emerald-600 dark:hover:text-emerald-400">হোম</a>
                <span>&rsaquo;</span>
                <a href="{{ route('articles.index') }}" class="hover:text-emerald-600 dark:hover:text-emerald-400">প্রবন্ধসমূহ</a>
                @if($article->category)
                    <span>&rsaquo;</span>
                    <a href="{{ route('articles.index', ['category' => $article->category->slug]) }}" class="hover:text-emerald-600 dark:hover:text-emerald-400 font-medium">
                        {{ $article->category->name_bangla ?? $article->category->name }}
                    </a>
                @endif
                <span>&rsaquo;</span>
                <span class="text-gray-800 dark:text-gray-200 font-semibold truncate max-w-[200px] sm:max-w-xs">{{ $article->title }}</span>
            </nav>

            <!-- Category, Date Badge & Favorite Button (STEP 11) -->
            <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                <div class="flex flex-wrap items-center gap-3">
                    @if($article->category)
                        <a href="{{ route('articles.index', ['category' => $article->category->slug]) }}" 
                           class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/60 hover:bg-emerald-200 transition">
                            🏷️ {{ $article->category->name_bangla ?? $article->category->name }}
                        </a>
                    @endif

                    @if($article->published_at)
                        <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                            <span>🗓️</span> {{ $article->published_at->format('d F, Y') }}
                        </span>
                    @endif

                    @if($article->views > 0)
                        <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1 font-mono">
                            <span>👁️</span> {{ number_format($article->views) }} ভিউ
                        </span>
                    @endif
                </div>

                <!-- Favorite Button -->
                <div>
                    @auth
                        @php
                            $isFavorite = $article->favorites()->where('user_id', auth()->id())->exists();
                        @endphp

                        @if($isFavorite)
                            <form method="POST" action="{{ route('favorites.destroy') }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="type" value="article">
                                <input type="hidden" name="id" value="{{ $article->id }}">
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-red-50 dark:bg-red-950/60 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800 hover:bg-red-100 dark:hover:bg-red-900/60 text-xs font-bold transition shadow-sm">
                                    <span>❤️</span>
                                    <span>সংরক্ষিত (Saved)</span>
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.store') }}" class="inline">
                                @csrf
                                <input type="hidden" name="type" value="article">
                                <input type="hidden" name="id" value="{{ $article->id }}">
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700 hover:text-red-600 dark:hover:text-red-400 hover:border-red-300 transition text-xs font-semibold shadow-sm">
                                    <span>🤍</span>
                                    <span>পছন্দের তালিকায় রাখুন</span>
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:text-emerald-600 text-xs font-medium transition shadow-sm" title="লগইন করে প্রিয় তালিকাভুক্ত করুন">
                            <span>🤍</span>
                            <span>সেভ করতে লগইন করুন</span>
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Main Title -->
            <h1 class="text-2xl sm:text-4xl font-extrabold text-gray-900 dark:text-white leading-tight sm:leading-snug mb-4">
                {{ $article->title }}
            </h1>

            <!-- Excerpt / Subheading -->
            @if($article->excerpt)
                <p class="text-base sm:text-lg text-gray-600 dark:text-gray-300 leading-relaxed font-medium bg-slate-50 dark:bg-gray-800/40 p-4 sm:p-5 rounded-2xl border-l-4 border-emerald-500">
                    {{ $article->excerpt }}
                </p>
            @endif
        </div>
    </div>

    <!-- Article Content Area -->
    <div class="py-10 bg-slate-50 dark:bg-gray-950">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <article class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm p-6 sm:p-10 space-y-8">

                <!-- Featured Image -->
                @if($article->featured_image)
                    <div class="rounded-2xl overflow-hidden shadow-md">
                        <img src="{{ asset('storage/' . $article->featured_image) }}" 
                             alt="{{ $article->title }}" 
                             class="w-full h-auto max-h-[480px] object-cover">
                    </div>
                @endif

                <!-- Article Body (Formatted HTML) -->
                <div class="article-content space-y-4 text-gray-800 dark:text-gray-200 text-base sm:text-lg leading-relaxed sm:leading-loose">
                    <style>
                        .article-content h2, .article-content h3, .article-content h4 {
                            font-weight: 700;
                            color: #059669;
                            margin-top: 1.75rem;
                            margin-bottom: 0.75rem;
                        }
                        .dark .article-content h2, .dark .article-content h3, .dark .article-content h4 {
                            color: #34d399;
                        }
                        .article-content h2 { font-size: 1.5rem; border-bottom: 1px solid rgba(16,185,129,0.2); padding-bottom: 0.5rem; }
                        .article-content h3 { font-size: 1.25rem; }
                        .article-content p { margin-bottom: 1rem; }
                        .article-content ul, .article-content ol { margin-left: 1.5rem; margin-bottom: 1.25rem; }
                        .article-content ul { list-style-type: disc; }
                        .article-content ol { list-style-type: decimal; }
                        .article-content li { margin-bottom: 0.5rem; }
                        .article-content blockquote {
                            border-left: 4px solid #10b981;
                            padding-left: 1rem;
                            font-style: italic;
                            color: #047857;
                            background: rgba(16,185,129,0.05);
                            padding-top: 0.5rem;
                            padding-bottom: 0.5rem;
                            border-radius: 0 0.5rem 0.5rem 0;
                            margin: 1.5rem 0;
                        }
                        .dark .article-content blockquote {
                            color: #6ee7b7;
                            background: rgba(16,185,129,0.1);
                        }
                    </style>

                    {!! $article->content !!}
                </div>

                <!-- Social Share & Tags Section -->
                <div class="pt-8 border-t border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold text-gray-500 dark:text-gray-400">শেয়ার করুন:</span>
                        <!-- Facebook Share -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                           target="_blank" rel="noopener" 
                           class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center text-sm hover:opacity-90 transition">
                            f
                        </a>
                        <!-- Twitter / X Share -->
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}" 
                           target="_blank" rel="noopener" 
                           class="w-9 h-9 rounded-xl bg-gray-900 dark:bg-gray-800 text-white flex items-center justify-center text-sm hover:opacity-90 transition">
                            𝕏
                        </a>
                        <!-- WhatsApp Share -->
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' ' . url()->current()) }}" 
                           target="_blank" rel="noopener" 
                           class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-sm hover:opacity-90 transition">
                            📱
                        </a>
                    </div>

                    <button onclick="navigator.clipboard.writeText(window.location.href); alert('আর্টিকেলের লিঙ্ক কপি করা হয়েছে!');" 
                            class="px-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 text-gray-700 dark:text-gray-300 text-xs font-semibold flex items-center gap-2 transition">
                        <span>🔗</span> লিঙ্ক কপি করুন
                    </button>
                </div>

            </article>

            <!-- Related Articles -->
            @if($relatedArticles->count() > 0)
                <div class="mt-12 space-y-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">সম্পর্কিত আরও প্রবন্ধ</h3>
                        <a href="{{ route('articles.index') }}" class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline">
                            সকল আর্টিকেল দেখুন &rarr;
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach ($relatedArticles as $related)
                            <a href="{{ route('articles.show', $related) }}" 
                               class="p-5 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-lg hover:border-emerald-500/40 hover:-translate-y-1 transition duration-200 group flex flex-col justify-between">
                                <div class="space-y-2">
                                    @if($related->category)
                                        <span class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400">
                                            {{ $related->category->name_bangla ?? $related->category->name }}
                                        </span>
                                    @endif
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-2">
                                        {{ $related->title }}
                                    </h4>
                                </div>
                                <span class="text-xs text-slate-400 mt-4 block">
                                    {{ $related->published_at ? $related->published_at->format('d M, Y') : '' }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
