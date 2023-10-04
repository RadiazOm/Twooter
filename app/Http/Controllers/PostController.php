<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all()->sortByDesc('created_at')->where('user_id', '!=', Auth::user()->id);

        return view('posts.home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validator($request->all())->validate();

        $filename = '';
        if (isset($data['image'])) {
            $image = $data['image'];
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img/posts'), $filename);
        }

        Post::create([
            'description' => $data['description'],
            'image' => $filename,
            'status' => 1,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) {
            return redirect()->route('posts.index');
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->id !== $post->user_id) {
            return redirect()->route('posts.index');
        }

        dd($post);

        $data = $this->validator($request->all())->validate();

        if (isset($data['image'])) {
            $image = $data['image'];
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img/posts'), $filename);

            $post->image = $filename;
        }

        $post->description = $data['description'];

        $post->save();

        return redirect()->route('profile.posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) {
            return redirect()->route('profile.posts');
        }

        $post->delete();

        return redirect()->route('profile.posts');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'description' => ['required', 'string', 'max:255'],
            'image' => ['mimes:jpg,jpeg,png,gif,svg,webp', 'max:10000']
        ]);
    }
}
