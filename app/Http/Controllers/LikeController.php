<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Post $post) {
        if ($post->likes()->where('user_id', '=', Auth::id())->exists()) {
            $post->likes()->where('user_id', '=', Auth::id())->delete();
        } else {
            Like::create([
                'post_id' => $post->id,
                'user_id' => Auth::id()
            ]);
        }
        return redirect()->route('posts.index');
    }
}
