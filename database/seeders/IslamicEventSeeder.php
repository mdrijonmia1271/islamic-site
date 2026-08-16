<?php

namespace Database\Seeders;

use App\Models\IslamicEvent;
use Illuminate\Database\Seeder;

class IslamicEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Islamic New Year',
                'title_bangla' => 'পবিত্র হিজরি নববর্ষ (১লা মহররম)',
                'description' => 'পবিত্র হিজরি সনের প্রথম দিন এবং চার সম্মানিত মাসের অন্যতম।',
                'hijri_month' => 1,
                'hijri_day' => 1,
                'slug' => 'islamic-new-year',
                'status' => true,
            ],
            [
                'title' => 'Day of Ashura',
                'title_bangla' => 'পবিত্র আশুরা (১০ই মহররম)',
                'description' => 'মূসা (আ.) ও বনী ইসরাঈলের ফেরাউনের কবল থেকে মুক্তির দিন ও ঐতিহাসিক ফজিলতপূর্ণ রোজা।',
                'hijri_month' => 1,
                'hijri_day' => 10,
                'slug' => 'day-of-ashura',
                'status' => true,
            ],
            [
                'title' => 'Mawlid an-Nabi',
                'title_bangla' => 'পবিত্র ঈদে মিলাদুন্নবী (১২ই রবিউল আউয়াল)',
                'description' => 'বিশ্বনবী হযরত মুহাম্মদ (সা.)-এর পবিত্র বিলাদত ও ওফাত দিবস।',
                'hijri_month' => 3,
                'hijri_day' => 12,
                'slug' => 'mawlid-an-nabi',
                'status' => true,
            ],
            [
                'title' => 'Isra and Mi\'raj',
                'title_bangla' => 'পবিত্র শবে মেরাজ (২৭শে রজব)',
                'description' => 'রাসূলুল্লাহ (সা.)-এর পবিত্র উর্ধ্বাকাশ ভ্রমণ ও পাঁচ ওয়াক্ত সালাত উপহার প্রাপ্তির রাত।',
                'hijri_month' => 7,
                'hijri_day' => 27,
                'slug' => 'isra-and-miraj',
                'status' => true,
            ],
            [
                'title' => 'Mid-Sha\'ban (Shab-e-Barat)',
                'title_bangla' => 'শবে বরাত / নিসফ মিন শাবান (১৫ই শাবান)',
                'description' => 'শাবান মাসের মধ্যবর্তী রজনী ও বরকতপূর্ণ রাত।',
                'hijri_month' => 8,
                'hijri_day' => 15,
                'slug' => 'shab-e-barat',
                'status' => true,
            ],
            [
                'title' => 'Start of Ramadan',
                'title_bangla' => 'পবিত্র মাহে রমজান শুরু (১লা রমজান)',
                'description' => 'সিয়াম সাধনা, কুরআন নাজিল ও আত্মশুদ্ধির বরকতময় মাসের সূচনা।',
                'hijri_month' => 9,
                'hijri_day' => 1,
                'slug' => 'start-of-ramadan',
                'status' => true,
            ],
            [
                'title' => 'Laylat al-Qadr',
                'title_bangla' => 'পবিত্র শবে কদর (২৭শে রমজান)',
                'description' => 'হাজার মাসের চেয়েও শ্রেষ্ঠ ও মহিমান্বিত রজনী।',
                'hijri_month' => 9,
                'hijri_day' => 27,
                'slug' => 'laylat-al-qadr',
                'status' => true,
            ],
            [
                'title' => 'Eid-ul-Fitr',
                'title_bangla' => 'পবিত্র ঈদুল ফিতর (১লা শাওয়াল)',
                'description' => 'এক মাস সিয়াম সাধনা শেষে মুসলিম উম্মাহর সবচেয়ে বড় আনন্দ ও উৎসবের দিন।',
                'hijri_month' => 10,
                'hijri_day' => 1,
                'slug' => 'eid-ul-fitr',
                'status' => true,
            ],
            [
                'title' => 'Day of Arafah',
                'title_bangla' => 'পবিত্র ইয়াওমে আরাফাহ (৯ই জিলহজ)',
                'description' => 'হজের মূল দিন এবং হাজীদের আরাফাতের ময়দানে অবস্থানের দিন। অ-হাজীদের জন্য বিশেষ রোজার দিন।',
                'hijri_month' => 12,
                'hijri_day' => 9,
                'slug' => 'day-of-arafah',
                'status' => true,
            ],
            [
                'title' => 'Eid-ul-Adha',
                'title_bangla' => 'পবিত্র ঈদুল আজহা / কোরবানির ঈদ (১০ই জিলহজ)',
                'description' => 'মহান আল্লাহর সন্তুষ্টি অর্জনে আত্মত্যাগ ও পশু কোরবানির মহান উৎসব।',
                'hijri_month' => 12,
                'hijri_day' => 10,
                'slug' => 'eid-ul-adha',
                'status' => true,
            ],
        ];

        foreach ($events as $event) {
            IslamicEvent::updateOrCreate(
                ['slug' => $event['slug']],
                $event
            );
        }
    }
}
