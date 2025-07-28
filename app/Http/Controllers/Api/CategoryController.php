<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index() 
    {
        return response()->json([
            'data' => Category::withCount('articles')->get(),
        ]);
    }

    public function show(Category $category) {
        return response()->json([
            'data' => $category::withCount('articles')->firstOrFail(),
        ]);
    }

    public function articles(Request $request, Category $category) 
    {
        $articles = Article::search($request->get('search', ''))->where('category_id', $category->id)->get();
        return $this->sendResponse($articles, 'Category Articles fetched successfully.');
    }
}
