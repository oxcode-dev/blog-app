<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'author',
        'description',
        'content',
        'url',
        'image',
        'source',
        'category_id' 
    ];

    // public function category()
    // {
    //     return $this->hasMany(Category::class);
    // }

    public function talent(): BelongsTo
    {
        return $this->category(Category::class);
    }
}
