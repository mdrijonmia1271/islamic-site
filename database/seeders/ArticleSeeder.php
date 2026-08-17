<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ramadanCat = ArticleCategory::where('slug', 'ramadan')->first();
        $zakatCat = ArticleCategory::where('slug', 'zakat')->first();
        $salahCat = ArticleCategory::where('slug', 'salah')->first();
        $duaCat = ArticleCategory::where('slug', 'dua-azkar')->first();
        $knowledgeCat = ArticleCategory::where('slug', 'islamic-knowledge')->first();

        $articles = [
            // 1. Salah: Tahajjud
            [
                'article_category_id' => $salahCat?->id,
                'title' => 'তাহাজ্জুদ নামাজের নিয়ম, সময়, রাকাত ও বিশেষ ফজিলত',
                'slug' => 'how-to-perform-tahajjud',
                'excerpt' => 'তাহাজ্জুদ নামাজ আল্লাহর নৈকট্য অর্জনের সর্বোত্তম নফল সালাত। জেনে নিন তাহাজ্জুদের সঠিক সময়, নিয়ত, রাকাত সংখ্যা এবং সহিহ হাদিসের দলিল।',
                'content' => '
<h2>ভূমিকা (Introduction)</h2>
<p>ইসলামে ফরজ নামাজের পরেই নফল ইবাদতের মধ্যে সর্বোত্তম ও সর্বাধিক মর্যাদাপূর্ণ হলো রাতের সালাত বা <strong>তাহাজ্জুদ নামাজ (Tahajjud Prayer)</strong>। গভীর রাতে যখন মানুষ ঘুমে মগ্ন থাকে, তখন আরামের বিছানা ত্যাগ করে মহান আল্লাহর সন্তুষ্টির উদ্দেশ্যে সিজদায় অবনত হওয়াই মুমিনের অন্যতম শ্রেষ্ঠ বৈশিষ্ট্য।</p>

<blockquote>
    <strong>পবিত্র কুরআনের দলিল:</strong><br>
    <em>"এবং রাতের কিছু অংশে তাহাজ্জুদ আদায় করুন, যা আপনার জন্য এক অতিরিক্ত ইবাদত। আশা করা যায় আপনার প্রতিপালক আপনাকে প্রশংসিত স্থানে অধিষ্ঠিত করবেন।"</em><br>
    — <a href="' . url('/quran/17') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">সূরা বনী ইসরাঈল, আয়াত: ৭৯</a>
</blockquote>

<h2>তাহাজ্জুদের সর্বোত্তম সময় ও রাকাত সংখ্যা</h2>
<p>রাতের শেষ তৃতীয়াংশে তাহাজ্জুদ আদায় করা সবচেয়ে উত্তম। তাহাজ্জুদ সর্বনিম্ন ২ রাকাত থেকে শুরু করে ৪, ৬, ৮ বা ১২ রাকাত পর্যন্ত পড়া যায়। রাসূলুল্লাহ (সা.) সাধারণত বিতরসহ মোট ১১ বা ১৩ রাকাত আদায় করতেন।</p>
<p>👉 আপনার এলাকার সঠিক তাহাজ্জুদ ও সাহরির শেষ সময় জানতে আমাদের <a href="' . url('/prayer-times') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">নামাজের সময়সূচি (Prayer Times)</a> দেখুন।</p>

<h2>তাহাজ্জুদের দোয়া ও আমল</h2>
<p>তাহাজ্জুদ শেষে চোখের পানি ফেলে ক্ষমা প্রার্থনা করুন। পড়ুন <a href="' . url('/articles/dua-for-forgiveness-istighfar') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">সাইয়্যিদুল ইস্তিগফার ও মাগফিরাতের দোয়া</a> এবং তাহাজ্জুদের পর বিতর সালাত সম্পন্ন করুন।</p>',
                'featured_image' => null,
                'meta_title' => 'তাহাজ্জুদ নামাজের নিয়ম, সময়, রাকাত ও ফজিলত | Tahajjud Prayer Guide',
                'meta_description' => 'তাহাজ্জুদ নামাজ কত রাকাত ও কীভাবে পড়তে হয়? জেনে নিন তাহাজ্জুদের সঠিক সময়, নিয়ত, ফজিলত এবং হাদিসের দলিল।',
                'meta_keywords' => 'তাহাজ্জুদ নামাজ, তাহাজ্জুদের নিয়ম, tahajjud prayer rules, salah guide, islam',
                'canonical_url' => url('/articles/how-to-perform-tahajjud'),
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(6),
                'views' => 480,
            ],

            // 2. Salah: Witr Prayer
            [
                'article_category_id' => $salahCat?->id,
                'title' => 'বিতর নামাজের সঠিক নিয়ম, রাকাত ও দোয়া কুনুত',
                'slug' => 'how-to-perform-witr',
                'excerpt' => 'বিতর নামাজ রাতের সালাতের পরিসমাপ্তি। বিতর নামাজের সঠিক নিয়ম, ৩ রাকাত পড়ার সুন্নাহ পদ্ধতি ও দোয়া কুনুত অর্থসহ জানুন।',
                'content' => '
<h2>বিতর নামাজের গুরুত্ব ও বিধান</h2>
<p>বিতর (وتر) শব্দের অর্থ বিজোড়। রাতের নফল বা তাহাজ্জুদ নামাজ শেষে বিতর সালাত আদায় করা সুন্নাতে মুয়াক্কাদাহ বা ওয়াজিব। রাসূলুল্লাহ (সা.) সফর বা বাড়িতে—কখনোই বিতর সালাত ত্যাগ করতেন না।</p>

<blockquote>
    <strong>হাদিসের বাণী:</strong><br>
    <em>রাসূলুল্লাহ (সা.) ইরশাদ করেছেন: "তোমরা রাতের শেষ সালাত বিতরকে বানিয়ে নাও।"</em><br>
    — <a href="' . url('/hadith') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">সহিহ বুখারি (হাদিস: ৯৯৮), সহিহ মুসলিম</a>
</blockquote>

<h2>বিতর নামাজের রাকাত ও নিয়ম</h2>
<p>বিতর নামাজ সাধারণত ১ রাকাত, ৩ রাকাত বা ৫ রাকাত পড়া যায়। হানাফী ফিকহ অনুযায়ী ৩ রাকাত এক সালামে মাগরিবের মতো করে আদায় করা হয়, তবে তৃতীয় রাকাতে কিরাতের পর তাকবির বলে <strong>দোয়া কুনুত</strong> পড়তে হয়।</p>

<h2>দোয়া কুনুত (Dua Qunut)</h2>
<p><em>"আল্লাহুম্মা ইন্না নাসতাঈনুকা ওয়া নাসতাগফিরুকা..."</em>—এই দোয়ার মাধ্যমে বান্দা আল্লাহর আনুগত্য ও ক্ষমা প্রার্থনা করে। দোয়াটি শিখতে ভিজিট করুন আমাদের <a href="' . url('/duas') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">দোয়া ও আযকার সমগ্র</a>।</p>',
                'featured_image' => null,
                'meta_title' => 'বিতর নামাজের সঠিক নিয়ম ও দোয়া কুনুত | How to Perform Witr Prayer',
                'meta_description' => 'বিতর নামাজ কত রাকাত ও কীভাবে পড়তে হয়? দোয়া কুনুত বাংলা উচ্চারণ ও অর্থসহ বিতর সালাতের সুন্নাহ নিয়ম জানুন।',
                'meta_keywords' => 'বিতর নামাজ, দোয়া কুনুত, witr prayer rules, dua qunut, salah guide',
                'canonical_url' => url('/articles/how-to-perform-witr'),
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(5),
                'views' => 320,
            ],

            // 3. Salah: Things That Break Salah
            [
                'article_category_id' => $salahCat?->id,
                'title' => 'যেসব কারণে নামাজ ভেঙে যায় বা নষ্ট হয় (নামাজ ভঙ্গের কারণসমূহ)',
                'slug' => 'things-that-break-salah',
                'excerpt' => 'নামাজ অবস্থায় এমন কিছু কাজ রয়েছে যা সংঘটিত হলে নামাজ তাৎক্ষণিক নষ্ট হয়ে যায়। নামাজ ভঙ্গের ১৯টি প্রধান কারণ বিস্তারিত জেনে নিন।',
                'content' => '
<h2>নামাজের শুদ্ধতার শর্ত</h2>
<p>সালাত হলো মহান আল্লাহর সামনে দণ্ডায়মান হওয়া। নামাজে পূর্ণ একাগ্রতা বজায় রাখা ফরজ। নামাজ নষ্টকারী বিষয়গুলো জানা প্রতিটি মুসলিমের জন্য অপরিহার্য।</p>

<h2>নামাজ ভঙ্গের প্রধান কারণসমূহ:</h2>
<ol>
    <li><strong>নামাজে কথা বলা:</strong> ইচ্ছায় বা অনিচ্ছায় কোনো অর্থপূর্ণ কথা বলা।</li>
    <li><strong>কাউকে সালাম দেওয়া বা সালামের উত্তর দেওয়া।</strong></li>
    <li><strong>আমলে কাসীর করা:</strong> এমন কোনো কাজ করা যার কারণে দূর থেকে দেখলে মনে হয় তিনি নামাজে নেই (যেমন দুই হাত দিয়ে অন্য কাজ করা)।</li>
    <li><strong>কিবলা থেকে সিনা ঘুরে যাওয়া:</strong> বিনা ওজরে কিবলা থেকে বুক ফিরিয়ে নেওয়া।</li>
    <li><strong>নাপাক কাপড় বা স্থানে নামাজ পড়া।</strong></li>
    <li><strong>নামাজে শব্দ করে হাসা:</strong> যার ফলে পাশের লোক শুনতে পায়।</li>
    <li><strong>অজু ভেঙে যাওয়া:</strong> নামাজরত অবস্থায় বায়ু নির্গমন বা অজু ভঙ্গের কারণ ঘটা।</li>
    <li><strong>অর্থ পরিবর্তনকারী ভুল কিরাত পড়া।</strong></li>
</ol>
<p>👉 নামাজের সঠিক সময় ও কিবলা দিকনির্দেশনা জানতে আমাদের <a href="' . url('/prayer-times') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">নামাজের সময়সূচি</a> ব্যবহার করুন।</p>',
                'featured_image' => null,
                'meta_title' => 'নামাজ ভঙ্গের কারণসমূহ | Things That Break Salah in Islam',
                'meta_description' => 'নামাজ নষ্ট হওয়ার কারণগুলো কী কী? নামাজে হাসা, কথা বলা, অজু ভাঙা সহ যাবতীয় নামাজ ভঙ্গের বিধান জানুন।',
                'meta_keywords' => 'নামাজ ভঙ্গের কারণ, things that break salah, invalidates prayer, salah rules',
                'canonical_url' => url('/articles/things-that-break-salah'),
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(4),
                'views' => 290,
            ],

            // 4. Ramadan: Roza Rules
            [
                'article_category_id' => $ramadanCat?->id,
                'title' => 'রমজানের রোজার প্রয়োজনীয় নিয়ম, শর্ত ও ফজিলত',
                'slug' => 'ramadan-roza-rules',
                'excerpt' => 'রমজান মাসের রোজা রাখা প্রত্যেক প্রাপ্তবয়স্ক মুসলমানের ওপর ফরজ। রোজার মৌলিক নিয়ম, নিয়ত ও গুরুত্বপূর্ণ দিকগুলো জানুন।',
                'content' => '
<h2>রমজানের গুরুত্ব ও ফজিলত</h2>
<p>পবিত্র মাহে রমজান আত্মশুদ্ধি, সংযম ও ক্ষমার মাস। সুরা বাকারার ১৮৩ আয়াতে আল্লাহ তাআলা রোজাকে ফরজ করেছেন যেন আমরা তাকওয়া অর্জন করতে পারি।</p>

<h2>রোজার শর্তসমূহ ও সেহরি-ইফতার</h2>
<p>সুবহে সাদিক থেকে সূর্যাস্ত পর্যন্ত নিয়তের সাথে পানাহার ও কামাচার থেকে বিরত থাকা ফরজ। সঠিক সময়ে সেহরি ও ইফতার করতে দেখুন আমাদের <a href="' . url('/prayer-times') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">নামাজ ও রোজা সময়সূচি</a> এবং বিশেষ দিবস জানতে <a href="' . url('/islamic-calendar') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">ইসলামিক ক্যালেন্ডার</a>।</p>',
                'featured_image' => null,
                'meta_title' => 'রমজানের রোজার নিয়ম, শর্ত ও ফজিলত | Ramadan Roza Rules',
                'meta_description' => 'রমজান মাসের রোজা পালনের যাবতীয় নিয়মাবলি, শর্ত, রোজা ভঙ্গের কারণ এবং ফজিলত বিস্তারিত জানুন।',
                'meta_keywords' => 'রমজান, রোজা, রোজার নিয়ম, ramadan roza rules, islamic articles',
                'canonical_url' => url('/articles/ramadan-roza-rules'),
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(3),
                'views' => 520,
            ],

            // 5. Ramadan: Laylatul Qadr
            [
                'article_category_id' => $ramadanCat?->id,
                'title' => 'লাইলাতুল কদর বা পবিত্র শবে কদরের বিশেষ আমল ও ফজিলত',
                'slug' => 'laylatul-qadr-guide',
                'excerpt' => 'হাজার মাসের চেয়েও শ্রেষ্ঠ রাত লাইলাতুল কদর। শেষ দশকের বিজোড় রাতগুলোতে কদরের তালাশ ও বিশেষ দোয়ার পূর্ণাঙ্গ গাইড।',
                'content' => '
<h2>লাইলাতুল কদরের মর্যাদা</h2>
<p>পবিত্র কুরআনের সূরা আল-কদরে আল্লাহ ঘোষণা করেছেন—লাইলাতুল কদর হলো হাজার মাসের চেয়েও উত্তম এক বরকতময় রাত। এই রাতে কুরআন নাজিল হয়েছে এবং ফেরেশতারা আল্লাহর রহমত নিয়ে জমিনে অবতীর্ণ হন।</p>

<blockquote>
    <strong>কুরআনের ঘোষণা:</strong><br>
    <em>"লাইলাতুল কদর হাজার মাসের চেয়েও শ্রেষ্ঠ।"</em><br>
    — <a href="' . url('/quran/97') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">সূরা আল-কদর, আয়াত: ৩</a>
</blockquote>

<h2>কদরের রাতের বিশেষ দোয়া</h2>
<p>আম্মাজান আয়েশা (রা.) রাসূলুল্লাহ (সা.)-কে জিজ্ঞেস করেছিলেন, "হে আল্লাহর রাসূল! আমি যদি জানতে পারি কোন রাতটি কদর, তবে কী দোয়া করব?" রাসূল (সা.) বললেন, তুমি বলো:</p>
<blockquote style="font-family: \'Amiri\', serif; font-size: 1.25rem;">
    «اللَّهُمَّ إِنَّكَ عَفُوٌّ تُحِبُّ الْعَفْوَ فَاعْفُ عَنِّي»<br>
    <em>"উচ্চারণ: আল্লাহুম্মা ইন্নাকা আফুউন তুহিব্বুল আফওয়া ফা\'ফু আন্নী।"</em><br>
    (অর্থ: হে আল্লাহ! নিশ্চয়ই আপনি ক্ষমাশীল, ক্ষমাকে ভালোবাসেন; অতএব আমাকে ক্ষমা করে দিন।)
</blockquote>
<p>👉 রমজানের শেষ দশকের দিন-তারিখ জানতে আমাদের <a href="' . url('/islamic-calendar') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">হিজরি ক্যালেন্ডার</a> দেখুন।</p>',
                'featured_image' => null,
                'meta_title' => 'লাইলাতুল কদর বা শবে কদরের আমল ও দোয়া | Laylatul Qadr Guide',
                'meta_description' => 'পবিত্র শবে কদর বা লাইলাতুল কদরের ফজিলত, শেষ দশকের বিজোড় রাতের আমল ও কদরের বিশেষ দোয়া বিস্তারিত জানুন।',
                'meta_keywords' => 'লাইলাতুল কদর, শবে কদর, laylatul qadr guide, shab e qadr, ramadan dua',
                'canonical_url' => url('/articles/laylatul-qadr-guide'),
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(2),
                'views' => 410,
            ],

            // 6. Zakat: Calculation Guide
            [
                'article_category_id' => $zakatCat?->id,
                'title' => 'যাকাত ক্যালকুলেশন ও হিসাব নির্দেশিকা: সহজ নিয়মে নিজের যাকাত নির্ণয়',
                'slug' => 'zakat-calculation-guide',
                'excerpt' => 'যাকাত ইসলামের অন্যতম মৌলিক স্তম্ভ। নিসাব পরিমাণ সম্পদের শর্ত, কোন সম্পদে যাকাত আসে এবং কীভাবে সঠিক ২.৫% হিসাব করবেন তা জানুন।',
                'content' => '
<h2>যাকাতের বিধান ও নেসাব</h2>
<p>নেসাব পরিমাণ ধন-সম্পদের মালিক প্রত্যেক প্রাপ্তবয়স্ক মুসলিমের ওপর যাকাত ফরজ। সাড়ে ৫২ তোলা রূপা বা সাড়ে ৭ ভরি স্বর্ণের সমপরিমাণ অর্থ প্রয়োজনের অতিরিক্ত এক বছর থাকলে মোট সম্পদের ২.৫% যাকাত দিতে হয়।</p>
<p>👉 আপনার সম্পদের যাকাত মুহূর্তেই হিসাব করতে আমাদের <a href="' . url('/tools/zakat') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">ডিজিটাল যাকাত ক্যালকুলেটর টুল</a> ব্যবহার করুন।</p>',
                'featured_image' => null,
                'meta_title' => 'যাকাত ক্যালকুলেশন ও হিসাব নির্দেশিকা | Zakat Calculation Guide',
                'meta_description' => 'সহজ নিয়মে আপনার সম্পদের যাকাত হিসাব করুন। যাকাতের নেসাব, শর্ত ও বণ্টন খাতসমূহ সম্পর্কে বিস্তারিত তথ্য জানুন।',
                'meta_keywords' => 'যাকাত, যাকাত ক্যালকুলেটর, zakat guide, zakat calculation, ইসলাম',
                'canonical_url' => url('/articles/zakat-calculation-guide'),
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(2),
                'views' => 380,
            ],

            // 7. Dua: Ayatul Kursi
            [
                'article_category_id' => $duaCat?->id,
                'title' => 'আয়াতুল কুরসীর ফজিলত, বাংলা উচ্চারণ ও অর্থসহ তাৎপর্য',
                'slug' => 'ayatul-kursi-virtues-meaning',
                'excerpt' => 'পবিত্র কুরআনের সর্বশ্রেষ্ঠ আয়াত হলো আয়াতুল কুরসী। জেনে নিন এর বিশেষ ফজিলত, শয়তান থেকে মুক্তির আমল এবং প্রতিটি বাক্যের গভীর তাৎপর্য।',
                'content' => '
<h2>কুরআনের সর্বশ্রেষ্ঠ আয়াত</h2>
<p>সূরা আল-বাকারার ২৫৫ নম্বর আয়াতটি ‘আয়াতুল কুরসী’ নামে খ্যাত। এতে মহান আল্লাহর তাওহীদ ও সার্বভৌমত্বের অপূর্ব বর্ণনা রয়েছে। প্রত্যেক ফরজ সালাতের পর এবং ঘুমানোর পূর্বে এটি পাঠ করা অত্যন্ত ফজিলতপূর্ণ সুন্নাহ।</p>
<p>👉 সম্পূর্ণ আয়াত তিলাওয়াত করতে দেখুন <a href="' . url('/quran/2') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">সূরা আল-বাকারা</a> এবং অন্যান্য দোয়া শিখুন <a href="' . url('/duas') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">দোয়া ও আযকার পাতায়</a>।</p>',
                'featured_image' => null,
                'meta_title' => 'আয়াতুল কুরসীর ফজিলত, অর্থ ও তাৎপর্য | Ayatul Kursi Benefits',
                'meta_description' => 'কুরআনের সর্বশ্রেষ্ঠ আয়াত আয়াতুল কুরসীর বিশেষ ফজিলত, সহিহ হাদিসের দলিল, বাংলা অনুবাদ ও প্রতিদিনের আমল জানুন।',
                'meta_keywords' => 'আয়াতুল কুরসী, আয়াতুল কুরসীর ফজিলত, ayatul kursi benefits, quran, dua',
                'canonical_url' => url('/articles/ayatul-kursi-virtues-meaning'),
                'status' => 'published',
                'published_at' => Carbon::now()->subDay(),
                'views' => 610,
            ],

            // 8. Dua: Morning and Evening Azkar
            [
                'article_category_id' => $duaCat?->id,
                'title' => 'সকাল ও সন্ধ্যার দৈনন্দিন গুরুত্বপূর্ণ মাসনূন জিকির ও দোয়া',
                'slug' => 'morning-evening-azkar-guide',
                'excerpt' => 'সকাল ও সন্ধ্যায় পঠিত মাসনূন আযকার মুমিনের সারাদিনের নিরাপত্তা কবচ। সহিহ হাদিসসম্মত সকাল-সন্ধ্যার গুরুত্বপূর্ণ দোয়াগুলো জানুন।',
                'content' => '
<h2>সকাল-সন্ধ্যার জিকিরের গুরুত্ব</h2>
<p>মহান আল্লাহ কুরআনে সকাল ও সন্ধ্যায় তাঁর তাসবীহ পাঠ করার নির্দেশ দিয়েছেন। সকাল-সন্ধ্যার জিকির মানুষের হৃদয়কে প্রশান্ত রাখে এবং শয়তানের প্ররোচনা ও অনিষ্ট থেকে রক্ষা করে।</p>

<blockquote>
    <strong>কুরআনের নির্দেশ:</strong><br>
    <em>"আর সকাল ও সন্ধ্যায় আপনার প্রতিপালকের সপ্রশংস পবিত্রতা ঘোষণা করুন।"</em><br>
    — <a href="' . url('/quran/40') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">সূরা গাফির, আয়াত: ৫৫</a>
</blockquote>

<h2>প্রধান সকাল-সন্ধ্যার দোয়াগুলো:</h2>
<ul>
    <li><strong>৩ কুল পাঠ:</strong> সুরা ইখলাস, সুরা ফালাক ও সুরা নাস ৩ বার করে পাঠ।</li>
    <li><strong>আয়াতুল কুরসী:</strong> সকাল ও সন্ধ্যায় ১ বার।</li>
    <li><strong>সাইয়্যিদুল ইস্তিগফার:</strong> সকাল ও সন্ধ্যায় ক্ষমা প্রার্থনার শ্রেষ্ঠ দোয়া।</li>
    <li><strong>বিসমিল্লাহিল্লাজি লা ইয়াদুররু...:</strong> ৩ বার পাঠ করলে কোনো কিছু ক্ষতি করতে পারে না।</li>
</ul>
<p>👉 আরবি উচ্চারণসহ সব দোয়া পড়তে আমাদের <a href="' . url('/duas') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">দৈনন্দিন দু\'আ ও আযকার</a> সেকশন ভিজিট করুন।</p>',
                'featured_image' => null,
                'meta_title' => 'সকাল সন্ধ্যার মাসনূন জিকির ও দোয়া | Morning & Evening Azkar Guide',
                'meta_description' => 'সকাল ও সন্ধ্যার দৈনন্দিন জরুরি মাসনূন জিকির, ৩ কুল, আয়াতুল কুরসী ও হেফাজতের দোয়াসমূহ বাংলা অর্থসহ বিস্তারিত জানুন।',
                'meta_keywords' => 'সকাল সন্ধ্যার দোয়া, morning evening azkar, masnoon dua, dua azkar',
                'canonical_url' => url('/articles/morning-evening-azkar-guide'),
                'status' => 'published',
                'published_at' => Carbon::now()->subHours(12),
                'views' => 275,
            ],

            // 9. Dua: Istighfar & Forgiveness
            [
                'article_category_id' => $duaCat?->id,
                'title' => 'তওবা ও গুনাহ মাফের শ্রেষ্ঠ দোয়া: সাইয়্যিদুল ইস্তিগফার অর্থসহ',
                'slug' => 'dua-for-forgiveness-istighfar',
                'excerpt' => 'ক্ষমা প্রার্থনার শ্রেষ্ঠ দোয়া সাইয়্যিদুল ইস্তিগফার। তওবার শর্তাবলী, ইস্তিগফারের অলৌকিক উপকারিতা ও সহিহ হাদিসের ফজিলত জানুন।',
                'content' => '
<h2>তওবা ও ইস্তিগফারের মর্যাদা</h2>
<p>মানুষ মাত্রই ভুল ও পাপের শিকার হতে পারে। কিন্তু শ্রেষ্ঠ অপরাধী সে-ই যে ভুল স্বীকার করে রবের কাছে ফিরে আসে। ইস্তিগফার মানুষের রিজিক বৃদ্ধি করে, দুশ্চিন্তা দূর করে এবং জান্নাত লাভের পথ সুগম করে।</p>

<blockquote>
    <strong>হাদিসে কুদসী:</strong><br>
    <em>আল্লাহ তাআলা বলেন: "হে আদম সন্তান! তুমি যতদিন আমাকে ডাকবে ও ক্ষমা চাইবে, আমি তোমার সমস্ত পাপ ক্ষমা করে দেব, আমি কোনো পরোয়া করি না।"</em><br>
    — <a href="' . url('/hadith') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">জামে তিরমিযী (হাদিস: ৩৫৪০)</a>
</blockquote>

<h2>সাইয়্যিদুল ইস্তিগফার (Sayyidul Istighfar)</h2>
<p>রাসূলুল্লাহ (সা.) বলেছেন, এটি হলো তওবার শ্রেষ্ঠ দোয়া। যে ব্যক্তি দৃঢ় বিশ্বাসের সাথে দিনে পড়বে এবং সন্ধ্যায় মারা যাবে, সে জান্নাতি হবে; আর যে রাতে পড়বে এবং ভোরে মারা যাবে, সেও জান্নাতি হবে। (সহিহ বুখারি: ৬৩০৬)</p>
<p>👉 সাইয়্যিদুল ইস্তিগফারের আরবি, অর্থ ও অডিও শুনতে আমাদের <a href="' . url('/duas') . '" class="text-emerald-600 dark:text-emerald-400 font-semibold underline">দোয়া ও আযকার মডিউল</a> দেখুন।</p>',
                'featured_image' => null,
                'meta_title' => 'তওবা ও ক্ষমা প্রার্থনার দোয়া: সাইয়্যিদুল ইস্তিগফার | Dua for Forgiveness',
                'meta_description' => 'গুনাহ মাফের শ্রেষ্ঠ দোয়া সাইয়্যিদুল ইস্তিগফার বাংলা উচ্চারণ ও অর্থসহ। তওবার সঠিক নিয়ম ও সহিহ হাদিসের ফজিলত জেনে নিন।',
                'meta_keywords' => 'সাইয়্যিদুল ইস্তিগফার, তওবার দোয়া, dua for forgiveness, istighfar, dua azkar',
                'canonical_url' => url('/articles/dua-for-forgiveness-istighfar'),
                'status' => 'published',
                'published_at' => Carbon::now(),
                'views' => 340,
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['slug' => $article['slug']],
                $article
            );
        }
    }
}
