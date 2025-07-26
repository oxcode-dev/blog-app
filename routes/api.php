<?php

use App\Http\Controllers\Api\ArticleController;
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
        'articles' => Article::get(),
        'articles' => Article::with('category', 'comments')->get(),
        'categories' => Category::with('articles')->get(),
        'comments' => Comment::all(),
    ]);
});

Route::prefix('articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('api.articles');
    Route::get('/{article}', [ArticleController::class, 'show'])->name('api.articles_show');
});
