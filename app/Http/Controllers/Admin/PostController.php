<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10)->onEachSide(1);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function remove(Post $post)
    {
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.post.index');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $tag_ids = $data['tag_ids'];
        unset($data['tag_ids']);

        $data['author'] = auth()->user()->id;

        $post = Post::create($data);
        $post->tags()->attach($tag_ids);

        return redirect()->route('admin.post.show', compact('post'));
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();

        $tag_ids = $data['tag_ids'];
        unset($data['tag_ids']);

        $post->update($data);
        $post->tags()->sync($tag_ids);

        return redirect()->route('admin.post.show', compact('post'));
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
