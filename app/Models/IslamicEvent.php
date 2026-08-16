<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IslamicEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_bangla',
        'description',
        'hijri_month',
        'hijri_day',
        'hijri_year',
        'gregorian_date',
        'slug',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'gregorian_date' => 'date',
            'status' => 'boolean',
            'hijri_month' => 'integer',
            'hijri_day' => 'integer',
            'hijri_year' => 'integer',
        ];
    }
}
