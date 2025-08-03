<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(Request $request)//: Response
    {
        $categories = Category::search($request->get('search', ''))
            ->orderBy(
                $request->get('sortField', 'created_at'),
                $request->get('sortAsc') === 'true' ? 'asc' : 'desc'
            )    
            ->paginate($request->get('perPage', 10));

        return Inertia::render('categories/index', [
            'status' => $request->session()->get('status'),
            'categories' => $categories,
        ]);
    }

    public function view(Request $request, Category $category)//: Response
    {
        $category = $category::with('category', 'comments')->whereId($category->id)->firstOrFail();

        return Inertia::render('categories/show', [
            'status' => $request->session()->get('status'),
            'category' => $category,
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('categories/Form', [
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

        $category = $request->input('id') !== null 
                    ? Category::find($request->input('id'))
                    : new Category();

        $category->title = $data['title'];
        $category->content = $data['content'];
        $category->description = $data['description'];
        $category->author = $data['author'];
        $category->image = $data['image'];
        $category->url = $data['url'];
        $category->source = $data['source'];
        $category->category_id = $data['category_id'];

        $category->save();

        return back()->with([
            'status' => $request->session()->get('status'),
            'category' => $category,
        ]);
    }

    public function edit(Request $request, Category $category)
    {
        return Inertia::render('categories/Form', [
            'status' => $request->session()->get('status'),
            'category' => $category,
            'categories' => Category::all(),
        ]);
    }

    public function delete(Request $request, Category $category)
    {
        $category->delete();

        return redirect('/categories')->with([
            'status' => $request->session()->get('status'),
        ]);
    }
}
