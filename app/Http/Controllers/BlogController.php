<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class BlogController extends Controller
{
    public function index(Post $posts){
        $category_sidebar = Category::all();
        $data = Post::latest()->paginate(6);
        return view('blog', compact('data','category_sidebar'));
    }

    public function isi_post($slug) {
        $category_sidebar = Category::all();
        $data = Post::where('slug', $slug)->get();
        return view('blog.isi_post', compact('data','category_sidebar'));
    }

    public function list_post(Post $posts) {
        $category_sidebar = Category::all();
        $data = Post::latest()->paginate(3);
        return view('blog.list', compact('data','category_sidebar'));
    }

    public function list_category(Category $category) {
        $category_sidebar = Category::all();
        $data = $category->posts()->paginate(3);
        return view('blog.list', compact('category_sidebar','data'));
    }
}
