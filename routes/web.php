<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('articles')->group(function() {
    Route::get('/', [ArticleController::class, 'index'])->name('articles');
    Route::get('/create', [ArticleController::class, 'index'])->name('articles.create');
    Route::get('/{article}/edit', [ArticleController::class, 'view'])->name('articles.edit');
    Route::get('/{article}', [ArticleController::class, 'view'])->name('articles.view');
})->middleware(['auth', 'verified']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
