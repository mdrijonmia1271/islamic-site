<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dua;
use App\Models\DuaCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Dua::with('category');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('title_bangla', 'like', "%{$search}%")
                  ->orWhere('arabic_text', 'like', "%{$search}%")
                  ->orWhere('bangla_meaning', 'like', "%{$search}%");
            });
        }

        if ($categoryId = $request->input('category_id')) {
            $query->where('dua_category_id', $categoryId);
        }

        $duas = $query->orderBy('sort_order', 'asc')->paginate(20)->withQueryString();
        $categories = DuaCategory::orderBy('sort_order')->get();

        return view('admin.duas.index', compact('duas', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = DuaCategory::where('status', true)
            ->orderBy('sort_order')
            ->get();

        return view('admin.duas.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'dua_category_id' => 'required|exists:dua_categories,id',
            'title' => 'required|string|max:255',
            'title_bangla' => 'nullable|string|max:255',
            'arabic_text' => 'required|string',
            'transliteration' => 'nullable|string',
            'bangla_meaning' => 'nullable|string',
            'english_meaning' => 'nullable|string',
            'reference' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'audio_url' => 'nullable|url|max:2048',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        Dua::create($validated);

        return redirect()
            ->route('admin.duas.index')
            ->with('success', 'দোয়া সফলভাবে সংরক্ষণ করা হয়েছে!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dua $dua): View
    {
        $categories = DuaCategory::where('status', true)
            ->orderBy('sort_order')
            ->get();

        return view('admin.duas.edit', compact('dua', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dua $dua): RedirectResponse
    {
        $validated = $request->validate([
            'dua_category_id' => 'required|exists:dua_categories,id',
            'title' => 'required|string|max:255',
            'title_bangla' => 'nullable|string|max:255',
            'arabic_text' => 'required|string',
            'transliteration' => 'nullable|string',
            'bangla_meaning' => 'nullable|string',
            'english_meaning' => 'nullable|string',
            'reference' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'audio_url' => 'nullable|url|max:2048',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $dua->update($validated);

        return redirect()
            ->route('admin.duas.index')
            ->with('success', 'দোয়া সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dua $dua): RedirectResponse
    {
        $dua->delete();

        return redirect()
            ->route('admin.duas.index')
            ->with('success', 'দোয়া সফলভাবে মুছে ফেলা হয়েছে!');
    }
}
