<?php

namespace Database\Seeders;

use App\Models\Ayah;
use App\Models\Surah;
use Illuminate\Database\Seeder;

class AyahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Surah Al-Fatihah Ayahs (Surah #1)
        $fatihah = Surah::where('number', 1)->first();
        if ($fatihah) {
            $fatihahAyahs = [
                [
                    'ayah_number' => 1,
                    'arabic_text' => 'بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ',
                    'bangla_text' => 'শুরু করছি আল্লাহর নামে যিনি পরম করুণাময়, অতি দয়ালু।',
                ],
                [
                    'ayah_number' => 2,
                    'arabic_text' => 'ٱلْحَمْدُ لِلَّهِ رَبِّ ٱلْعَٰلَمِينَ',
                    'bangla_text' => 'যাবতীয় প্রশংসা জগৎসমূহের প্রতিপালক আল্লাহর জন্য।',
                ],
                [
                    'ayah_number' => 3,
                    'arabic_text' => 'ٱلرَّحْمَٰنِ ٱلرَّحِيمِ',
                    'bangla_text' => 'যিনি পরম করুণাময় ও অতি দয়ালু।',
                ],
                [
                    'ayah_number' => 4,
                    'arabic_text' => 'مَٰلِكِ يَوْمِ ٱلدِّينِ',
                    'bangla_text' => 'প্রতিদান দিবসের মালিক।',
                ],
                [
                    'ayah_number' => 5,
                    'arabic_text' => 'إِيَّاكَ نَعْبُدُ وَإِيَّاكَ نَسْتَعِينُ',
                    'bangla_text' => 'আমরা কেবল আপনারই ইবাদত করি এবং কেবল আপনারই সাহায্য প্রার্থনা করি।',
                ],
                [
                    'ayah_number' => 6,
                    'arabic_text' => 'ٱهْدِنَا ٱلصِّرَٰطَ ٱلْمُسْتَقِيمَ',
                    'bangla_text' => 'আমাদেরকে সরল সঠিক পথ প্রদর্শন করুন।',
                ],
                [
                    'ayah_number' => 7,
                    'arabic_text' => 'صِرَٰطَ ٱلَّذِينَ أَنْعَمْتَ عَلَيْهِمْ غَيْرِ ٱلْمَغْضُوبِ عَلَيْهِمْ وَلَا ٱلضَّآلِّينَ',
                    'bangla_text' => 'তাদের পথ, যাদের আপনি অনুগ্রহ দান করেছেন; তাদের পথ নয় যারা ক্রোধে নিপতিত ও পথভ্রষ্ট হয়েছে।',
                ],
            ];

            foreach ($fatihahAyahs as $ayahData) {
                Ayah::updateOrCreate(
                    [
                        'surah_id' => $fatihah->id,
                        'ayah_number' => $ayahData['ayah_number'],
                    ],
                    $ayahData
                );
            }
        }

        // 2. Seed Surah Al-Ikhlas Ayahs (Surah #112)
        $ikhlas = Surah::where('number', 112)->first();
        if ($ikhlas) {
            $ikhlasAyahs = [
                [
                    'ayah_number' => 1,
                    'arabic_text' => 'قُلْ هُوَ ٱللَّهُ أَحَدٌ',
                    'bangla_text' => 'বলুন, তিনিই আল্লাহ, একক ও অদ্বিতীয়।',
                ],
                [
                    'ayah_number' => 2,
                    'arabic_text' => 'ٱللَّهُ ٱلصَّمَدُ',
                    'bangla_text' => 'আল্লাহ অমুখাপেক্ষী (সকলের ভরসা)।',
                ],
                [
                    'ayah_number' => 3,
                    'arabic_text' => 'لَمْ يَلِدْ وَلَمْ يُولَدْ',
                    'bangla_text' => 'তিনি কাউকে জন্ম দেননি এবং তিনিও কারো থেকে জন্ম নেননি।',
                ],
                [
                    'ayah_number' => 4,
                    'arabic_text' => 'وَلَمْ يَكُن لَّهُۥ كُفُوًا أَحَدٌۢ',
                    'bangla_text' => 'এবং তাঁর সমতুল্য কেউই নেই।',
                ],
            ];

            foreach ($ikhlasAyahs as $ayahData) {
                Ayah::updateOrCreate(
                    [
                        'surah_id' => $ikhlas->id,
                        'ayah_number' => $ayahData['ayah_number'],
                    ],
                    $ayahData
                );
            }
        }
    }
}
