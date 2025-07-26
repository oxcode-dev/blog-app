<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    // public function article()
    // {
    //     return $this->belongsTo(Article::class);
    // }

     public function articles()
    {
        return $this->hasMany(Category::class);
    }
}
