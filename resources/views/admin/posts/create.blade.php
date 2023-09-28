@extends('admin.layouts.main')

@section('title', 'Посты')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Созадть пост</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('admin.post.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="Название"
                                    value="{{ old('title') }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea id="editor" name="content">
                                    {{ old('content') }}
                                </textarea>
                                @error('content')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select class="form-select" name="category_id" id="pet-select">
                                    <option selected disabled>Выбери категорию</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select class="selectTags w-100" name="tag_ids[]" multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ is_array(old('tag_ids')) && in_array($tag->id, old('tag_ids')) ? 'selected' : '' }}>
                                            {{ $tag->title }}</option>
                                    @endforeach
                                </select>
                                @error('tag_ids')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Созадть</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
