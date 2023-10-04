<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.home');
    }

    public function posts() {
        $posts = Post::all()->where('user_id', '=', \Auth::user()->id)->sortByDesc('created_at');

        return view('user.posts', compact('posts'));
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
        if (Auth::user()->id !== $user->id) {
            return redirect()->route('user.index');
        }

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'profile-picture' => 'required|mimes:jpg,jpeg,png,gif,svg,webp|max:10000'
        ]);


        if ($request->file('profile-picture') !== null) {
            $image = $request->file('profile-picture');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img/users'), $filename);

            File::delete(public_path('img/users/' . $user->profile_picture));
            $user->profile_picture = $filename;
        }

        $user->name = $request->input('name');


        $user->save();

        return redirect()->route('user.posts');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
