<?php

namespace App\Services;

use Carbon\Carbon;

class PrayerTimeService
{
    /**
     * Determine the next upcoming prayer for the given day's prayer times.
     */
    public function getNextPrayer($prayerTime): ?array
    {
        if (! $prayerTime) {
            return null;
        }

        $prayers = [
            'Fajr' => $prayerTime->fajr,
            'Sunrise' => $prayerTime->sunrise,
            'Dhuhr' => $prayerTime->dhuhr,
            'Asr' => $prayerTime->asr,
            'Maghrib' => $prayerTime->maghrib,
            'Isha' => $prayerTime->isha,
        ];

        $now = now();
        $dateStr = $prayerTime->date instanceof Carbon 
            ? $prayerTime->date->format('Y-m-d') 
            : (is_string($prayerTime->date) ? substr($prayerTime->date, 0, 10) : now()->format('Y-m-d'));

        foreach ($prayers as $name => $time) {
            if (! $time) {
                continue;
            }

            $timeStr = is_string($time) ? $time : (is_object($time) ? $time->format('H:i:s') : (string) $time);
            $prayerDateTime = Carbon::parse($dateStr . ' ' . $timeStr);

            if ($prayerDateTime->greaterThan($now)) {
                return [
                    'name' => $name,
                    'name_bangla' => match($name) {
                        'Fajr' => 'ফজর (Fajr)',
                        'Sunrise' => 'সূর্যোদয় (Sunrise)',
                        'Dhuhr' => 'যোহর (Dhuhr)',
                        'Asr' => 'আসর (Asr)',
                        'Maghrib' => 'মাগরিব (Maghrib)',
                        'Isha' => 'ইশা (Isha)',
                        default => $name
                    },
                    'time' => $prayerDateTime,
                ];
            }
        }

        // If all prayers today passed, return tomorrow's Fajr as next prayer
        if (! empty($prayers['Fajr'])) {
            $fajrStr = is_string($prayers['Fajr']) ? $prayers['Fajr'] : (is_object($prayers['Fajr']) ? $prayers['Fajr']->format('H:i:s') : (string) $prayers['Fajr']);
            return [
                'name' => 'Fajr',
                'name_bangla' => 'ফজর (Fajr - আগামীকাল)',
                'time' => Carbon::parse($dateStr . ' ' . $fajrStr)->addDay(),
            ];
        }

        return null;
    }
}
