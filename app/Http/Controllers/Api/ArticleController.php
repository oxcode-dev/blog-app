<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request) 
    {
        return response()->json([
            'data' => Article::search($request->get('search', ''))->get(),
        ]);
    }

    public function show(Article $article) {
        return response()->json([
            'data' => $article::with('category', 'comments')->first(),
        ]);
    }
}


// $products = Product::when($request->has('category'), function ($query) use ($request) {
//     $query->where('category_id', $request->input('category'));
// })->when($request->has('min_price'), function ($query) use ($request) {
//     $query->where('price', '>=', $request->input('min_price'));
// })->get();