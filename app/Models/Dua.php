<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dua extends Model
{
    use HasFactory;

    protected $fillable = [
        'dua_category_id',
        'title',
        'title_bangla',
        'arabic_text',
        'transliteration',
        'bangla_meaning',
        'english_meaning',
        'reference',
        'source',
        'audio_url',
        'status',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(DuaCategory::class, 'dua_category_id');
    }

    /**
     * Get all of the dua's favorites.
     */
    public function favorites(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(
            Favorite::class,
            'favoritable'
        );
    }
}
