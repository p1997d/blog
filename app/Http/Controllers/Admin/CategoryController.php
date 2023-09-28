<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function remove(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Category::firstOrCreate($data);
        return redirect()->route('admin.category.index');
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return redirect()->route('admin.category.show', compact('category'));
    }
}