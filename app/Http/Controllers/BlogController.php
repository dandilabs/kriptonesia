<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class BlogController extends Controller
{
    public function index(Post $posts){
        $data = $posts->orderBy('created_at', 'desc')->get();
        return view('blog', compact('data'));
    }

    public function isi_post($slug) {
        $data = Post::where('slug', $slug)->get();
        return view('blog.isi_post', compact('data'));
    }
}
