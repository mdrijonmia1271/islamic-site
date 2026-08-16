<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'country',
        'date',
        'fajr',
        'sunrise',
        'dhuhr',
        'asr',
        'maghrib',
        'isha',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
}
