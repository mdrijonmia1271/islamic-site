<?php

namespace Database\Seeders;

use App\Models\Dua;
use App\Models\DuaCategory;
use Illuminate\Database\Seeder;

class DuaCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Morning Azkar',
                'name_bangla' => 'সকালের আযকার ও যিকির',
                'slug' => 'morning-azkar',
                'description' => 'প্রতিদিন ফজর পরবর্তী সকালের মাসনূন যিকির ও দুয়াসমূহ।',
                'sort_order' => 1,
                'status' => true,
                'duas' => [
                    [
                        'title' => 'Sayyidul Istighfar (Chief of Forgiveness)',
                        'title_bangla' => 'সাইয়্যিদুল ইস্তিগফার (ক্ষমা প্রার্থনার শ্রেষ্ঠ দু\'আ)',
                        'arabic_text' => 'اللَّهُمَّ أَنْتَ رَبِّي لاَ إِلَهَ إِلاَّ أَنْتَ، خَلَقْتَنِي وَأَنَا عَبْدُكَ، وَأَنَا عَلَى عَهْدِكَ وَوَعْدِكَ مَا اسْتَطَعْتُ، أَعُوذُ بِكَ مِنْ شَرِّ مَا صَنَعْتُ، أَبُوءُ لَكَ بِنِعْمَتِكَ عَلَيَّ، وَأَبُوءُ بِذَنْبِي، فَاغْفِرْ لِي فَإِنَّهُ لاَ يَغْفِرُ الذُّنُوبَ إِلاَّ أَنْتَ',
                        'transliteration' => 'Allahumma Anta Rabbi, la ilaha illa Anta, khalaqtani wa ana ‘abduka, wa ana ‘ala ‘ahdika wa wa‘dika mastata‘tu, a‘udhu bika min sharri ma sana‘tu, abu’u laka bini‘matika ‘alayya, wa abu’u bidhanbi, faghfir li, fa innahu la yaghfirudh-dhunuba illa Anta.',
                        'bangla_meaning' => 'হে আল্লাহ! আপনি আমার পালনকর্তা। আপনি ছাড়া কোনো সত্য উপাস্য নেই। আপনি আমাকে সৃষ্টি করেছেন এবং আমি আপনার বান্দা। আমি আমার সাধ্যমতো আপনার অঙ্গীকার ও প্রতিশ্রুতির ওপর কায়েম রয়েছি। আমি আমার কৃতকর্মের অনিষ্ট থেকে আপনার আশ্রয় চাই। আমার ওপর আপনার নিয়ামত স্বীকার করছি এবং আমার অপরাধ স্বীকার করছি। অতএব আমাকে ক্ষমা করে দিন; কারণ আপনি ছাড়া আর কেউ পাপ ক্ষমা করতে পারে না।',
                        'english_meaning' => 'O Allah, You are my Lord, none has the right to be worshipped but You. You created me and I am Your servant, and I abide by Your covenant and promise as best I can.',
                        'reference' => 'সহীহ বুখারী: ৬৩০৬',
                        'source' => 'হিসনুল মুসলিম (Hisnul Muslim)',
                        'sort_order' => 1,
                    ],
                    [
                        'title' => 'Morning Protection Dua',
                        'title_bangla' => 'সকালে সকল অনিষ্ট থেকে সুরক্ষার দু\'আ',
                        'arabic_text' => 'أَصْبَحْنَا وَأَصْبَحَ الْمُلْكُ لِلَّهِ، وَالْحَمْدُ لِلَّهِ، لاَ إِلَهَ إِلاَّ اللَّهُ وَحْدَهُ لاَ شَرِيكَ لَهُ',
                        'transliteration' => 'Asbahna wa asbahal-mulku lillah, wal-hamdu lillah, la ilaha illallahu wahdahu la sharika lah.',
                        'bangla_meaning' => 'আমরা সকালে উপনীত হয়েছি এবং সমগ্র রাজত্ব আল্লাহর জন্যই সকালে উপনীত হয়েছে। যাবতীয় প্রশংসা আল্লাহর। আল্লাহ ছাড়া কোনো সত্য উপাস্য নেই, তিনি একক, তাঁর কোনো শরীক নেই।',
                        'english_meaning' => 'We have reached the morning and the kingdom belongs to Allah, and all praise is for Allah. None has the right to be worshipped except Allah alone.',
                        'reference' => 'সহীহ মুসলিম: ২৭২৩',
                        'source' => 'হিসনুল মুসলিম (Hisnul Muslim)',
                        'sort_order' => 2,
                    ]
                ]
            ],
            [
                'name' => 'Evening Azkar',
                'name_bangla' => 'সন্ধ্যার আযকার ও যিকির',
                'slug' => 'evening-azkar',
                'description' => 'আসর বা মাগরিব পরবর্তী সন্ধ্যার মাসনূন দু\'আ ও হেফাজতের আযকার।',
                'sort_order' => 2,
                'status' => true,
                'duas' => []
            ],
            [
                'name' => 'After Salah',
                'name_bangla' => 'সালাতের পরের দু\'আ ও যিকির',
                'slug' => 'after-salah',
                'description' => 'ফরজ সালাত সমাপনান্তে পঠিতব্য মাসনূন আমল ও দু\'আসমূহ।',
                'sort_order' => 3,
                'status' => true,
                'duas' => [
                    [
                        'title' => 'Dua After Salam in Salah',
                        'title_bangla' => 'সালাতের সালাম ফেরানোর পর ইস্তিগফার ও দু\'আ',
                        'arabic_text' => 'أَسْتَغْفِرُ اللَّهَ، أَسْتَغْفِرُ اللَّهَ، أَسْتَغْفِرُ اللَّهَ، اللَّهُمَّ أَنْتَ السَّلاَمُ وَمِنْكَ السَّلاَمُ، تَبَارَكْتَ يَا ذَا الْجَلاَلِ وَالإِكْرَامِ',
                        'transliteration' => 'Astaghfirullah, Astaghfirullah, Astaghfirullah. Allahumma Antas-Salamu wa minkas-salam, tabarakta ya Dhal-Jalali wal-Ikram.',
                        'bangla_meaning' => 'আমি আল্লাহর ক্ষমা প্রার্থনা করছি (৩ বার)। হে আল্লাহ! আপনিই শান্তি এবং আপনার থেকেই শান্তি আসে। আপনি বরকতময়, হে মহিমাময় ও সম্মানের অধিকারী!',
                        'english_meaning' => 'I ask Allah for forgiveness (three times). O Allah, You are Peace and from You comes peace. Blessed are You, O Owner of majesty and honor.',
                        'reference' => 'সহীহ মুসলিম: ৫৯১',
                        'source' => 'হিসনুল মুসলিম (Hisnul Muslim)',
                        'sort_order' => 1,
                    ]
                ]
            ],
            [
                'name' => 'Before Sleeping',
                'name_bangla' => 'ঘুমানোর ও ঘুম থেকে ওঠার দু\'আ',
                'slug' => 'before-sleeping',
                'description' => 'রাতে বিছানায় যাওয়ার সময় এবং ঘুম ভাঙার পরের মাসনূন আমল।',
                'sort_order' => 4,
                'status' => true,
                'duas' => [
                    [
                        'title' => 'Dua Before Sleeping',
                        'title_bangla' => 'ঘুমানোর সময় পড়ার দু\'আ',
                        'arabic_text' => 'بِاسْمِكَ اللَّهُمَّ أَمُوتُ وَأَحْيَا',
                        'transliteration' => 'Bismika Allahumma amutu wa ahya.',
                        'bangla_meaning' => 'হে আল্লাহ! আপনার নাম নিয়ে আমি মৃত্যুবরণ করছি (ঘুমাচ্ছি) এবং আপনার নামেই জীবিত হব (জাগ্রত হব)।',
                        'english_meaning' => 'In Your name, O Allah, I die and I live.',
                        'reference' => 'সহীহ বুখারী: ৬৩১২',
                        'source' => 'সহীহ বুখারী',
                        'sort_order' => 1,
                    ]
                ]
            ],
            [
                'name' => 'Food & Drink',
                'name_bangla' => 'খাবার ও পানাহারের দু\'আ',
                'slug' => 'food-and-drink',
                'description' => 'আহার গ্রহণের শুরুতে ও শেষে পঠিতব্য মাসনূন দু\'আসমূহ।',
                'sort_order' => 5,
                'status' => true,
                'duas' => [
                    [
                        'title' => 'Dua After Eating',
                        'title_bangla' => 'খাবার খাওয়ার পরের দু\'আ',
                        'arabic_text' => 'الْحَمْدُ لِلَّهِ الَّذِي أَطْعَمَنَا وَسَقَانَا وَجَعَلَنَا مُسْلِمِينَ',
                        'transliteration' => 'Al-hamdu lillahilladhi at\'amana wa saqana wa ja\'alana muslimin.',
                        'bangla_meaning' => 'যাবতীয় প্রশংসা আল্লাহর জন্য, যিনি আমাদেরকে খাওয়ালেন, পান করালেন এবং মুসলিম বানালেন।',
                        'english_meaning' => 'Praise be to Allah Who has fed us and given us drink and made us Muslims.',
                        'reference' => 'সুনানে আবু দাউদ: ৩৮৫০',
                        'source' => 'সুনানে আবু দাউদ',
                        'sort_order' => 1,
                    ]
                ]
            ],
            [
                'name' => 'Travel',
                'name_bangla' => 'সফরের দু\'আ ও যিকির',
                'slug' => 'travel',
                'description' => 'যানবাহনে আরোহণ ও দীর্ঘ ভ্রমণের মাসনূন দু\'আসমূহ।',
                'sort_order' => 6,
                'status' => true,
                'duas' => [
                    [
                        'title' => 'Dua for Riding a Vehicle',
                        'title_bangla' => 'যানবাহনে আরোহণের দু\'আ',
                        'arabic_text' => 'سُبْحَانَ الَّذِي سَخَّرَ لَنَا هَٰذَا وَمَا كُنَّا لَهُ مُقْرِنِينَ وَإِنَّا إِلَىٰ رَبِّنَا لَمُنقَلِبُونَ',
                        'transliteration' => 'Subhanalladhi sakh-khara lana hadha wa ma kunna lahu muqrinin, wa inna ila Rabbina lamunqalibun.',
                        'bangla_meaning' => 'পবিত্র সেই মহান সত্তা, যিনি একে আমাদের বশীভূত করে দিয়েছেন, অথচ আমরা একে নিয়ন্ত্রণে আনতে সমর্থ ছিলাম না। আর নিশ্চয়ই আমরা আমাদের প্রতিপালকের দিকেই প্রত্যাবর্তন করব।',
                        'english_meaning' => 'Glory to Him who has brought this under our control, though we were unable to subdue it by ourselves, and to our Lord we shall surely return.',
                        'reference' => 'সূরা আয-যুখরুফ: ১৩-১৪; সহীহ মুসলিম: ১৩৪২',
                        'source' => 'আল-কুরআন ও সহীহ মুসলিম',
                        'sort_order' => 1,
                    ]
                ]
            ],
            [
                'name' => 'Protection',
                'name_bangla' => 'সুরক্ষা ও অনিষ্ট থেকে আশ্রয়ের দু\'আ',
                'slug' => 'protection',
                'description' => 'শয়তান, হিংসুক, বিপদাপদ ও রোগব্যাধি থেকে হেফাজতের দু\'আ।',
                'sort_order' => 7,
                'status' => true,
                'duas' => []
            ],
            [
                'name' => 'Forgiveness',
                'name_bangla' => 'ইস্তিগফার ও ক্ষমা প্রার্থনা',
                'slug' => 'forgiveness',
                'description' => 'গুনাহ মাফ ও আল্লাহর দয়া লাভের জন্য শ্রেষ্ঠ তাওবা ও দু\'আ।',
                'sort_order' => 8,
                'status' => true,
                'duas' => []
            ],
            [
                'name' => 'Rizq',
                'name_bangla' => 'হালাল রিযিক ও বরকতের দু\'আ',
                'slug' => 'rizq',
                'description' => 'ঋণমুক্তি ও হালাল উপার্জনে বরকত লাভের কুরআন ও সুন্নাহর দু\'আ।',
                'sort_order' => 9,
                'status' => true,
                'duas' => []
            ],
            [
                'name' => 'Parents',
                'name_bangla' => 'পিতা-মাতার জন্য দু\'আ',
                'slug' => 'parents',
                'description' => 'মা-বাবার দীর্ঘায়ু, সুস্থতা ও মাগফিরাতের জন্য কুরআনী দু\'আসমূহ।',
                'sort_order' => 10,
                'status' => true,
                'duas' => [
                    [
                        'title' => 'Quranic Dua for Parents',
                        'title_bangla' => 'পিতা-মাতার জন্য কুরআনের বিশেষ দু\'আ',
                        'arabic_text' => 'رَّبِّ ارْحَمْهُمَا كَمَا رَبَّيَانِي صَغِيرًا',
                        'transliteration' => 'Rabbir-hamhuma kama rabbayani saghira.',
                        'bangla_meaning' => 'হে আমার পালনকর্তা! তাদের উভয়ের প্রতি রহম করুন; যেমন তারা আমাকে শৈশবে লালন-পালন করেছেন।',
                        'english_meaning' => 'My Lord, have mercy upon them as they brought me up when I was small.',
                        'reference' => 'সূরা আল-ইসরা: ২৪',
                        'source' => 'পবিত্র কুরআনুল কারীম',
                        'sort_order' => 1,
                    ]
                ]
            ],
            [
                'name' => 'Health',
                'name_bangla' => 'সুস্থতা ও রোগমুক্তির দু\'আ (শিফা)',
                'slug' => 'health',
                'description' => 'অসুস্থ ব্যক্তি দেখতে যাওয়া ও নিজের আরোগ্যের জন্য মাসনূন দু\'আ।',
                'sort_order' => 11,
                'status' => true,
                'duas' => []
            ],
            [
                'name' => 'Ramadan',
                'name_bangla' => 'রমাদান ও রোযার দু\'আ',
                'slug' => 'ramadan',
                'description' => 'সেহরি, ইফতার ও লাইলাতুল কদরের বিশেষ দু\'আ ও যিকির।',
                'sort_order' => 12,
                'status' => true,
                'duas' => [
                    [
                        'title' => 'Dua for Breaking Fast (Iftar)',
                        'title_bangla' => 'ইফতারের সময়ের মাসনূন দু\'আ',
                        'arabic_text' => 'ذَهَبَ الظَّمَأُ وَابْتَلَّتِ الْعُرُوقُ وَثَبَتَ الأَجْرُ إِنْ شَاءَ اللَّهُ',
                        'transliteration' => 'Dhahabadh-dhama\'u wabtallatil-\'uruqu wa thabatal-ajru in sha Allah.',
                        'bangla_meaning' => 'পিপাসা নিবারিত হলো, শিরা-উপশিরা সিক্ত হলো এবং আল্লাহ চাহেন তো প্রতিদান নির্ধারিত হলো।',
                        'english_meaning' => 'The thirst is gone, the veins are moistened and the reward is confirmed, if Allah wills.',
                        'reference' => 'সুনানে আবু দাউদ: ২৩৫৭',
                        'source' => 'সুনানে আবু দাউদ',
                        'sort_order' => 1,
                    ]
                ]
            ],
        ];

        foreach ($categories as $catData) {
            $duas = $catData['duas'] ?? [];
            unset($catData['duas']);

            $category = DuaCategory::updateOrCreate(
                ['slug' => $catData['slug']],
                $catData
            );

            foreach ($duas as $duaData) {
                Dua::updateOrCreate(
                    [
                        'dua_category_id' => $category->id,
                        'title' => $duaData['title'],
                    ],
                    $duaData
                );
            }
        }
    }
}
