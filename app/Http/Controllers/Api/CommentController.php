<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
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
}
