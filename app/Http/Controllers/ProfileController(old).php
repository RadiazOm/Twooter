<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileControllerOld extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('profile.home');
    }

    public function posts() {
        $posts = Post::all()->where('user_id', '=', \Auth::user()->id)->sortByDesc('created_at');

        return view('profile.posts', compact('posts'));
    }

    public function edit() {
        $user = User::find(\Auth::user()->id);

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
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
}
