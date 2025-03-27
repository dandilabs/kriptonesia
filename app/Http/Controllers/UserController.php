<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required|min:3|max:20',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        if ($request->input('password')) {
            $password = bcrypt($request->password);
        } else {
            $password = bcrypt('asdqwe123');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $password,
        ]);
        return redirect()->route('user.index')->with('success', 'Users add successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with(['payments' => function($query) {
            $query->latest();
        }])
        ->findOrFail($id);

    return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'name' => 'required|min:3|max:20',
            'role' => 'required',
        ]);

        if ($request->input('password')) {
            $user_data = [
                'name'      => $request->name,
                'role'      => $request->role,
                'password'  => bcrypt($request->password)
            ];
        } else {
            $user_data = [
                'name' => $request->name,
                'role' => $request->role
            ];
        }

        $user = User::find($id);
        $user->update($user_data);

        return redirect()->route('user.index')->with('success', 'Users update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'Users deleted successfully');
    }
}
