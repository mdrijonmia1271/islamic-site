<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Ayah;
use App\Models\Dua;
use App\Models\Hadith;
use App\Models\IslamicEvent;
use App\Models\Surah;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * Perform unified global search across Quran, Hadith, Duas, Articles, and Events.
     */
    public function index(Request $request): View
    {
        $query = trim($request->input('q', $request->input('query', '')));
        $activeTab = $request->input('type', $request->input('tab', 'all'));

        $articles = collect();
        $duas = collect();
        $surahs = collect();
        $ayahs = collect();
        $hadiths = collect();
        $events = collect();

        $counts = [
            'articles' => 0,
            'duas' => 0,
            'surahs' => 0,
            'ayahs' => 0,
            'hadiths' => 0,
            'events' => 0,
            'total' => 0,
        ];

        if ($query !== '') {
            // 1. Articles Search
            $articlesQuery = Article::with('category')
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now())
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('excerpt', 'like', "%{$query}%")
                      ->orWhere('content', 'like', "%{$query}%")
                      ->orWhere('meta_keywords', 'like', "%{$query}%");
                })
                ->latest('published_at');

            $counts['articles'] = (clone $articlesQuery)->count();
            $articles = $articlesQuery->paginate(8, ['*'], 'articles_page')->withQueryString();

            // 2. Duas Search
            $duasQuery = Dua::with('category')
                ->where('status', true)
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('title_bangla', 'like', "%{$query}%")
                      ->orWhere('arabic_text', 'like', "%{$query}%")
                      ->orWhere('bangla_meaning', 'like', "%{$query}%")
                      ->orWhere('transliteration', 'like', "%{$query}%")
                      ->orWhere('reference', 'like', "%{$query}%");
                })
                ->orderBy('sort_order', 'asc');

            $counts['duas'] = (clone $duasQuery)->count();
            $duas = $duasQuery->paginate(8, ['*'], 'duas_page')->withQueryString();

            // 3. Quran Search (Surahs & Ayahs)
            if (class_exists(Surah::class)) {
                $surahs = Surah::where(function ($q) use ($query) {
                    $q->where('name_bangla', 'like', "%{$query}%")
                      ->orWhere('name_english', 'like', "%{$query}%")
                      ->orWhere('name_arabic', 'like', "%{$query}%")
                      ->orWhere('number', $query);
                })->get();
                $counts['surahs'] = $surahs->count();
            }

            if (class_exists(Ayah::class)) {
                $ayahsQuery = Ayah::with('surah')
                    ->where(function ($q) use ($query) {
                        $q->where('bangla_text', 'like', "%{$query}%")
                          ->orWhere('arabic_text', 'like', "%{$query}%");
                    });

                $counts['ayahs'] = (clone $ayahsQuery)->count();
                $ayahs = $ayahsQuery->paginate(6, ['*'], 'ayahs_page')->withQueryString();
            }

            // 4. Hadith Search
            if (class_exists(Hadith::class)) {
                $hadithsQuery = Hadith::with(['book', 'chapter'])
                    ->where('status', true)
                    ->where(function ($q) use ($query) {
                        $q->where('bangla_text', 'like', "%{$query}%")
                          ->orWhere('english_text', 'like', "%{$query}%")
                          ->orWhere('arabic_text', 'like', "%{$query}%")
                          ->orWhere('narrator', 'like', "%{$query}%")
                          ->orWhere('reference', 'like', "%{$query}%")
                          ->orWhere('hadith_number', $query);
                    });

                $counts['hadiths'] = (clone $hadithsQuery)->count();
                $hadiths = $hadithsQuery->paginate(6, ['*'], 'hadiths_page')->withQueryString();
            }

            // 5. Events Search
            if (class_exists(IslamicEvent::class)) {
                $events = IslamicEvent::where('status', true)
                    ->where(function ($q) use ($query) {
                        $q->where('title', 'like', "%{$query}%")
                          ->orWhere('title_bangla', 'like', "%{$query}%")
                          ->orWhere('description', 'like', "%{$query}%");
                    })
                    ->get();
                $counts['events'] = $events->count();
            }

            $counts['total'] = $counts['articles'] + $counts['duas'] + $counts['surahs'] + $counts['ayahs'] + $counts['hadiths'] + $counts['events'];
        }

        return view('search.index', compact(
            'query',
            'activeTab',
            'articles',
            'duas',
            'surahs',
            'ayahs',
            'hadiths',
            'events',
            'counts'
        ));
    }

    /**
     * Return instant search suggestions as JSON (STEP 12).
     */
    public function suggestions(Request $request)
    {
        $query = trim($request->input('q', ''));

        if (mb_strlen($query) < 2) {
            return response()->json([]);
        }

        $results = [];

        // Articles suggestions
        $articles = Article::where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where('title', 'like', "%{$query}%")
            ->limit(4)
            ->get(['id', 'title', 'slug']);

        foreach ($articles as $article) {
            $results[] = [
                'type' => 'আর্টিকেল',
                'icon' => '✍️',
                'title' => $article->title,
                'url' => route('articles.show', $article),
            ];
        }

        // Duas suggestions
        $duas = Dua::where('status', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('title_bangla', 'like', "%{$query}%");
            })
            ->with('category')
            ->limit(3)
            ->get();

        foreach ($duas as $dua) {
            $results[] = [
                'type' => 'দোয়া',
                'icon' => '🤲',
                'title' => $dua->title_bangla ?? $dua->title,
                'url' => $dua->category ? route('duas.category', $dua->category) : route('duas.index'),
            ];
        }

        // Surahs suggestions
        $surahs = Surah::where(function ($q) use ($query) {
            $q->where('name_bangla', 'like', "%{$query}%")
              ->orWhere('name_english', 'like', "%{$query}%")
              ->orWhere('number', $query);
        })
        ->limit(2)
        ->get();

        foreach ($surahs as $surah) {
            $results[] = [
                'type' => 'সূরা',
                'icon' => '📖',
                'title' => ($surah->name_bangla ?? $surah->name_english) . " (সূরা নং {$surah->number})",
                'url' => route('quran.show', $surah->number),
            ];
        }

        return response()->json($results);
    }
}
