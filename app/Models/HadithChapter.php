<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HadithChapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'hadith_book_id',
        'chapter_number',
        'name',
        'name_bangla',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'chapter_number' => 'integer',
        ];
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(HadithBook::class, 'hadith_book_id');
    }

    public function hadiths(): HasMany
    {
        return $this->hasMany(Hadith::class);
    }
}
