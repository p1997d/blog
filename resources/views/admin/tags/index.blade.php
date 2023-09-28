@extends('admin.layouts.main')

@section('title', 'Теги')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Теги</h1>
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
                        <a href="{{ route('admin.tag.create') }}" class="btn btn-block btn-primary">Создать</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card mt-3">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap table-striped">
                                    <thead>
                                        <tr>
                                            <th>Действия</th>
                                            <th>ID</th>
                                            <th>Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tags as $tag)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <a class="px-1" href="{{ route('admin.tag.show', $tag->id) }}">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a class="px-1" href="{{ route('admin.tag.edit', $tag->id) }}">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <a class="px-1" href="{{ route('admin.tag.remove', $tag->id) }}">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>{{ $tag->id }}</td>
                                                <td>{{ $tag->title }}</td>
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
