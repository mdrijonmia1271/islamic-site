<?php

namespace App\Http\Controllers;

use App\Models\DuaCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DuaController extends Controller
{
    /**
     * Display a listing of all Dua categories.
     */
    public function index(): View
    {
        $categories = DuaCategory::where('status', true)
            ->withCount('duas')
            ->orderBy('sort_order')
            ->get();

        return view('duas.index', compact('categories'));
    }

    /**
     * Display the specified Dua category along with its Duas.
     */
    public function category($duaCategory): View
    {
        if (! ($duaCategory instanceof DuaCategory)) {
            $duaCategory = DuaCategory::where('slug', $duaCategory)
                ->orWhere('id', $duaCategory)
                ->firstOrFail();
        }

        $duas = $duaCategory->duas()
            ->where('status', true)
            ->orderBy('sort_order')
            ->get();

        return view('duas.category', compact('duaCategory', 'duas'));
    }
}
