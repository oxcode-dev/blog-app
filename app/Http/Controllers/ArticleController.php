<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index(Request $request)//: Response
    {

        // dd('Hello World');
        return Inertia::render('Articles', [
            'status' => $request->session()->get('status'),
        ]);
    }
}