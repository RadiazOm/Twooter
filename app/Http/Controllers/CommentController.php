<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post) {

        $request->validate([
            'description' => 'required|string',
        ]);

        Comment::create([
            'description' => $request->input('description'),
            'post_id' => $post->id,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('posts.show', $post);
    }
}
