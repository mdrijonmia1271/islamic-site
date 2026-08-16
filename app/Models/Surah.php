<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Surah extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'number',
        'name_arabic',
        'name_english',
        'name_bangla',
        'revelation_place',
        'ayah_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'number' => 'integer',
            'ayah_count' => 'integer',
        ];
    }

    /**
     * Get all the Ayahs for this Surah.
     */
    public function ayahs(): HasMany
    {
        return $this->hasMany(Ayah::class)->orderBy('ayah_number', 'asc');
    }

    /**
     * Scope a query to sort by Surah number.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('number', 'asc');
    }
}
