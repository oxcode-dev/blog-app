<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 
        'slug',
        'description',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public static function search($query)
    {
        $relations = ['articles'];

        return empty($query) ? static::query()->with($relations)
            : static::with($relations)
                ->where('name', 'like', '%'.$query.'%')
                ->orWhere('slug', 'like', '%'.$query.'%');
    }
}
