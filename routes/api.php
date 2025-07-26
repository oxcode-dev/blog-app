<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function (Request $request) {
    return response()->json([
        'hello' => 'world',
        'articles' => Article::all(),
        'categories' => Category::all(),
        'comments' => Comment::all(),
    ]);
});