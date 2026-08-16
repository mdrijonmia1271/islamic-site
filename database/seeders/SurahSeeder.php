<?php

namespace Database\Seeders;

use App\Models\Surah;
use Illuminate\Database\Seeder;

class SurahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $surahs = [
            [
                'number' => 1,
                'name_arabic' => 'الفاتحة',
                'name_english' => 'Al-Fatihah',
                'name_bangla' => 'আল-ফাতিহা',
                'revelation_place' => 'Makkah',
                'ayah_count' => 7,
            ],
            [
                'number' => 2,
                'name_arabic' => 'البقرة',
                'name_english' => 'Al-Baqarah',
                'name_bangla' => 'আল-বাকারাহ',
                'revelation_place' => 'Madinah',
                'ayah_count' => 286,
            ],
            [
                'number' => 3,
                'name_arabic' => 'آل عمران',
                'name_english' => 'Ali \'Imran',
                'name_bangla' => 'আলে-ইমরান',
                'revelation_place' => 'Madinah',
                'ayah_count' => 200,
            ],
            [
                'number' => 4,
                'name_arabic' => 'النساء',
                'name_english' => 'An-Nisa',
                'name_bangla' => 'আন-নিসা',
                'revelation_place' => 'Madinah',
                'ayah_count' => 176,
            ],
            [
                'number' => 5,
                'name_arabic' => 'المائدة',
                'name_english' => 'Al-Ma\'idah',
                'name_bangla' => 'আল-মায়িদাহ',
                'revelation_place' => 'Madinah',
                'ayah_count' => 120,
            ],
            [
                'number' => 36,
                'name_arabic' => 'يس',
                'name_english' => 'Ya-Sin',
                'name_bangla' => 'ইয়াসীন',
                'revelation_place' => 'Makkah',
                'ayah_count' => 83,
            ],
            [
                'number' => 55,
                'name_arabic' => 'الرحمن',
                'name_english' => 'Ar-Rahman',
                'name_bangla' => 'আর-রহমান',
                'revelation_place' => 'Madinah',
                'ayah_count' => 78,
            ],
            [
                'number' => 67,
                'name_arabic' => 'الملك',
                'name_english' => 'Al-Mulk',
                'name_bangla' => 'আল-মুলক',
                'revelation_place' => 'Makkah',
                'ayah_count' => 30,
            ],
            [
                'number' => 112,
                'name_arabic' => 'الإخلاص',
                'name_english' => 'Al-Ikhlas',
                'name_bangla' => 'আল-ইখলাস',
                'revelation_place' => 'Makkah',
                'ayah_count' => 4,
            ],
            [
                'number' => 113,
                'name_arabic' => 'الفلق',
                'name_english' => 'Al-Falaq',
                'name_bangla' => 'আল-ফালাক',
                'revelation_place' => 'Makkah',
                'ayah_count' => 5,
            ],
            [
                'number' => 114,
                'name_arabic' => 'الناس',
                'name_english' => 'An-Nas',
                'name_bangla' => 'আন-নাস',
                'revelation_place' => 'Makkah',
                'ayah_count' => 6,
            ],
        ];

        foreach ($surahs as $surah) {
            Surah::updateOrCreate(
                ['number' => $surah['number']],
                $surah
            );
        }
    }
}
