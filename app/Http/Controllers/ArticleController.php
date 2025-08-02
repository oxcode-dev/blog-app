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
        return Inertia::render('Articles', [
            'status' => $request->session()->get('status'),
            'articles' => $articles,
        ]);
    }

    public function view(Request $request, Article $article)//: Response
    {
        dd($article::with('category', 'comments')->firstOrFail()->toArray());
    }
}