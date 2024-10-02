<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Models\PostPhotos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function store(StorePostsRequest $request)
    {
        $user = Auth::user();

        $add_all_classes = request()->has('add_all_classes');
        if ($add_all_classes) {
            $post = Post::create([
                'postable_id' => $user->id,
                'postable_type' => get_class($user),
                'content' => request('content'),
                'year_class_id' => null,
            ]);
        }else{
            $post = Post::create([
                'postable_id' => $user->id,
                'postable_type' => get_class($user),
                'content' => request('content'),
                'year_class_id' => request('year_class_id'),
            ]);
        }




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

    public function destroy(Post $post)
    {
        $post->delete();
        Session::flash('message', 'تم حذف المنشور بنجاح');
        return redirect()->back();
    }


    public function destroyImage(PostPhotos $postPhoto)
    {

        Storage::disk('public')->delete($postPhoto->image);
        $postPhoto->delete();

        Session::flash('message', 'تم حذف الصورة بنجاح');
        return redirect()->back();

    }
}
