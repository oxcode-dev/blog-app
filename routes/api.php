<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\API\RegisterController;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/forgot-password', [PasswordResetController::class, 'forgot']);//->middleware('auth:sanctum');


Route::get('/user', function (Request $request) {
    if($request->user()) {
        return $request->user();
    }
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
    Route::get('/{article}/comments', [ArticleController::class, 'comments'])->name('api.articles_comments');
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('api.categories');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('api.categories_show');
    Route::get('/{category}/articles', [CategoryController::class, 'articles'])->name('api.categories_articles');
});

Route::prefix('comments')->group(function () {
    Route::get('/', [CommentController::class, 'index'])->name('api.comments');
    Route::get('/{comment}', [CommentController::class, 'show'])->name('api.comments_show');
});