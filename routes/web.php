<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
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
    Route::get('/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/store', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::delete('/{article}/delete', [ArticleController::class, 'delete'])->name('articles.delete');
    Route::get('/{article}', [ArticleController::class, 'view'])->name('articles.view');
})->middleware(['auth', 'verified']);

Route::prefix('categories')->group(function() {
    Route::get('/', [CategoryController::class, 'index'])->name('categories');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::delete('/{category}/delete', [CategoryController::class, 'delete'])->name('categories.delete');
    Route::get('/{category}', [CategoryController::class, 'view'])->name('categories.view');
})->middleware(['auth', 'verified']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
