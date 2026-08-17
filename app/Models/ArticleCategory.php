<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $fillable = [
        'name',
        'name_bangla',
        'slug',
        'description',
        'status',
        'sort_order',
    ];

    public function articles()
    {
        return $this->hasMany(
            Article::class,
            'article_category_id'
        );
    }
}
