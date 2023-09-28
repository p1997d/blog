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
use App\Http\Requests\Main\Post\StoreRequest;
use App\Http\Requests\Main\Post\UpdateRequest;

class IndexController extends Controller
{
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

    public function index()
    {
        $posts = Post::all();

        return view('main.index', array_merge($this->getData(), compact('posts')));
    }
    public function category($category)
    {
        $category_id = Category::firstWhere('title', $category)->id;
        $posts = Post::where('category_id', $category_id)->get();

        return view('main.index', array_merge($this->getData(), compact('posts')));
    }
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
    public function user(User $user)
    {
        $userPostsCount = Post::countByUser($user->id);
        $userLikesCount = PostLike::getLikeByUser($user->id)->count();

        $posts = Post::where('author', $user->id)->get();

        return view('main.user', array_merge($this->getData(), compact('posts', 'user', 'userPostsCount', 'userLikesCount')));
    }
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
        return;
    }
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
        return;
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->get();

        return view('main.index', array_merge($this->getData(), compact('posts', 'query')));
    }

    public function likedPosts(User $user)
    {
        $userPostsCount = Post::countByUser($user->id);
        $userLikesCount = PostLike::getLikeByUser($user->id)->count();

        $posts = PostLike::getLikeByUser($user->id)->get()->pluck('post');

        return view('main.user', array_merge($this->getData(), compact('posts', 'user', 'userPostsCount', 'userLikesCount')));
    }
}