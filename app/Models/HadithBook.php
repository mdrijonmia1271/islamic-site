<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HadithBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_bangla',
        'description',
        'author',
        'slug',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(HadithChapter::class)->orderBy('chapter_number', 'asc');
    }

    public function hadiths(): HasMany
    {
        return $this->hasMany(Hadith::class);
    }
}
