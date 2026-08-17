<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Ayah;
use App\Models\Dua;
use App\Models\Favorite;
use App\Models\Hadith;
use App\Models\Surah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the user's favorites.
     */
    public function index(Request $request): View
    {
        $user = $request->user() ?: auth()->user();
        $type = $request->input('type', 'all');

        $favoritesQuery = $user->favorites()->with('favoritable')->latest();

        if ($type !== 'all') {
            $modelClass = match ($type) {
                'article' => Article::class,
                'dua' => Dua::class,
                'hadith' => Hadith::class,
                'ayah' => Ayah::class,
                default => null,
            };

            if ($modelClass) {
                $favoritesQuery->where('favoritable_type', $modelClass);
            }
        }

        $favorites = $favoritesQuery->paginate(12)->withQueryString();

        $counts = [
            'all' => $user->favorites()->count(),
            'article' => $user->favorites()->where('favoritable_type', Article::class)->count(),
            'dua' => $user->favorites()->where('favoritable_type', Dua::class)->count(),
            'hadith' => $user->favorites()->where('favoritable_type', Hadith::class)->count(),
            'ayah' => $user->favorites()->where('favoritable_type', Ayah::class)->count(),
        ];

        return view('account.favorites', compact('favorites', 'counts', 'type'));
    }

    /**
     * Store a newly created favorite in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:article,dua,hadith,ayah,surah',
            'id' => 'required|integer',
        ]);

        $modelClass = match ($validated['type']) {
            'article' => Article::class,
            'dua' => Dua::class,
            'hadith' => Hadith::class,
            'ayah' => Ayah::class,
            'surah' => Surah::class,
        };

        $model = $modelClass::findOrFail($validated['id']);

        $favorite = Favorite::firstOrCreate([
            'user_id' => auth()->id(),
            'favoritable_type' => $modelClass,
            'favoritable_id' => $model->id,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'is_favorite' => true,
                'message' => 'পছন্দের তালিকায় যুক্ত হয়েছে।',
            ]);
        }

        return back()->with('success', 'পছন্দের তালিকায় যুক্ত হয়েছে (Added to favorites).');
    }

    /**
     * Remove the specified favorite from storage.
     */
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:article,dua,hadith,ayah,surah',
            'id' => 'required|integer',
        ]);

        $modelClass = match ($validated['type']) {
            'article' => Article::class,
            'dua' => Dua::class,
            'hadith' => Hadith::class,
            'ayah' => Ayah::class,
            'surah' => Surah::class,
        };

        Favorite::where('user_id', auth()->id())
            ->where('favoritable_type', $modelClass)
            ->where('favoritable_id', $validated['id'])
            ->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'is_favorite' => false,
                'message' => 'পছন্দের তালিকা থেকে সরানো হয়েছে।',
            ]);
        }

        return back()->with('success', 'পছন্দের তালিকা থেকে সরানো হয়েছে (Removed from favorites).');
    }
}
