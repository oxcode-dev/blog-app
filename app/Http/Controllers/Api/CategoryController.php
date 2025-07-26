<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() 
    {
        return response()->json([
            'data' => Category::withCount('articles')->get(),
        ]);
    }

    public function show(Category $category) {
        return response()->json([
            'data' => $category::with('articles')->firstOrFail(),
        ]);
    }
}
