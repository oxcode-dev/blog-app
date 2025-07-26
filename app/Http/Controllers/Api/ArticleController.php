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
