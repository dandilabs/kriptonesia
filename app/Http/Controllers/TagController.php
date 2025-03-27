<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Tag::latest()->get();
        return view('admin.tag.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required|min:3'
        ]);

        $tag = Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        Alert::success('Tags add successfully');
        return redirect()->route('tag.index');
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
        $tag = Tag::findOrFail($id);
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'name' => 'required|min:3'
        ]);

        $tags_data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        Tag::whereId($id)->update($tags_data);
        Alert::success('Tags updated successfully');
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tags = Tag::findOrFail($id);
        $tags->delete();
        Alert::success('Tags successfully deleted');
        return redirect()->back();
    }
}
