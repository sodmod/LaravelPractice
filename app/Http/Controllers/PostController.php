<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        // TODO: Implement middleware() method.
        return [
            new Middleware('auth',
                except: ['index','store']
            )];
    }

    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        $posts = Post::latest()->paginate(6);

//            Post::latest()->get();
//            Post::orderBy("created_at", "desc")-> get();

        return view("posts.index", ["posts"=>$posts]);
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
    public function store(Request $request):string
    {
        // validate
        $fields = $request->validate([
            'title' => ['required', 'max:225'],
            'body' => ['required']
        ]);

        Auth::user()->posts()->create($fields);

        return back()->with('success', 'Your post was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post):string
    {
        //
        return view('posts.show', ['post'=>$post]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post):View
    {
        //
        Gate::authorize('modify',$post);

        return view('posts.edit', ['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('modify',$post);

        // validate
        $fields = $request->validate([
            'title' => ['required', 'max:225'],
            'body' => ['required']
        ]);

        $post->update($fields);

        return redirect()->route('dashboard')->with("success",
        'Your post was updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post):string
    {
        //
        Gate::authorize('modify',$post);
        $post->delete();

        return back()->with('delete', 'Your post was deleted');
    }

}
