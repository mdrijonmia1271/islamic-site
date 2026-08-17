<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Islamic Knowledge',
                'name_bangla' => 'ইসলামিক জ্ঞান ও আকীদা',
                'slug' => 'islamic-knowledge',
                'description' => 'মৌলিক ইসলামিক বিশ্বাস, ঈমান ও জ্ঞান সংক্রান্ত প্রবন্ধ ও প্রশ্নোত্তর।',
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Quran',
                'name_bangla' => 'আল-কোরআন ও তাফসীর',
                'slug' => 'quran',
                'description' => 'পবিত্র কোরআনের বিভিন্ন সূরা, আয়াত এবং তার তাফসীর ও শিক্ষা।',
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Hadith',
                'name_bangla' => 'হাদিস ও সুন্নাহ',
                'slug' => 'hadith',
                'description' => 'রাসূলুল্লাহ (সা.)-এর সুন্নাহ, সহীহ হাদিস ও হাদিসের ব্যাখ্যা।',
                'status' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Salah',
                'name_bangla' => 'নামাজ ও সালাত নির্দেশিকা',
                'slug' => 'salah',
                'description' => 'ফরজ, সুন্নত ও নফল নামাজের নিয়ম, মাসআলা এবং ফজিলত।',
                'status' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Dua & Azkar',
                'name_bangla' => 'দোয়া ও জিকির',
                'slug' => 'dua-azkar',
                'description' => 'দৈনন্দিন মাসনূন দোয়া, জিকির ও ফজিলতপূর্ণ আমল।',
                'status' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Ramadan',
                'name_bangla' => 'রমজান ও রোজা',
                'slug' => 'ramadan',
                'description' => 'মাহে রমজান, রোজার মাসআলা, সেহরি-ইফতার এবং লাইলাতুল কদরের আমল।',
                'status' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Zakat',
                'name_bangla' => 'যাকাত ও সদকা',
                'slug' => 'zakat',
                'description' => 'যাকাতের নিসাব, হিসাব পদ্ধতি এবং সাদাকাহ সংক্রান্ত বিস্তারিত আলোচনা।',
                'status' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Hajj & Umrah',
                'name_bangla' => 'হজ ও ওমরাহ',
                'slug' => 'hajj-umrah',
                'description' => 'পবিত্র হজ ও ওমরাহ পালনের ধারাবাহিক নিয়মাবলী ও দিকনির্দেশনা।',
                'status' => true,
                'sort_order' => 8,
            ],
            [
                'name' => 'Islamic History',
                'name_bangla' => 'ইসলামের ইতিহাস ও ঐতিহ্য',
                'slug' => 'islamic-history',
                'description' => 'নবী-রাসূল, সাহাবায়ে কেরামের জীবনী এবং ইসলামের স্বর্ণযুগের গৌরবময় ইতিহাস।',
                'status' => true,
                'sort_order' => 9,
            ],
            [
                'name' => 'Islamic Lifestyle',
                'name_bangla' => 'ইসলামিক জীবনধারা ও আদব',
                'slug' => 'islamic-lifestyle',
                'description' => 'দৈনন্দিন পারিবারিক ও সামাজিক জীবনে ইসলামি শিষ্টাচার ও অনুশাসন।',
                'status' => true,
                'sort_order' => 10,
            ],
        ];

        foreach ($categories as $category) {
            ArticleCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
