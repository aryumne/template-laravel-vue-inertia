<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::paginate(7);
        return inertia('User/Index', ["data" => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'role' => ['required'],
            'email' => ['required', 'max:50', 'unique:users,email'],
            'phone' => ['required'],
            'password' => ['required'],
            'profile_pict' => ['required', 'file', 'mimes:jpg,bpm,jpeg,png']
        ]);

        if ($request->file('profile_pict')->isValid()) {
            $path = $request->file('profile_pict')->store('profile-pictures');
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'role' => $request->role,
                'profile_pict' => $path
            ]);
        }
        return to_route('users.index')->with('message', "User created successfully!");
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return to_route('users.index')->with('message', "User deleted successfully!");
    }
}
