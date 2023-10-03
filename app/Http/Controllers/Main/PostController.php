<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\Main\Post\StoreRequest;
use App\Http\Requests\Main\Post\UpdateRequest;

class PostController extends Controller
{
    /**
     * Сохраняет новый пост и перенаправляет на страницу просмотра поста.
     *
     * @param  StoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Обновляет существующий пост и перенаправляет на страницу просмотра поста.
     *
     * @param  StoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();

        $tag_ids = $data['tag_ids'];
        unset($data['tag_ids']);

        $post->update($data);
        $post->tags()->sync($tag_ids);

        return redirect()->route('main.post', compact('post'));
    }

    /**
     * Удаляет указанный пост и все связанные с ним теги, затем перенаправляет на главную страницу.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Post $post)
    {
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('main.index');
    }

    /**
     * Загружает изображение из редактора CKEditor и возвращает JSON-ответ с информацией о загрузке.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|null
     */
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
