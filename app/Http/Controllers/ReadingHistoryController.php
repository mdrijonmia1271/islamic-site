<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Ayah;
use App\Models\Dua;
use App\Models\Hadith;
use App\Models\ReadingHistory;
use App\Models\Surah;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReadingHistoryController extends Controller
{
    /**
     * Display a listing of the user's reading history.
     */
    public function index(Request $request): View
    {
        $user = $request->user() ?: auth()->user();
        $type = $request->input('type', 'all');

        $query = $user->readingHistories()
            ->with('readable')
            ->latest('last_read_at');

        if ($type !== 'all') {
            $modelClass = match ($type) {
                'article' => Article::class,
                'dua' => Dua::class,
                'hadith' => Hadith::class,
                'ayah', 'quran' => Ayah::class,
                'surah' => Surah::class,
                default => null,
            };

            if ($modelClass) {
                $query->where('readable_type', $modelClass);
            }
        }

        $history = $query->paginate(20)->withQueryString();

        $counts = [
            'all' => $user->readingHistories()->count(),
            'article' => $user->readingHistories()->where('readable_type', Article::class)->count(),
            'dua' => $user->readingHistories()->where('readable_type', Dua::class)->count(),
            'hadith' => $user->readingHistories()->where('readable_type', Hadith::class)->count(),
            'ayah' => $user->readingHistories()->where('readable_type', Ayah::class)->count(),
        ];

        return view('history.index', compact('history', 'counts', 'type'));
    }

    /**
     * Store or update a reading history item.
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

        $content = $modelClass::findOrFail($validated['id']);

        $history = auth()->user()->readingHistories()->updateOrCreate(
            [
                'readable_type' => $modelClass,
                'readable_id' => $content->id,
            ],
            [
                'last_read_at' => now(),
            ]
        );

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'history_id' => $history->id,
                'last_read_at' => $history->last_read_at->toDateTimeString(),
            ]);
        }

        return back()->with('success', 'Reading history updated.');
    }

    /**
     * Remove a single reading history record.
     */
    public function destroy($id)
    {
        auth()->user()
            ->readingHistories()
            ->where('id', $id)
            ->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'History item removed.',
            ]);
        }

        return back()->with('success', 'History item removed.');
    }

    /**
     * Clear all reading history records for current user.
     */
    public function clear()
    {
        auth()->user()
            ->readingHistories()
            ->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Reading history cleared.',
            ]);
        }

        return back()->with('success', 'Reading history cleared.');
    }
}
