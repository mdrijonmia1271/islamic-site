<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_category_id',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
        'explanation',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(QuizCategory::class, 'quiz_category_id');
    }
}
