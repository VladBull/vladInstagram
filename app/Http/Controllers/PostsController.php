<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $users = auth()->user()->profile->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
    
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function delete(Post $post)
    {
        // Authorization to ensure user has perm to delete
        $this->authorize('delete', $post);

        $post->delete();

        return redirect('/')->with('success', 'Post deleted Successfully');
    }

    public function store()
    {
        $data = request()->validate([
           'caption' => 'required',
           'image' => 'required|image' 
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        //TODO: This error should be because of VSC. Tested on PHStorm and it's ok.
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
        
    }

    public function show(\App\Models\Post $post) {
        
        return view('posts.show', compact('post'));

        // Another way to do the above is -
        
        // return view('posts.show' , [
        //     'post' => $post
        // ]);
    }

}
