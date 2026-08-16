<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IslamicEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class IslamicEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $events = IslamicEvent::orderBy('hijri_month')
            ->orderBy('hijri_day')
            ->paginate(20);

        return view('admin.islamic-events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.islamic-events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_bangla' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'hijri_month' => 'required|integer|between:1,12',
            'hijri_day' => 'required|integer|between:1,30',
            'hijri_year' => 'nullable|integer|min:1',
            'gregorian_date' => 'nullable|date',
            'slug' => 'nullable|string|max:255|unique:islamic_events,slug',
        ]);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);

        IslamicEvent::create($validated);

        return redirect()
            ->route('admin.islamic-events.index')
            ->with('success', 'Islamic event created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IslamicEvent $islamicEvent): View
    {
        return view('admin.islamic-events.edit', compact('islamicEvent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IslamicEvent $islamicEvent): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_bangla' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'hijri_month' => 'required|integer|between:1,12',
            'hijri_day' => 'required|integer|between:1,30',
            'hijri_year' => 'nullable|integer|min:1',
            'gregorian_date' => 'nullable|date',
            'slug' => 'required|string|max:255|unique:islamic_events,slug,' . $islamicEvent->id,
            'status' => 'nullable|boolean',
        ]);

        $islamicEvent->update($validated);

        return redirect()
            ->route('admin.islamic-events.index')
            ->with('success', 'Islamic event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IslamicEvent $islamicEvent): RedirectResponse
    {
        $islamicEvent->delete();

        return redirect()
            ->route('admin.islamic-events.index')
            ->with('success', 'Islamic event deleted successfully.');
    }
}
