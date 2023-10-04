<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'profile-picture' => 'mimes:jpg,jpeg,png,gif,svg,webp|max:10000'
        ]);

        dd($user);

        if ($request->input('profile-picture') !== null) {
            $image = $request->input('profile-picture');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img/users'), $filename);

            $user->profile_picture = $filename;
        }

        $user->name = $request->input('name');

        $user->save();

        return redirect()->route('profile.posts');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
