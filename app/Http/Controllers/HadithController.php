<?php

namespace App\Http\Controllers;

use App\Models\HadithBook;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HadithController extends Controller
{
    /**
     * Display a listing of all Hadith books.
     */
    public function index(): View
    {
        $books = HadithBook::where('status', true)
            ->withCount('hadiths')
            ->get();

        return view('hadith.index', compact('books'));
    }

    /**
     * Display the specified Hadith book along with its chapters and hadiths.
     */
    public function show($hadithBook): View
    {
        if (! ($hadithBook instanceof HadithBook)) {
            $hadithBook = HadithBook::where('slug', $hadithBook)
                ->orWhere('id', $hadithBook)
                ->firstOrFail();
        }

        $hadithBook->load(['chapters' => function ($query) {
            $query->orderBy('chapter_number', 'asc');
        }, 'hadiths']);

        return view('hadith.show', compact('hadithBook'));
    }
}
