<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DuaCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_bangla',
        'slug',
        'description',
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

    public function duas(): HasMany
    {
        return $this->hasMany(Dua::class)->orderBy('sort_order', 'asc');
    }
}
