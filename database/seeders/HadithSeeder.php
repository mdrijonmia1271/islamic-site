<?php

namespace Database\Seeders;

use App\Models\Hadith;
use App\Models\HadithBook;
use App\Models\HadithChapter;
use Illuminate\Database\Seeder;

class HadithSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Sahih al-Bukhari
        $bukhari = HadithBook::updateOrCreate(
            ['slug' => 'bukhari'],
            [
                'name' => 'Sahih al-Bukhari',
                'name_bangla' => 'সহীহ বুখারী',
                'author' => 'ইমাম বুখারী (র.)',
                'description' => 'আল-কুরআনের পর সর্বাধিক বিশুদ্ধ ও প্রামাণ্য হাদিস সংকলন।',
                'status' => true,
            ]
        );

        $bukhariCh1 = HadithChapter::updateOrCreate(
            [
                'hadith_book_id' => $bukhari->id,
                'chapter_number' => 1,
            ],
            [
                'name' => 'Revelation',
                'name_bangla' => 'ওহীর সূচনা অধ্যায়',
                'description' => 'রাসূলুল্লাহ (ﷺ)-এর ওপর ওহী নাযিলের সূচনা ও পদ্ধতি',
            ]
        );

        Hadith::updateOrCreate(
            [
                'hadith_book_id' => $bukhari->id,
                'hadith_number' => 1,
            ],
            [
                'hadith_chapter_id' => $bukhariCh1->id,
                'arabic_text' => 'إِنَّمَا الأَعْمَالُ بِالنِّيَّاتِ، وَإِنَّمَا لِكُلِّ امْرِئٍ مَا نَوَى، فَمَنْ كَانَتْ هِجْرَتُهُ إِلَى دُنْيَا يُصِيبُهَا أَوْ إِلَى امْرَأَةٍ يَنْكِحُهَا فَهِجْرَتُهُ إِلَى مَا هَاجَرَ إِلَيْهِ',
                'bangla_text' => 'নিশ্চয়ই সমস্ত কাজ নিয়তের ওপর নির্ভরশীল এবং প্রত্যেক ব্যক্তি তার নিয়ত অনুযায়ী প্রতিদান পাবে। সুতরাং যার হিজরত দুনিয়া অর্জনের উদ্দেশ্যে অথবা কোনো নারীকে বিবাহ করার উদ্দেশ্যে হবে, তার হিজরত সেই উদ্দেশ্যেই গণ্য হবে যার জন্য সে হিজরত করেছে।',
                'english_text' => 'The reward of deeds depends upon the intentions and every person will get the reward according to what he has intended. So whoever emigrated for worldly benefits or for a woman to marry, his emigration was for what he emigrated for.',
                'narrator' => 'উমর ইবনুল খাত্তাব (রা.)',
                'grade' => 'সহীহ (Sahih)',
                'reference' => 'সহীহ বুখারী: ১',
                'status' => true,
            ]
        );

        // 2. Sahih Muslim
        $muslim = HadithBook::updateOrCreate(
            ['slug' => 'muslim'],
            [
                'name' => 'Sahih Muslim',
                'name_bangla' => 'সহীহ মুসলিম',
                'author' => 'ইমাম মুসলিম (র.)',
                'description' => 'সিহাহ সিত্তাহর অন্যতম শ্রেষ্ঠ ও প্রামাণ্য সংকলন।',
                'status' => true,
            ]
        );

        $muslimCh1 = HadithChapter::updateOrCreate(
            [
                'hadith_book_id' => $muslim->id,
                'chapter_number' => 1,
            ],
            [
                'name' => 'Faith (Kitab Al-Iman)',
                'name_bangla' => 'ঈমান অধ্যায়',
                'description' => 'ইসলাম ও ঈমানের মৌলিক পরিচয় এবং স্তম্ভসমূহ',
            ]
        );

        Hadith::updateOrCreate(
            [
                'hadith_book_id' => $muslim->id,
                'hadith_number' => 1,
            ],
            [
                'hadith_chapter_id' => $muslimCh1->id,
                'arabic_text' => 'بُنِيَ الإِسْلاَمُ عَلَى خَمْسٍ: شَهَادَةِ أَنْ لاَ إِلَهَ إِلاَّ اللَّهُ وَأَنَّ مُحَمَّدًا رَسُولُ اللَّهِ، وَإِقَامِ الصَّلاَةِ، وَإِيتَاءِ الزَّكَاةِ، وَحَجِّ الْبَيْتِ، وَصَوْمِ رَمَضَانَ',
                'bangla_text' => 'ইসলামের ভিত্তি পাঁচটি স্তম্ভের ওপর স্থাপিত: এই সাক্ষ্য দেওয়া যে আল্লাহ ব্যতীত কোনো সত্য উপাস্য নেই এবং মুহাম্মদ (ﷺ) আল্লাহর রাসূল, সালাত কায়েম করা, যাকাত আদায় করা, বাইতুল্লাহর হজ করা এবং রমযানের রোযা রাখা।',
                'english_text' => 'Islam is built on five pillars: testifying that there is no god but Allah and that Muhammad is the Messenger of Allah, performing the prayer, paying the Zakat, making pilgrimage to the House, and fasting during Ramadan.',
                'narrator' => 'আব্দুল্লাহ ইবনে উমর (রা.)',
                'grade' => 'সহীহ (Sahih)',
                'reference' => 'সহীহ মুসলিম: ১৬',
                'status' => true,
            ]
        );
    }
}
