<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\DuaCategory;
use App\Models\HadithBook;
use App\Models\Surah;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate complete website XML sitemap for SEO';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Generating website sitemap...');

        $sitemap = Sitemap::create();

        // 1. Core Public Pages
        $sitemap->add(
            Url::create(url('/'))
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(1.0)
        );

        $sitemap->add(
            Url::create(route('articles.index'))
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.9)
        );

        $sitemap->add(
            Url::create(route('quran.index'))
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9)
        );

        $sitemap->add(
            Url::create(route('hadith.index'))
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9)
        );

        $sitemap->add(
            Url::create(route('duas.index'))
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9)
        );

        $sitemap->add(
            Url::create(route('prayer-times.index'))
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.8)
        );

        $sitemap->add(
            Url::create(route('islamic-calendar.index'))
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8)
        );

        // 2. Published Articles (SEO Priority)
        $articleCount = 0;
        Article::where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->each(function ($article) use ($sitemap, &$articleCount) {
                $sitemap->add(
                    Url::create(route('articles.show', $article))
                        ->setLastModificationDate($article->updated_at ?? $article->published_at ?? Carbon::now())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.8)
                );
                $articleCount++;
            });

        // 3. Article Categories
        ArticleCategory::where('status', true)->each(function ($category) use ($sitemap) {
            $sitemap->add(
                Url::create(route('articles.index', ['category' => $category->slug]))
                    ->setLastModificationDate(Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.7)
            );
        });

        // 4. Quran Surahs (114 Surahs if present)
        if (class_exists(Surah::class)) {
            Surah::all()->each(function ($surah) use ($sitemap) {
                $sitemap->add(
                    Url::create(route('quran.show', $surah->number))
                        ->setLastModificationDate($surah->updated_at ?? Carbon::now())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.8)
                );
            });
        }

        // 5. Hadith Books
        if (class_exists(HadithBook::class)) {
            HadithBook::all()->each(function ($book) use ($sitemap) {
                $sitemap->add(
                    Url::create(route('hadith.show', $book->slug ?? $book->id))
                        ->setLastModificationDate($book->updated_at ?? Carbon::now())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.7)
                );
            });
        }

        // 6. Dua Categories
        if (class_exists(DuaCategory::class)) {
            DuaCategory::all()->each(function ($category) use ($sitemap) {
                $sitemap->add(
                    Url::create(route('duas.category', $category->slug ?? $category->id))
                        ->setLastModificationDate($category->updated_at ?? Carbon::now())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.7)
                );
            });
        }

        $sitemapPath = public_path('sitemap.xml');
        $sitemap->writeToFile($sitemapPath);

        $this->info("Sitemap generated successfully at {$sitemapPath}");
        $this->line("Indexed {$articleCount} published articles.");

        return Command::SUCCESS;
    }
}
