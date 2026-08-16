<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SurahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Surah::query();

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

        $surahs = $query->orderBy('number', 'asc')->paginate(15)->withQueryString();

        return view('admin.surahs.index', compact('surahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $nextNumber = (Surah::max('number') ?? 0) + 1;

        return view('admin.surahs.create', compact('nextNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'number' => 'required|integer|min:1|max:114|unique:surahs,number',
            'name_arabic' => 'required|string|max:100',
            'name_english' => 'required|string|max:100',
            'name_bangla' => 'required|string|max:100',
            'revelation_place' => 'nullable|string|max:50',
            'ayah_count' => 'required|integer|min:1',
        ]);

        Surah::create($validated);

        return redirect()->route('admin.surahs.index')
            ->with('success', 'নতুন সূরা সফলভাবে ডাটাবেজে যুক্ত করা হয়েছে!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Surah $surah): View
    {
        return view('admin.surahs.edit', compact('surah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Surah $surah): RedirectResponse
    {
        $validated = $request->validate([
            'number' => 'required|integer|min:1|max:114|unique:surahs,number,' . $surah->id,
            'name_arabic' => 'required|string|max:100',
            'name_english' => 'required|string|max:100',
            'name_bangla' => 'required|string|max:100',
            'revelation_place' => 'nullable|string|max:50',
            'ayah_count' => 'required|integer|min:1',
        ]);

        $surah->update($validated);

        return redirect()->route('admin.surahs.index')
            ->with('success', 'সূরা সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Surah $surah): RedirectResponse
    {
        $surah->delete();

        return redirect()->route('admin.surahs.index')
            ->with('success', 'সূরা সফলভাবে মুছে ফেলা হয়েছে!');
    }
}
