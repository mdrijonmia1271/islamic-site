<?php

namespace App\Http\Controllers;

use App\Models\Surah;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuranController extends Controller
{
    /**
     * Display a listing of all Surahs.
     */
    public function index(Request $request): View
    {
        $query = Surah::query()->withCount('ayahs');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name_bangla', 'like', "%{$search}%")
                  ->orWhere('name_english', 'like', "%{$search}%")
                  ->orWhere('name_arabic', 'like', "%{$search}%")
                  ->orWhere('number', $search);
            });
        }

        if ($place = $request->input('place')) {
            $query->where('revelation_place', $place);
        }

        $surahs = $query->orderBy('number', 'asc')->get();

        $totalSurahs = Surah::count();
        $makkiCount = Surah::where('revelation_place', 'Makkah')->count();
        $madaniCount = Surah::where('revelation_place', 'Madinah')->count();

        return view('quran.index', compact(
            'surahs',
            'totalSurahs',
            'makkiCount',
            'madaniCount'
        ));
    }

    /**
     * Display the specified Surah along with its Ayahs.
     */
    public function show($surah): View
    {
        if (! ($surah instanceof Surah)) {
            $surah = Surah::where('number', $surah)
                ->orWhere('id', $surah)
                ->firstOrFail();
        }

        $surah->load(['ayahs' => function ($query) {
            $query->orderBy('ayah_number', 'asc');
        }]);

        $prevSurah = Surah::where('number', '<', $surah->number)->orderBy('number', 'desc')->first();
        $nextSurah = Surah::where('number', '>', $surah->number)->orderBy('number', 'asc')->first();

        $allSurahs = Surah::orderBy('number', 'asc')->get(['id', 'number', 'name_bangla', 'name_english']);

        return view('quran.show', compact('surah', 'prevSurah', 'nextSurah', 'allSurahs'));
    }
}
