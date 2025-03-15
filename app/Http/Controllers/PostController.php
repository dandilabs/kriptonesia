<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::latest()->get();
        return view('admin.posts.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category_data = Category::all();
        $tags_data = Tag::all();
        return view('admin.posts.create', compact('category_data','tags_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'judul'         => 'required|min:3',
            'categories_id' => 'required',
            'content'       => 'required',
            'image'         => 'required'
        ]);

        $image_data = $request->image;
        $new_image = time().$image_data->getClientOriginalName();

        $post = Post::create([
            'judul'         => $request->judul,
            'slug'          => Str::slug($request->judul),
            'categories_id'   => $request->categories_id,
            'content'       => $request->content,
            'image'         => 'public/uploads/posts/'. $new_image,
            'users_id'      => Auth::id()
        ]);

        $post->tags()->attach($request->tags);

        $image_data->move('public/uploads/posts/', $new_image);

        return redirect()->route('post.index')->with('success', 'Posts create successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category_data = Category::all();
        $tags_data = Tag::all();
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post','tags_data','category_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'judul'         => 'required|min:3',
            'categories_id'   => 'required',
            'content'       => 'required',
        ]);

        $post = Post::findOrFail($id);

        if($request->has('image')) {
            $image_data = $request->image;
            $new_image = time().$image_data->getClientOriginalName();
            $image_data->move('public/uploads/posts/', $new_image);

            $post_data = [
                'judul'         => $request->judul,
                'slug'          => Str::slug($request->judul),
                'categories_id' => $request->categories_id,
                'content'       => $request->content,
                'image'         => 'public/uploads/posts/'. $new_image
            ];
        } else {
            $post_data = [
                'judul'         => $request->judul,
                'slug'          => Str::slug($request->judul),
                'categories_id' => $request->categories_id,
                'content'       => $request->content,
            ];
        }

        $post->tags()->sync($request->tags);
        $post->update($post_data);

        return redirect()->route('post.index')->with('success', 'Posts updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->back()->with('success', 'Posts deleted successfully, cek your list trashed');
    }

    public function trashed(){
        $post = Post::onlyTrashed()->get();
        return view('admin.posts.hapus', compact('post'));
    }

    public function restore($id){
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();

        return redirect()->back()->with('success', 'Posts restore successfully');
    }

    public function delete($id){
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();

        return redirect()->route('post.index')->with('success', 'Posts deleted permanent successfully');
    }
}
