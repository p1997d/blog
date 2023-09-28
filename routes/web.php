<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Main\PostController as MainPostController;
use App\Http\Controllers\Main\CommentsConroller;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['namespace' => Main::class], function () {
    Route::get('/', [IndexController::class, 'index'])->name('main.index');
    Route::get('/category/{category}', [IndexController::class, 'category'])->name('main.category');
    Route::get('/post/{post}', [IndexController::class, 'post'])->name('main.post');
    Route::get('/user/{user}', [IndexController::class, 'user'])->name('main.user');
    Route::get('/user/{user}/liked', [IndexController::class, 'likedPosts'])->name('main.user.liked');
    Route::get('/like/{post}', [IndexController::class, 'like'])->name('main.like');
    Route::get('/dislike/{post}', [IndexController::class, 'dislike'])->name('main.dislike');
    Route::get('/search', [IndexController::class, 'search'])->name('main.search');

    Route::post('/create', [MainPostController::class, 'store'])->name('main.post.store');
    Route::post('/update/{post}', [MainPostController::class, 'update'])->name('main.post.update');
    Route::get('/{post}/remove', [MainPostController::class, 'remove'])->name('main.post.remove');
    Route::post('/post/ckeditor', [MainPostController::class, 'ckeditor'])->name('main.post.ckeditor');

    Route::post('/post/{post}/comments/send', [CommentsConroller::class, 'send'])->name('main.post.comments.send');
    Route::post('/post/comments/remove', [CommentsConroller::class, 'remove'])->name('main.post.comments.remove');
});

Route::group(['namespace' => Admin::class, 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.main.index');
    });

    Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
        Route::get('/', [AdminPostController::class, 'index'])->name('admin.post.index');
        Route::get('/create', [AdminPostController::class, 'create'])->name('admin.post.create');
        Route::post('/', [AdminPostController::class, 'store'])->name('admin.post.store');
        Route::get('/{post}', [AdminPostController::class, 'show'])->name('admin.post.show');
        Route::post('/{post}', [AdminPostController::class, 'update'])->name('admin.post.update');
        Route::get('/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.post.edit');
        Route::get('/{post}/remove', [AdminPostController::class, 'remove'])->name('admin.post.remove');
        Route::post('/post/ckeditor', [AdminPostController::class, 'ckeditor'])->name('admin.post.ckeditor');
    });

    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('admin.category.show');
        Route::post('/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::get('/{category}/remove', [CategoryController::class, 'remove'])->name('admin.category.remove');
    });

    Route::group(['namespace' => 'Tag', 'prefix' => 'tags'], function () {
        Route::get('/', [TagController::class, 'index'])->name('admin.tag.index');
        Route::get('/create', [TagController::class, 'create'])->name('admin.tag.create');
        Route::post('/', [TagController::class, 'store'])->name('admin.tag.store');
        Route::get('/{tag}', [TagController::class, 'show'])->name('admin.tag.show');
        Route::post('/{tag}', [TagController::class, 'update'])->name('admin.tag.update');
        Route::get('/{tag}/edit', [TagController::class, 'edit'])->name('admin.tag.edit');
        Route::get('/{tag}/remove', [TagController::class, 'remove'])->name('admin.tag.remove');
    });

    Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('admin.user.show');
        Route::post('/{user}', [UserController::class, 'update'])->name('admin.user.update');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::get('/{user}/remove', [UserController::class, 'remove'])->name('admin.user.remove');
    });
});

Auth::routes();