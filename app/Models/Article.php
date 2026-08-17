<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'article_category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'status',
        'published_at',
        'views',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(
            ArticleCategory::class,
            'article_category_id'
        );
    }

    /**
     * Get all of the article's favorites.
     */
    public function favorites(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(
            Favorite::class,
            'favoritable'
        );
    }

    /**
     * Get all of the article's bookmarks.
     */
    public function bookmarks(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(
            Bookmark::class,
            'bookmarkable'
        );
    }

    /**
     * Get all of the article's reading histories.
     */
    public function readingHistories(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(
            ReadingHistory::class,
            'readable'
        );
    }
}
