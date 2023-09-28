@extends('admin.layouts.main')

@section('title', 'Главная')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
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
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $categories }}</h3>
                                <p>Категории</p>
                            </div>
                            <div class="icon">
                                <i class="bi bi-list"></i>
                            </div>
                            <a href="{{ route('admin.category.index') }}" class="small-box-footer">
                                Подробнее
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $tags }}</h3>
                                <p>Теги</p>
                            </div>
                            <div class="icon">
                                <i class="bi bi-tags"></i>
                            </div>
                            <a href="{{ route('admin.tag.index') }}" class="small-box-footer">
                                Подробнее
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $posts }}</h3>
                                <p>Посты</p>
                            </div>
                            <div class="icon">
                                <i class="bi bi-postcard"></i>
                            </div>
                            <a href="{{ route('admin.post.index') }}" class="small-box-footer">
                                Подробнее
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $users }}</h3>
                                <p>Пользователи</p>
                            </div>
                            <div class="icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <a href="{{ route('admin.user.index') }}" class="small-box-footer">
                                Подробнее
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
