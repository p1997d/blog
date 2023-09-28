@extends('admin.layouts.main')

@section('title', 'Посты')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Посты</h1>
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
                    <div class="col-1">
                        <a href="{{ route('admin.post.create') }}" class="btn btn-block btn-primary">Создать</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap table-striped">
                                    <thead>
                                        <tr>
                                            <th>Действия</th>
                                            <th>ID</th>
                                            <th>Author (id)</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>View</th>
                                            <th>Сategory ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts->reverse() as $post)
                                            <tr>
                                                <td style="width: 10%">
                                                    <a class="px-1" href="{{ route('admin.post.show', $post->id) }}">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a class="px-1" href="{{ route('admin.post.edit', $post->id) }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a class="px-1" href="{{ route('admin.post.remove', $post->id) }}">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->user->name }} ({{ $post->user->id }})</td>
                                                <td style="width: 15%">{{ $post->title }}</td>
                                                <td
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                                    {{ $post->content }}</td>
                                                <td>{{ $post->view }}</td>
                                                <td>{{ $post->category_id }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
