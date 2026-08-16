<?php

namespace App\Http\Controllers;

use App\Models\IslamicEvent;
use App\Services\HijriDateService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IslamicCalendarController extends Controller
{
    /**
     * Display the Islamic Calendar, current Hijri conversion, and special events.
     */
    public function index(Request $request, HijriDateService $hijriDateService): View
    {
        $date = Carbon::parse(
            $request->input('date', now()->toDateString())
        );

        $hijri = $hijriDateService->convert($date);

        $events = IslamicEvent::where('status', true)
            ->whereDate('gregorian_date', $date)
            ->get();

        $allEvents = IslamicEvent::where('status', true)
            ->orderBy('hijri_month', 'asc')
            ->orderBy('hijri_day', 'asc')
            ->get();

        return view(
            'islamic-calendar.index',
            compact('date', 'hijri', 'events', 'allEvents')
        );
    }
}
