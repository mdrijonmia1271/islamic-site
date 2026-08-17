<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ReadingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'readable_type',
        'readable_id',
        'last_read_at',
    ];

    protected $casts = [
        'last_read_at' => 'datetime',
    ];

    /**
     * Get the parent readable model (Article, Hadith, Dua, Surah, Ayah).
     */
    public function readable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user that owns the reading history record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
