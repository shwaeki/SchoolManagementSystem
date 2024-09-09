<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Models\PostPhotos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePostsRequest $request)
    {
        $user = Auth::user();

        $post = Post::create([
            'postable_id' => $user->id,
            'postable_type' => get_class($user),
            'content' => request('content'),
            'year_class_id' => request('year_class_id'),
        ]);


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/posts', 'public');

                PostPhotos::create([
                    'post_id' => $post->id,
                    'image' => $path,
                ]);
            }
        }



        Session::flash('message', 'تم اضافة منشور جديد بنجاح');
        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {
        $post->update([
            'content' => request('content'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/posts', 'public');

                PostPhotos::create([
                    'post_id' => $post->id,
                    'image' => $path,
                ]);
            }
        }

        $post->save();

        Session::flash('message', 'تم تحديث المنشور بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
