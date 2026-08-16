# 🕋 Islamic Site — Database Architecture & Schema Design

> **নোট:** এই ডকুমেন্টে প্রজেক্টের সব টেবিল এবং সেগুলোর প্রাথমিক স্ট্রাকচার লিপিবদ্ধ করা হলো। আগামী দিনগুলোতে একেকটি মডিউল অনুযায়ী ডেটাবেজ মাইগ্রেশন ও মডেল তৈরি করা হবে।

---

## 📑 মডিউল ভিত্তিক টেবিল তালিকা (Table Index)

1. **User Management Module**
   - `users`
2. **Al-Quran Module**
   - `surahs`
   - `ayahs`
   - `quran_translations`
3. **Hadith Module**
   - `hadith_books`
   - `hadith_chapters`
   - `hadiths`
4. **Dua & Azkar Module**
   - `dua_categories`
   - `duas`
5. **Articles & Blog Module**
   - `article_categories`
   - `articles`
6. **User Interaction & Personalization Module**
   - `bookmarks`
   - `reading_histories`
7. **Prayer Times & Islamic Calendar Module**
   - `prayer_times`
   - `islamic_events`
8. **Islamic Quiz Module**
   - `quizzes`
   - `quiz_questions`
   - `quiz_answers`

---

## 🗄️ টেবিলসমূহের বিস্তারিত ফিল্ড ও স্ট্রাকচার

### ১. User Management
- **`users`**
  - `id` (PK)
  - `name` (string)
  - `email` (string, unique)
  - `email_verified_at` (timestamp, nullable)
  - `password` (string)
  - `role` (enum: `admin`, `user` - default `user`)
  - `avatar` (string, nullable)
  - `remember_token`
  - `timestamps`

---

### ২. Al-Quran Module
- **`surahs`**
  - `id` (PK)
  - `number` (integer: 1-114, unique)
  - `name_arabic` (string)
  - `name_bangla` (string)
  - `name_english` (string)
  - `revelation_type` (enum: `Meccan`, `Medinan`)
  - `total_ayahs` (integer)
  - `timestamps`

- **`ayahs`**
  - `id` (PK)
  - `surah_id` (FK -> `surahs.id`)
  - `number` (integer - global ayah number 1-6236)
  - `number_in_surah` (integer - 1, 2, 3...)
  - `text_arabic` (text)
  - `audio_url` (string, nullable)
  - `sajdah` (boolean, default false)
  - `juz` (integer)
  - `page` (integer)
  - `timestamps`

- **`quran_translations`**
  - `id` (PK)
  - `ayah_id` (FK -> `ayahs.id`)
  - `language` (string: `bn`, `en` etc.)
  - `translator_name` (string: যেমন "মুহিউদ্দীন খান", "বায়ান ফাউন্ডেশন", "Sahih International")
  - `translation_text` (text)
  - `tafsir_text` (longText, nullable)
  - `timestamps`

---

### ৩. Hadith Module
- **`hadith_books`**
  - `id` (PK)
  - `title_bangla` (string - যেমন "সহিহ বুখারি")
  - `title_english` (string - "Sahih al-Bukhari")
  - `title_arabic` (string)
  - `slug` (string, unique)
  - `author_name` (string)
  - `total_hadiths` (integer)
  - `timestamps`

- **`hadith_chapters`**
  - `id` (PK)
  - `book_id` (FK -> `hadith_books.id`)
  - `chapter_number` (integer)
  - `name_bangla` (string)
  - `name_arabic` (string, nullable)
  - `timestamps`

- **`hadiths`**
  - `id` (PK)
  - `book_id` (FK -> `hadith_books.id`)
  - `chapter_id` (FK -> `hadith_chapters.id`)
  - `hadith_number` (integer/string)
  - `narrator` (string, nullable - রাবীর নাম)
  - `text_arabic` (text)
  - `text_bangla` (text)
  - `grade` (string, nullable - সহিহ/হাসান/যইফ)
  - `explanation` (text, nullable)
  - `timestamps`

---

