<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of published articles.
     */
    public function index(Request $request): View
    {
        $query = Article::with('category')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at');

        $currentCategory = null;
        if ($request->filled('category')) {
            $currentCategory = ArticleCategory::where('slug', $request->get('category'))->first();
            if ($currentCategory) {
                $query->where('article_category_id', $currentCategory->id);
            }
        }

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $articles = $query->paginate(12)->withQueryString();

        $categories = ArticleCategory::where('status', true)
            ->withCount(['articles' => function ($q) {
                $q->where('status', 'published')
                  ->whereNotNull('published_at')
                  ->where('published_at', '<=', now());
            }])
            ->orderBy('sort_order')
            ->get();

        $featuredArticle = null;
        if (!$request->filled('page') || $request->get('page') == 1) {
            if (!$request->filled('category') && !$request->filled('search')) {
                $featuredArticle = $articles->first();
            }
        }

        return view('articles.index', compact('articles', 'categories', 'currentCategory', 'featuredArticle'));
    }

    /**
     * Display the specified article with full SEO.
     */
    public function show(Article $article): View
    {
        abort_if($article->status !== 'published', 404);
        abort_if($article->published_at && $article->published_at->isFuture(), 404);

        $article->increment('views');

        // Related articles from same category or general
        $relatedArticles = Article::with('category')
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->when($article->article_category_id, function ($q) use ($article) {
                $q->where('article_category_id', $article->article_category_id);
            })
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
