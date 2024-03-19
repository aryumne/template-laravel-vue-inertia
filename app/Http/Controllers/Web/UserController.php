<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::paginate($this->defaultPaginate);
        return inertia('User/Index', ["data" => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
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
    public function edit(User $user)
    {
        return inertia('User/Edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $rules = [
            'name' => ['required'],
            'role' => ['required'],
            'phone' => ['required'],
            'is_active' => ['required'],
        ];
        if ($request->email !== $user->email) {
            $rules['email'] = ['required', 'max:50', 'unique:users,email'];
        }

        if ($request->hasFile('profile_pict')) {
            $rules['profile_pict'] = ['required', 'file', 'mimes:jpg,bpm,jpeg,png'];
        }
        $request->validate($rules);

        isset($request->name)   && $user->name  = $request->name;
        isset($request->email)  && $user->email = $request->email;
        isset($request->role)   && $user->role  = $request->role;
        isset($request->phone)  && $user->phone = $request->phone;
        isset($request->is_active) && $user->is_active = $request->is_active;

        if ($request->hasFile('profile_pict') && $request->file('profile_pict')->isValid()) {
            $path = $request->file('profile_pict')->store('profile-pictures');
            $user->profile_pict = $path;
        }
        $user->save();
        return back()->with('message', "User updated successfully!");
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
