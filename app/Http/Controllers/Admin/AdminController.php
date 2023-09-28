<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $categories = Category::all()->count();
        $posts = Post::all()->count();
        $tags = Tag::all()->count();
        $users = User::all()->count();

        return view('admin.main.index', compact('categories', 'posts', 'tags', 'users'));
    }
}