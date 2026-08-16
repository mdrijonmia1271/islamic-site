<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DuaCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DuaCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = DuaCategory::orderBy('sort_order')
            ->withCount('duas')
            ->paginate(20);

        return view('admin.dua-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.dua-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_bangla' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:dua_categories,slug',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = $validated['slug']
            ?: Str::slug($validated['name']);

        DuaCategory::create($validated);

        return redirect()
            ->route('admin.dua-categories.index')
            ->with('success', 'দোয়া ক্যাটাগরি সফলভাবে তৈরি করা হয়েছে!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DuaCategory $duaCategory): View
    {
        return view('admin.dua-categories.edit', compact('duaCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DuaCategory $duaCategory): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_bangla' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:dua_categories,slug,' . $duaCategory->id,
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $duaCategory->update($validated);

        return redirect()
            ->route('admin.dua-categories.index')
            ->with('success', 'দোয়া ক্যাটাগরি সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DuaCategory $duaCategory): RedirectResponse
    {
        $duaCategory->delete();

        return redirect()
            ->route('admin.dua-categories.index')
            ->with('success', 'দোয়া ক্যাটাগরি সফলভাবে মুছে ফেলা হয়েছে!');
    }
}
