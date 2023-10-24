<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $this->admin();

        return redirect()->route('tags.index');
    }

    protected function admin() {
        if (Auth::user()->admin != 1) {
            return redirect()->route('posts.index');
        }
    }
}
