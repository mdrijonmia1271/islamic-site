<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ayah;
use App\Models\Surah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AyahController extends Controller
{
    /**
     * Display a listing of the ayahs for a given surah.
     */
    public function index(Surah $surah): View
    {
        $surah->load(['ayahs' => function ($query) {
            $query->orderBy('ayah_number', 'asc');
        }]);

        $nextAyahNumber = ($surah->ayahs()->max('ayah_number') ?? 0) + 1;

        return view('admin.surahs.ayahs', compact('surah', 'nextAyahNumber'));
    }

    /**
     * Store a newly created ayah in storage.
     */
    public function store(Request $request, Surah $surah): RedirectResponse
    {
        $validated = $request->validate([
            'ayah_number' => 'required|integer|min:1|unique:ayahs,ayah_number,NULL,id,surah_id,' . $surah->id,
            'arabic_text' => 'required|string',
            'bangla_text' => 'nullable|string',
        ]);

        $surah->ayahs()->create($validated);

        return redirect()->route('admin.surahs.ayahs.index', $surah)
            ->with('success', 'নতুন আয়াত সফলভাবে যুক্ত করা হয়েছে!');
    }

    /**
     * Show the form for editing the specified ayah.
     */
    public function edit(Surah $surah, Ayah $ayah): View
    {
        return view('admin.surahs.edit_ayah', compact('surah', 'ayah'));
    }

    /**
     * Update the specified ayah in storage.
     */
    public function update(Request $request, Surah $surah, Ayah $ayah): RedirectResponse
    {
        $validated = $request->validate([
            'ayah_number' => 'required|integer|min:1|unique:ayahs,ayah_number,' . $ayah->id . ',id,surah_id,' . $surah->id,
            'arabic_text' => 'required|string',
            'bangla_text' => 'nullable|string',
        ]);

        $ayah->update($validated);

        return redirect()->route('admin.surahs.ayahs.index', $surah)
            ->with('success', 'আয়াত সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Remove the specified ayah from storage.
     */
    public function destroy(Surah $surah, Ayah $ayah): RedirectResponse
    {
        $ayah->delete();

        return redirect()->route('admin.surahs.ayahs.index', $surah)
            ->with('success', 'আয়াত সফলভাবে মুছে ফেলা হয়েছে!');
    }
}
