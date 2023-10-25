<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use function Laravel\Prompts\select;


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
        if (Auth::guest()) {
            $posts = Post::all()->sortByDesc('created_at')->where('status', '=', '1');
        } else {
            $posts = Post::all()->sortByDesc('created_at')->where('user_id', '!=', Auth::user()->id)->where('status', '=', '1');
        }

        return view('posts.home', compact('posts'));
    }

    /**
     * Display a listing of the resource based on a query
     */
    public function find(Request $request)
    {
//        $request->validate([
//            'query' => 'string'
//        ]);

        $tagsString = $request->input('tags');
        $tags = explode(' ', $tagsString);

        $wildcard = '%' . $request->input('query') . '%';

//        $posts = Post::where('description', 'LIKE', $wildcard)->where('status', '=', '1')->get()->sortByDesc('created_at');

//        $posts = Post::where('description', 'LIKE', $wildcard)
//            ->where('status', '=', '1')
//            ->whereExists(function (Builder $query) use ($tags) {
//                foreach ($tags as $tag) {
//                    $query->orWhere('tags', '=', $tag);
//                }
//        })->get()->sortByDesc('created_at');

        $query = Post::where('status', '=', '1')->with('tags');

        if (!empty($request->input('query'))) {
            $query->where('description', 'LIKE', $wildcard);
        }
        if (!empty($request->input('tags'))) {
            $query->whereHas('tags', function (Builder $query) use ($tags) {
                foreach ($tags as $tag) {
                    $query->where('tags.id', '=', $tag);
                }
            });
//                ->toSql());
        }
        $posts = $query->get()->sortByDesc('created_at');

        return view('posts.search', compact('posts'));
    }

    public function status(Post $post) {
        if (Auth::user()->id !== $post->user_id) {
            return redirect()->route('posts.index');
        }
        $post->status = !$post->status;

        $post->save();

        return redirect()->route('user.posts');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $likes = Auth::user()->likes()->count();
        if ($likes >= 5 || Auth::user()->admin === 1) {
            return view('posts.create');
        }
        return redirect()->route('posts.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $likes = Auth::user()->likes()->count();
        if ($likes < 5 && Auth::user()->admin != 1) {
            return redirect()->route('posts.index');
        }

        $data = $this->validator($request->all())->validate();

        $filename = '';
        if (isset($data['image'])) {
            $image = $data['image'];
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img/posts'), $filename);
        }

        $post = Post::create([
            'description' => $data['description'],
            'image' => $filename,
            'status' => 1,
            'user_id' => Auth::user()->id,
        ]);

        unset($data['description'], $data['image']);

        foreach ($data as $item) {
            $post->tags()->attach($item);
        }

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if ($post->status != 1) {
            return redirect()->route('posts.index');
        }
        return view('posts.show', compact('post'));
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

        $data = $this->validator($request->all())->validate();

        if (isset($data['image'])) {
            $image = $data['image'];
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img/posts'), $filename);

            File::delete(public_path('img/posts/' . $post->image));
            $post->image = $filename;
        }

        $post->description = $data['description'];

        $post->save();

        //todo: MAKE THE FUCKING TAGS BE EDITABLE :(((((((((

        return redirect()->route('user.posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) {
            return redirect()->route('user.posts');
        }

        $post->delete();

        return redirect()->route('user.posts');
    }

    protected function validator(array $data)
    {
        $tags = Tag::all();
        $validationArray = [
            'description' => ['required', 'string', 'max:255'],
            'image' => ['mimes:jpg,jpeg,png,gif,svg,webp', 'max:10000']
        ];
        foreach ($tags as $tag) {
            $validationArray[$tag->name] = ['numeric'];
        }
        return Validator::make($data, $validationArray);
    }
//    protected function validatorTags(array $data)
//    {
//        $tags = Tag::all();
//        $validationArray = [];
//        foreach ($tags as $tag) {
//            $validationArray[$tag->id] = ['numeric'];
//        }
//        return Validator::make($data, $validationArray);
//    }
}
