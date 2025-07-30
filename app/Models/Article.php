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

    public function category(): BelongsTo
    {
        return $this->BelongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public static function search($query)
    {
        $relations = ['comments', 'category'];

        return empty($query) ? static::query()->with($relations)
            : static::with($relations)
                ->where('title', 'like', '%'.$query.'%')
                ->orWhere('source', 'like', '%'.$query.'%')
                ->orWhere('author', 'like', '%'.$query.'%');
    }
}
