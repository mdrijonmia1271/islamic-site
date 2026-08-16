<?php

namespace Database\Seeders;

use App\Models\PrayerTime;
use Illuminate\Database\Seeder;

class PrayerTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $today = now()->toDateString();

        $citiesData = [
            [
                'city' => 'Dhaka',
                'country' => 'Bangladesh',
                'date' => $today,
                'fajr' => '04:12',
                'sunrise' => '05:30',
                'dhuhr' => '12:05',
                'asr' => '16:35',
                'maghrib' => '18:32',
                'isha' => '19:48',
            ],
            [
                'city' => 'Chittagong',
                'country' => 'Bangladesh',
                'date' => $today,
                'fajr' => '04:08',
                'sunrise' => '05:26',
                'dhuhr' => '12:00',
                'asr' => '16:30',
                'maghrib' => '18:28',
                'isha' => '19:44',
            ],
            [
                'city' => 'Sylhet',
                'country' => 'Bangladesh',
                'date' => $today,
                'fajr' => '04:04',
                'sunrise' => '05:23',
                'dhuhr' => '11:58',
                'asr' => '16:31',
                'maghrib' => '18:27',
                'isha' => '19:45',
            ],
            [
                'city' => 'Rajshahi',
                'country' => 'Bangladesh',
                'date' => $today,
                'fajr' => '04:18',
                'sunrise' => '05:37',
                'dhuhr' => '12:11',
                'asr' => '16:42',
                'maghrib' => '18:38',
                'isha' => '19:54',
            ],
            [
                'city' => 'Khulna',
                'country' => 'Bangladesh',
                'date' => $today,
                'fajr' => '04:16',
                'sunrise' => '05:34',
                'dhuhr' => '12:08',
                'asr' => '16:37',
                'maghrib' => '18:35',
                'isha' => '19:50',
            ],
            [
                'city' => 'Makkah',
                'country' => 'Saudi Arabia',
                'date' => $today,
                'fajr' => '04:42',
                'sunrise' => '06:01',
                'dhuhr' => '12:26',
                'asr' => '15:47',
                'maghrib' => '18:51',
                'isha' => '20:21',
            ],
            [
                'city' => 'Madinah',
                'country' => 'Saudi Arabia',
                'date' => $today,
                'fajr' => '04:40',
                'sunrise' => '06:02',
                'dhuhr' => '12:27',
                'asr' => '15:52',
                'maghrib' => '18:53',
                'isha' => '20:23',
            ],
        ];

        foreach ($citiesData as $cityRow) {
            PrayerTime::updateOrCreate(
                [
                    'city' => $cityRow['city'],
                    'country' => $cityRow['country'],
                    'date' => $cityRow['date'],
                ],
                $cityRow
            );
        }
    }
}
