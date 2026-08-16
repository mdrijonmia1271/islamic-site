<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HadithBook;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class HadithBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $books = HadithBook::latest()->paginate(20);

        return view('admin.hadith-books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.hadith-books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_bangla' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:hadith_books,slug',
        ]);

        $validated['slug'] = $validated['slug']
            ?: Str::slug($validated['name']);

        HadithBook::create($validated);

        return redirect()
            ->route('admin.hadith-books.index')
            ->with('success', 'হাদিস গ্রন্থ সফলভাবে যুক্ত করা হয়েছে!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HadithBook $hadithBook): View
    {
        return view('admin.hadith-books.edit', compact('hadithBook'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HadithBook $hadithBook): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_bangla' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:hadith_books,slug,' . $hadithBook->id,
            'status' => 'nullable|boolean',
        ]);

        $hadithBook->update($validated);

        return redirect()
            ->route('admin.hadith-books.index')
            ->with('success', 'হাদিস গ্রন্থ সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HadithBook $hadithBook): RedirectResponse
    {
        $hadithBook->delete();

        return redirect()
            ->route('admin.hadith-books.index')
            ->with('success', 'হাদিস গ্রন্থ সফলভাবে মুছে ফেলা হয়েছে!');
    }
}
