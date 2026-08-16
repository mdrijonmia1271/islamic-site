<?php

namespace App\Http\Controllers;

use App\Models\Ayah;
use App\Models\Surah;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuranController extends Controller
{
    /**
     * Display a listing of all Surahs and handle Quran Search.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $surahs = Surah::orderBy('number')->get();

        $results = collect();

        if ($search) {
            $results = Ayah::with('surah')
                ->where('arabic_text', 'like', "%{$search}%")
                ->orWhere('bangla_text', 'like', "%{$search}%")
                ->get();
        }

        return view('quran.index', compact(
            'surahs',
            'results',
            'search'
        ));
    }

    /**
     * Display the specified Surah along with its Ayahs, previous & next Surahs, and Surah list.
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

        $previousSurah = Surah::where('number', '<', $surah->number)
            ->orderBy('number', 'desc')
            ->first();

        $nextSurah = Surah::where('number', '>', $surah->number)
            ->orderBy('number')
            ->first();

        $allSurahs = Surah::orderBy('number', 'asc')->get();

        return view('quran.show', compact(
            'surah',
            'previousSurah',
            'nextSurah',
            'allSurahs'
        ));
    }
}
