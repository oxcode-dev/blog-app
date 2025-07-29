<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    public function index(Request $request) 
    {
        $articles = Article::search($request->get('search', ''))->paginate(3);

        return $this->sendResponse(
            $articles,
            'Articles fetched successfully.'
        );
    }

    public function show(Article $article) {
        return $this->sendResponse(
            $article::with('category', 'comments')->first(), 
            'Article fetched successfully.'
        );
    }

    public function comments(Request $request, Article $article) 
    {
        $comments = Comment::where('article_id', $article->id)->get();
        
        return $this->sendResponse(
            $comments, 
            'Article comments fetched successfully.'
        );
    }
}


// $products = Article::when($request->has('category'), function ($query) use ($request) {
//     $query->where('category_id', $request->input('category'));
// })->when($request->has('min_price'), function ($query) use ($request) {
//     $query->where('price', '>=', $request->input('min_price'));
// })->get();