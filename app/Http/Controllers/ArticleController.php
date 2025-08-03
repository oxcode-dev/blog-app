<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
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
        $article = $article::with('category', 'comments')->whereId($article->id)->firstOrFail();

        return Inertia::render('articles/show', [
            'status' => $request->session()->get('status'),
            'article' => $article,
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('articles/Form', [
            'status' => $request->session()->get('status'),
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'description' => ['sometimes'],
            'author' => ['sometimes'],
            'image' => ['sometimes', 'url'],
            'url' => ['sometimes', 'url'],
            'category_id' => ['required'],
            'source' => ['sometimes'],
        ]);

        $article = $request->input('id') !== null 
                    ? Article::find($request->input('id'))
                    : new Article();

        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->description = $data['description'];
        $article->author = $data['author'];
        $article->image = $data['image'];
        $article->url = $data['url'];
        $article->source = $data['source'];
        $article->category_id = $data['category_id'];

        $article->save();

        return back()->with([
            'status' => $request->session()->get('status'),
            'article' => $article,
        ]);
    }

    public function edit(Request $request, Article $article)
    {
        return Inertia::render('articles/Form', [
            'status' => $request->session()->get('status'),
            'article' => $article,
            'categories' => Category::all(),
        ]);
    }

    public function delete(Request $request, Article $article)
    {
        dd($article, $request->all());
        
        return Inertia::render('articles/Form', [
            'status' => $request->session()->get('status'),
            'article' => $article,
            'categories' => Category::all(),
        ]);
    }
}