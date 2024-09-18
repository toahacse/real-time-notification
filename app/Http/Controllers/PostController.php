<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Events\TestNotification;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'author' => 'required|string|max:255',
            'title' => 'required|string|max:255',
        ]);

        // Create the post
        $post = Post::create([
            'author' => $request->input('author'),
            'title' => $request->input('title'),
        ]);

        // Dispatch the event with the post data
        event(new TestNotification([
            'author' => $post->author,
            'title' => $post->title,
        ]));

        // Redirect with success message
        return redirect()->back()->with('success', 'Post created successfully!');
    }

}
