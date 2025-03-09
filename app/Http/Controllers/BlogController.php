<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Post $posts){
        $data = $posts->orderBy('created_at', 'desc')->get();
        return view('blog', compact('data'));
    }
}
