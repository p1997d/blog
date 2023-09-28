@extends('admin.layouts.main')

@section('title', 'Категории')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $category->title }}</h1>
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
                    <div class="d-flex">
                        <a class="m-1 p-1 btn btn-primary" href="{{ route('admin.category.edit', $category->id) }}">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a class="m-1 p-1 btn btn-primary" href="{{ route('admin.category.remove', $category->id) }}">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card mt-3">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <tbody>
                                        @foreach ($category->getAttributes() as $key => $value)
                                            <tr>
                                                <td>{{ $key }}</td>
                                                <td>{{ $value }}</td>
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
