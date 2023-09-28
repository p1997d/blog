<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\Main\Post\StoreRequest;
use App\Http\Requests\Main\Post\UpdateRequest;

class PostController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $tag_ids = $data['tag_ids'];
        unset($data['tag_ids']);

        $data['author'] = auth()->user()->id;

        $post = Post::create($data);
        $post->tags()->attach($tag_ids);

        return redirect()->route('main.post', compact('post'));
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();

        $tag_ids = $data['tag_ids'];
        unset($data['tag_ids']);

        $post->update($data);
        $post->tags()->sync($tag_ids);

        return redirect()->route('main.post', compact('post'));
    }
    public function remove(Post $post)
    {
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('main.index');
    }
    public function ckeditor(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('upload'), $fileName);

            $url = asset('upload/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}