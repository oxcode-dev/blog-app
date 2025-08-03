<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends BaseController
{
    public function index() 
    {
        return response()->json([
            'data' => Comment::withCount('article')->get(),
        ]);
    }

    public function show(Comment $comment) {
        return response()->json([
            'data' => $comment::with('article')->firstOrFail(),
        ]);
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'parent_id' => 'nullable',
            'article_id' => 'required',
            'content' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user =  $request->user();

        $comment = new Comment();

        $comment->parent_id = $request->parent_id;
        $comment->article_id = $request->article_id;
        $comment->content = $request->content;
        $comment->user_id = $user->name;

        $comment->save();
        
        return $this->sendResponse(
            'Article comment saved successfully.',
            'Article Comment Saved!!!.',
        );
    }

    public function destroy(Request $request, Comment $comment) 
    {
        Comment::find($comment->id)?->delete();
        
        
        return $this->sendResponse(
            'Article comment deleted successfully.',
            'Article Comment Deleted!!!.',
        );
    }
}
