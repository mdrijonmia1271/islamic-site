<?php

namespace Database\Seeders;

use App\Models\QuizCategory;
use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'পবিত্র কুরআন (The Holy Quran)',
                'slug' => 'quran',
                'description' => 'পবিত্র কুরআনুল কারিমের সূরা, আয়াত, নাযিল ও তাৎপর্য সম্পর্কিত কুইজ।',
                'status' => true,
                'questions' => [
                    [
                        'question' => 'পবিত্র কুরআনের প্রথম সূরার নাম কী? (Which Surah is the first Surah of the Quran?)',
                        'option_a' => 'সূরা আল-বাক্বারাহ (Al-Baqarah)',
                        'option_b' => 'সূরা আল-ফাতিহা (Al-Fatiha)',
                        'option_c' => 'সূরা আল-ইখলাস (Al-Ikhlas)',
                        'option_d' => 'সূরা আন-নাস (An-Nas)',
                        'correct_answer' => 'b',
                        'explanation' => 'সূরা আল-ফাতিহা হলো পবিত্র কুরআনের ১ম এবং প্রারম্ভিক সূরা (উম্মুল কুরআন)।',
                    ],
                    [
                        'question' => 'পবিত্র কুরআনের কোন সূরাকে "কুরআনের হৃৎপিণ্ড" (Heart of the Quran) বলা হয়?',
                        'option_a' => 'সূরা আল-বাক্বারাহ',
                        'option_b' => 'সূরা ইয়াসীন',
                        'option_c' => 'সূরা আল-ফাতিহা',
                        'option_d' => 'সূরা আর-রাহমান',
                        'correct_answer' => 'b',
                        'explanation' => 'তিরমিজি শরিফের হাদিস অনুসারে সূরা ইয়াসীনকে কুরআনের হৃৎপিণ্ড বা কলব বলা হয়েছে।',
                    ],
                    [
                        'question' => 'পবিত্র কুরআনের সবচেয়ে বড় এবং দীর্ঘতম সূরা কোনটি?',
                        'option_a' => 'সূরা আল-ইমরান',
                        'option_b' => 'সূরা আন-নিসা',
                        'option_c' => 'সূরা আল-বাক্বারাহ',
                        'option_d' => 'সূরা আল-মায়িদাহ',
                        'correct_answer' => 'c',
                        'explanation' => 'সূরা আল-বাক্বারাহ কুরআনের দীর্ঘতম সূরা, যাতে মোট ২৮৬টি আয়াত রয়েছে।',
                    ],
                    [
                        'question' => 'কুরআনের কোন সূরার শুরুতে বিসমিল্লাহ নেই?',
                        'option_a' => 'সূরা আত-তাওবাহ',
                        'option_b' => 'সূরা আল-আনফাল',
                        'option_c' => 'সূরা ইউনুস',
                        'option_d' => 'সূরা হুদ',
                        'correct_answer' => 'a',
                        'explanation' => 'সূরা আত-তাওবাহ্ এর শুরুতে বিসমিল্লাহির রাহমানির রাহিম পাঠ করা হয় না।',
                    ],
                    [
                        'question' => 'পবিত্র কুরআনের কোন আয়াতে আয়াতুল কুরসি অবস্থিত?',
                        'option_a' => 'সূরা আল-বাক্বারাহ: ২৫৫',
                        'option_b' => 'সূরা আল-বাক্বারাহ: ২৮৫',
                        'option_c' => 'সূরা আল-ইমরান: ১৮',
                        'option_d' => 'সূরা আল-আরাফ: ৫৪',
                        'correct_answer' => 'a',
                        'explanation' => 'সূরা আল-বাক্বারাহ এর ২৫৫ নম্বর আয়াতটি মর্যাদাশীল আয়াতুল কুরসি।',
                    ],
                    [
                        'question' => 'পবিত্র কুরআনে মোট কতটি সূরা রয়েছে?',
                        'option_a' => '১১২টি',
                        'option_b' => '১১৪টি',
                        'option_c' => '১২০টি',
                        'option_d' => '১১০টি',
                        'correct_answer' => 'b',
                        'explanation' => 'পবিত্র কুরআনে মোট ১১৪টি পূর্ণাঙ্গ সূরা এবং ৩০টি পারা রয়েছে।',
                    ],
                ],
            ],
            [
                'name' => 'নবী ও রাসূলগণ (Prophets of Islam)',
                'slug' => 'prophets',
                'description' => 'পবিত্র কুরআনে বর্ণিত সম্মানিত আম্বিয়ায়ে কেরামগণের জীবনী সম্পর্কিত কুইজ।',
                'status' => true,
                'questions' => [
                    [
                        'question' => 'মানবজাতির আদি পিতা ও সর্বপ্রথম নবী কে ছিলেন?',
                        'option_a' => 'হযরত নূহ (আঃ)',
                        'option_b' => 'হযরত ইব্রাহিম (আঃ)',
                        'option_c' => 'হযরত আদম (আঃ)',
                        'option_d' => 'হযরত শীষ (আঃ)',
                        'correct_answer' => 'c',
                        'explanation' => 'হযরত আদম (আঃ) হলেন পৃথিবীর প্রথম মানুষ এবং আল্লাহর প্রথম নবী।',
                    ],
                    [
                        'question' => 'কোন নবীকে "খলিলুল্লাহ" (আল্লাহর বন্ধু) উপাধিতে ভূষিত করা হয়েছিল?',
                        'option_a' => 'হযরত মুসা (আঃ)',
                        'option_b' => 'হযরত ইব্রাহিম (আঃ)',
                        'option_c' => 'হযরত ঈসা (আঃ)',
                        'option_d' => 'হযরত দাউদ (আঃ)',
                        'correct_answer' => 'b',
                        'explanation' => 'পবিত্র কুরআনে হযরত ইব্রাহিম (আঃ)-কে খলিলুল্লাহ বা আল্লাহর বন্ধু হিসেবে আখ্যায়িত করা হয়েছে।',
                    ],
                    [
                        'question' => 'কোন নবীর উপর পবিত্র তাওরাত কিতাব নাযিল হয়েছিল?',
                        'option_a' => 'হযরত মুসা (আঃ)',
                        'option_b' => 'হযরত দাউদ (আঃ)',
                        'option_c' => 'হযরত ঈসা (আঃ)',
                        'option_d' => 'হযরত ইউসুফ (আঃ)',
                        'correct_answer' => 'a',
                        'explanation' => 'মহান আল্লাহ হযরত মুসা (আঃ)-এর ওপর আসমানী কিতাব তাওরাত নাযিল করেছিলেন।',
                    ],
                ],
            ],
            [
                'name' => 'ইসলামের স্তম্ভ ও ইবাদত (Pillars of Islam & Ibadah)',
                'slug' => 'ibadah',
                'description' => 'ঈমান, সালাত, সাওম, যাকাত ও হজ্জ সম্পর্কিত জ্ঞান যাচাই।',
                'status' => true,
                'questions' => [
                    [
                        'question' => 'ইসলামের ভিত্তি মোট কয়টি বিষয়ের ওপর প্রতিষ্ঠিত?',
                        'option_a' => '৩টি',
                        'option_b' => '৪টি',
                        'option_c' => '৫টি',
                        'option_d' => '৬টি',
                        'correct_answer' => 'c',
                        'explanation' => 'সহিহ বুখারি ও মুসলিমের হাদিস অনুযায়ী ইসলামের মূল ভিত্তি ৫টি (কালেমা, নামাজ, রোজা, যাকাত, হজ)।',
                    ],
                    [
                        'question' => 'কিয়ামতের দিন বান্দার কাছ থেকে সর্বপ্রথম কোন আমলের হিসাব নেওয়া হবে?',
                        'option_a' => 'যাকাত',
                        'option_b' => 'সালাত (নামাজ)',
                        'option_c' => 'রোজা',
                        'option_d' => 'সদকা',
                        'correct_answer' => 'b',
                        'explanation' => 'তিরমিজি শরিফের হাদিস: কিয়ামতের ময়দানে বান্দার সর্বপ্রথম হিসাব হবে সালাত বা নামাজের।',
                    ],
                ],
            ],
        ];

        foreach ($categories as $catData) {
            $questions = $catData['questions'];
            unset($catData['questions']);

            $category = QuizCategory::firstOrCreate(
                ['slug' => $catData['slug']],
                $catData
            );

            foreach ($questions as $qData) {
                QuizQuestion::firstOrCreate(
                    [
                        'quiz_category_id' => $category->id,
                        'question' => $qData['question'],
                    ],
                    array_merge($qData, ['quiz_category_id' => $category->id])
                );
            }
        }
    }
}
