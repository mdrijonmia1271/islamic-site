<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Ayah;
use App\Models\Bookmark;
use App\Models\Dua;
use App\Models\Hadith;
use App\Models\Surah;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the user's bookmarks.
     */
    public function index(Request $request): View
    {
        $user = $request->user() ?: auth()->user();
        $type = $request->input('type', 'all');

        $bookmarksQuery = $user->bookmarks()->with('bookmarkable')->latest();

        if ($type !== 'all') {
            $modelClass = match ($type) {
                'article' => Article::class,
                'dua' => Dua::class,
                'hadith' => Hadith::class,
                'ayah' => Ayah::class,
                default => null,
            };

            if ($modelClass) {
                $bookmarksQuery->where('bookmarkable_type', $modelClass);
            }
        }

        $bookmarks = $bookmarksQuery->paginate(12)->withQueryString();

        $counts = [
            'all' => $user->bookmarks()->count(),
            'article' => $user->bookmarks()->where('bookmarkable_type', Article::class)->count(),
            'dua' => $user->bookmarks()->where('bookmarkable_type', Dua::class)->count(),
            'hadith' => $user->bookmarks()->where('bookmarkable_type', Hadith::class)->count(),
            'ayah' => $user->bookmarks()->where('bookmarkable_type', Ayah::class)->count(),
        ];

        return view('bookmarks.index', compact('bookmarks', 'counts', 'type'));
    }

    /**
     * Store a newly created bookmark in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:article,dua,hadith,ayah,surah,quran',
            'id' => 'required|integer',
        ]);

        $modelClass = match ($validated['type']) {
            'article' => Article::class,
            'dua' => Dua::class,
            'hadith' => Hadith::class,
            'ayah', 'quran' => Ayah::class,
            'surah' => Surah::class,
        };

        $model = $modelClass::findOrFail($validated['id']);

        $bookmark = Bookmark::firstOrCreate([
            'user_id' => auth()->id(),
            'bookmarkable_type' => $modelClass,
            'bookmarkable_id' => $model->id,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'is_bookmarked' => true,
                'message' => 'বুকমার্ক সংরক্ষণ করা হয়েছে (Bookmarked).',
            ]);
        }

        return back()->with('success', 'বুকমার্ক সংরক্ষণ করা হয়েছে (Bookmarked successfully).');
    }

    /**
     * Remove the specified bookmark from storage.
     */
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:article,dua,hadith,ayah,surah,quran',
            'id' => 'required|integer',
        ]);

        $modelClass = match ($validated['type']) {
            'article' => Article::class,
            'dua' => Dua::class,
            'hadith' => Hadith::class,
            'ayah', 'quran' => Ayah::class,
            'surah' => Surah::class,
        };

        Bookmark::where('user_id', auth()->id())
            ->where('bookmarkable_type', $modelClass)
            ->where('bookmarkable_id', $validated['id'])
            ->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'is_bookmarked' => false,
                'message' => 'বুকমার্ক মুছে ফেলা হয়েছে।',
            ]);
        }

        return back()->with('success', 'বুকমার্ক মুছে ফেলা হয়েছে (Bookmark removed).');
    }
}
