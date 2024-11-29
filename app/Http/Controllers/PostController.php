<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view("posts.index" , compact("posts"));
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
        $images = [];
        if ($request->hasFile('postImg'))
        {
            foreach ($request->file('postImg') as $image)
            {
                $imageName = $image->getClientOriginalName() . '-' . $image->getClientOriginalExtension();
                $image->move(public_path('images/posts'), $imageName);
                $images[] = $imageName;
            }
        }
        Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "image" => json_encode($images)
            ]);

            return redirect()->route("posts.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view("posts.show" , compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view("posts.edit" , compact("post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // حذف الصور القديمة إذا تم رفع صور جديدة
        if ($request->hasFile('postImg'))
        {
            $oldImages = json_decode($post->image, true) ?? [];
            foreach ($oldImages as $oldImage)
            {
                $oldImagePath = 'images/posts/' . $oldImage;
                if (Storage::exists($oldImagePath))
                {
                    Storage::delete($oldImagePath);
                }
            }
            // إضافة الصور الجديدة
            $images = [];
            foreach ($request->file('postImg') as $image)
            {
                $imageName = $image->getClientOriginalName() . '-' . $image->getClientOriginalExtension();
                $image->move(public_path('images/posts'), $imageName);
                $images[] = $imageName;
            }
            $post->image = json_encode($images);
        }
        $post->update([
            "title" => $request->title,
            "description" => $request->description,
            "image" => $post->image
            ]);
            return redirect()->route("posts.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect(route("posts.index"));
    }

}