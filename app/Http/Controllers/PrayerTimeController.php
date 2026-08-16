<?php

namespace App\Http\Controllers;

use App\Models\PrayerTime;
use App\Services\PrayerTimeService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PrayerTimeController extends Controller
{
    /**
     * Display daily prayer times for the selected city along with the next prayer.
     */
    public function index(Request $request, PrayerTimeService $prayerTimeService): View
    {
        $city = $request->input('city', 'Dhaka');
        $date = now()->toDateString();

        $prayerTime = PrayerTime::where('city', $city)
            ->where('date', $date)
            ->first();

        // Fallback demo data if today's city data not in database
        if (! $prayerTime) {
            $prayerTime = (object) [
                'city' => $city,
                'country' => 'Bangladesh',
                'date' => now(),
                'fajr' => '04:12:00',
                'sunrise' => '05:30:00',
                'dhuhr' => '12:05:00',
                'asr' => '16:35:00',
                'maghrib' => '18:32:00',
                'isha' => '19:48:00',
            ];
        }

        $nextPrayer = $prayerTimeService->getNextPrayer($prayerTime);

        return view(
            'prayer-times.index',
            compact('prayerTime', 'city', 'date', 'nextPrayer')
        );
    }
}
