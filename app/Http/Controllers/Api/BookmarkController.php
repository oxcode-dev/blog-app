<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Models\Article;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Validator;
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

    public function userBookmark(Request $request) 
    {
        $user =  $request->user();

        $articles = Bookmark::with('article')
            ->where('user_id', $user['id'])
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

    public function updateBookmark(Request $request) 
    {

        $validator = Validator::make($request->all(), [
            'article_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user =  $request->user();

        $input = $request->all();
        if (Bookmark::where('user_id',  $user['id'])->where('article_id', $input['article_id'])->exists()) {
            $bookmark = Bookmark::where('user_id',  $user['id'])->where('article_id', $input['article_id'])->first();
            $bookmark->delete();

            return $this->sendResponse(
                'Bookmark Removed Successfully', 
                'Bookmark Removed.'
            );
        }
        $bookmark = new Bookmark();
        $bookmark->user_id =  $user['id'];
        $bookmark->article_id = $input['article_id'];

        $bookmark->save();

        return $this->sendResponse(
            'Bookmark Added Successfully', 
            'Bookmark Added.'
        );
    }
}