### ৪. Dua & Azkar Module
- **`dua_categories`**
  - `id` (PK)
  - `name_bangla` (string - যেমন: "ঘুমের দোয়া", "নামাজের দোয়া")
  - `name_english` (string)
  - `slug` (string, unique)
  - `icon` (string, nullable)
  - `timestamps`

- **`duas`**
  - `id` (PK)
  - `category_id` (FK -> `dua_categories.id`)
  - `title_bangla` (string)
  - `text_arabic` (text)
  - `pronunciation_bangla` (text - উচ্চারণ)
  - `translation_bangla` (text - অর্থ)
  - `reference` (string, nullable - হাদিস/কুরআন রেফারেন্স)
  - `benefits` (text, nullable - ফজিলত)
  - `audio_url` (string, nullable)
  - `timestamps`

---

### ৫. Articles & Blog Module
- **`article_categories`**
  - `id` (PK)
  - `name` (string)
  - `slug` (string, unique)
  - `description` (text, nullable)
  - `timestamps`

- **`articles`**
  - `id` (PK)
  - `user_id` (FK -> `users.id` - Author)
  - `category_id` (FK -> `article_categories.id`)
  - `title` (string)
  - `slug` (string, unique)
  - `excerpt` (text, nullable)
  - `content` (longText)
  - `thumbnail` (string, nullable)
  - `status` (enum: `draft`, `published` - default `draft`)
  - `views_count` (integer, default 0)
  - `published_at` (timestamp, nullable)
  - `timestamps`

---

### ৬. User Interaction & Personalization Module
- **`bookmarks`** *(Polymorphic)*
  - `id` (PK)
  - `user_id` (FK -> `users.id`)
  - `bookmarkable_type` (string - e.g. `App\Models\Ayah`, `App\Models\Hadith`, `App\Models\Dua`, `App\Models\Article`)
  - `bookmarkable_id` (unsignedBigInteger)
  - `folder_name` / `note` (string, nullable)
  - `timestamps`

- **`reading_histories`**
  - `id` (PK)
  - `user_id` (FK -> `users.id`)
  - `trackable_type` (string - e.g. `App\Models\Surah`, `App\Models\HadithBook`)
  - `trackable_id` (unsignedBigInteger)
  - `last_position` (integer/string - যেমন শেষ পড়া আয়াত নম্বর)
  - `last_read_at` (timestamp)
  - `timestamps`

---

### ৭. Prayer Times & Islamic Calendar Module
- **`prayer_times`**
  - `id` (PK)
  - `city` (string)
  - `country` (string)
  - `latitude` (decimal)
  - `longitude` (decimal)
  - `date` (date)
  - `fajr` (time)
  - `sunrise` (time)
  - `dhuhr` (time)
  - `asr` (time)
  - `maghrib` (time)
  - `isha` (time)
  - `timestamps`

- **`islamic_events`**
  - `id` (PK)
  - `hijri_day` (integer)
  - `hijri_month` (integer)
  - `title_bangla` (string - যেমন: "শবে কদর", "ঈদুল ফিতর", "আশুরা")
  - `title_english` (string)
  - `description` (text, nullable)
  - `significance` (text, nullable)
  - `timestamps`

---

### ৮. Islamic Quiz Module
- **`quizzes`**
  - `id` (PK)
  - `title` (string - যেমন: "নবী-রাসূলদের জীবনী", "কুরআনের জ্ঞান")
  - `slug` (string, unique)
  - `description` (text, nullable)
  - `difficulty` (enum: `easy`, `medium`, `hard`)
  - `total_questions` (integer)
  - `timestamps`

- **`quiz_questions`**
  - `id` (PK)
  - `quiz_id` (FK -> `quizzes.id`)
  - `question_text` (text)
  - `explanation` (text, nullable - সঠিক উত্তরের ব্যাখ্যা)
  - `points` (integer, default 1)
  - `timestamps`

- **`quiz_answers`**
  - `id` (PK)
  - `question_id` (FK -> `quiz_questions.id`)
  - `answer_text` (string)
  - `is_correct` (boolean, default false)
  - `timestamps`

---

*ডকুমেন্ট আপডেট করা হয়েছে: ১৬ আগস্ট ২০২৬*
