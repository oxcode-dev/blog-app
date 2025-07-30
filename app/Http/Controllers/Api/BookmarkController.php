<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Models\Article;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends BaseController
{
    public function index() 
    {
        return response()->json([
            'data' => Bookmark::withCount('article')->get(),
        ]);
    }

    public function show(Bookmark $bookmark) {
        return response()->json([
            'data' => $bookmark::withCount('article')->firstOrFail(),
        ]);
    }

    public function articles(Request $request, Bookmark $bookmark) 
    {
        $articles = Article::search($request->get('search', ''))
            ->where('bookmark_id', $bookmark->id)
            ->orderBy(
                $request->get('sortField', 'created_at'),
                $request->get('sortAsc') === 'true' ? 'asc' : 'desc'
            )    
            ->paginate($request->get('perPage', 5));
        
        return $this->sendResponse(
            $articles, 
            'Category Articles fetched successfully.'
        );
    }
}
