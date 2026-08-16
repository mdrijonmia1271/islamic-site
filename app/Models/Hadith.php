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
}
