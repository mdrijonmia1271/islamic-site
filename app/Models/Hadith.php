<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hadith extends Model
{
    use HasFactory;

    protected $fillable = [
        'hadith_book_id',
        'hadith_chapter_id',
        'hadith_number',
        'arabic_text',
        'bangla_text',
        'english_text',
        'narrator',
        'grade',
        'reference',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'hadith_number' => 'integer',
            'status' => 'boolean',
        ];
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(HadithBook::class, 'hadith_book_id');
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(HadithChapter::class, 'hadith_chapter_id');
    }

    /**
     * Get all of the hadith's favorites.
     */
    public function favorites(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(
            Favorite::class,
            'favoritable'
        );
    }

    /**
     * Get all of the hadith's bookmarks.
     */
    public function bookmarks(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(
            Bookmark::class,
            'bookmarkable'
        );
    }

    /**
     * Get all of the hadith's reading histories.
     */
    public function readingHistories(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(
            ReadingHistory::class,
            'readable'
        );
    }
}
