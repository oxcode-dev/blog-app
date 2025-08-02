<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index(Request $request)//: Response
    {
        $articles = Article::search($request->get('search', ''))
            ->orderBy(
                $request->get('sortField', 'created_at'),
                $request->get('sortAsc') === 'true' ? 'asc' : 'desc'
            )    
            ->paginate($request->get('perPage', 10));

        return Inertia::render('articles/index', [
            'status' => $request->session()->get('status'),
            'articles' => $articles,
        ]);
    }

    public function view(Request $request, Article $article)//: Response
    {
        $article = $article::with('category', 'comments')->firstOrFail();

        return Inertia::render('articles/show', [
            'status' => $request->session()->get('status'),
            'article' => $article,
        ]);
    }
}