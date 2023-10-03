<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\PostDislike;
use App\Models\PostLike;
use Cookie;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Получить общие данные для всех страниц.
     *
     * @return array<object, object, int|null, int|null>
     */
    private function getData()
    {
        $categories = Category::all();
        $tags = Tag::all();

        if (!Auth::guest()) {
            $myPostsCount = Post::countByUser(auth()->user()->id);
            $myLikesCount = PostLike::getLikeByUser(auth()->user()->id)->count();
        } else {
            $myPostsCount = null;
            $myLikesCount = null;
        }

        return compact('categories', 'tags', 'myPostsCount', 'myLikesCount');
    }

    /**
     * Отображение постов на главной странице.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10)->onEachSide(1);

        return view('main.index', array_merge($this->getData(), compact('posts')));
    }

    /**
     * Отображение постов указанной категории
     *
     * @param  [type]  $category
     * @return \Illuminate\Contracts\View\View
     */
    public function category($category)
    {
        $category_id = Category::firstWhere('title', $category)->id;
        $posts = Post::where('category_id', $category_id)->paginate(10)->onEachSide(1);

        return view('main.index', array_merge($this->getData(), compact('posts')));
    }

    /**
     * Отображение страницы с одним постом
     *
     * @param  Post  $post
     * @return \Illuminate\Contracts\View\View
     */
    public function post(Post $post)
    {
        if (Cookie::get("post-$post->id") == '') {
            Cookie::queue("post-$post->id", '1', 60);
            $post->increment('view');
        }
        $allComments = [];
        $comments = PostComment::where('post_id', $post->id)->get();
        foreach ($comments as $i => $comment) {
            $commentData = [
                'comment' => $comment,
                'replies' => [],
            ];
            if ($comment['reply_id'] == null) {
                $allComments[$comment->id] = $commentData;
            } else {
                $allComments[$comment->reply_id]['replies'][] = $comment;
            }
        }

        return view('main.post', array_merge($this->getData(), compact('post', 'allComments')));
    }

    /**
     * Отображение странциы пользователя
     *
     * @param  User  $user
     * @return \Illuminate\Contracts\View\View
     */
    public function user(User $user)
    {
        $userPostsCount = Post::countByUser($user->id);
        $userLikesCount = PostLike::getLikeByUser($user->id)->count();

        $posts = Post::where('author', $user->id)->paginate(10)->onEachSide(1);

        return view('main.user', array_merge($this->getData(), compact('posts', 'user', 'userPostsCount', 'userLikesCount')));
    }

    /**
     * Обработка действия "Лайк" для указанного поста.
     *
     * @param  Post  $post
     * @return void
     */
    public function like(Post $post)
    {
        if (!Auth::guest()) {
            if (
                !PostLike::where([
                    ['post_id', '=', $post->id],
                    ['user_id', '=', auth()->user()->id],
                ])->exists()
            ) {
                $post->likes()->attach(auth()->user()->id);
                $post->dislikes()->detach(auth()->user()->id);
            } else {
                $post->likes()->detach(auth()->user()->id);
            }
            $likes = PostLike::where('post_id', $post->id)->count();
            $dislikes = PostDislike::where('post_id', $post->id)->count();
            $post->rating = $likes - $dislikes;
            $post->save();
        }
    }

    /**
     * Обработка действия "Дизлайк" для указанного поста.
     *
     * @param  Post  $post
     * @return void
     */
    public function dislike(Post $post)
    {
        if (!Auth::guest()) {
            if (
                !PostDislike::where([
                    ['post_id', '=', $post->id],
                    ['user_id', '=', auth()->user()->id],
                ])->exists()
            ) {
                $post->dislikes()->attach(auth()->user()->id);
                $post->likes()->detach(auth()->user()->id);
            } else {
                $post->dislikes()->detach(auth()->user()->id);
            }
            $likes = PostLike::where('post_id', $post->id)->count();
            $dislikes = PostDislike::where('post_id', $post->id)->count();
            $post->rating = $likes - $dislikes;
            $post->save();
        }
    }

    /**
     * Выполняет поиск постов
     *
     * @param  Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->paginate(10)
            ->appends(['query' => $query])
            ->onEachSide(1);

        return view('main.index', array_merge($this->getData(), compact('posts', 'query')));
    }

    /**
     * Отображает понравившиеся посты для указанного пользователя
     *
     * @param  User  $user
     * @return \Illuminate\Contracts\View\View
     */
    public function likedPosts(User $user)
    {
        $userPostsCount = Post::countByUser($user->id);
        $userLikesCount = PostLike::getLikeByUser($user->id)->count();

        $likes = PostLike::getLikeByUser($user->id)->pluck('post_id');
        $posts = Post::whereIn('id', $likes)->paginate(10)->onEachSide(1);

        return view('main.user', array_merge($this->getData(), compact('posts', 'user', 'userPostsCount', 'userLikesCount')));
    }
}
