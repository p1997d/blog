@extends('admin.layouts.main')

@section('title', 'Пользователи')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Пользователи</h1>
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
                        <a href="{{ route('admin.user.create') }}" class="btn btn-block btn-primary">Создать</a>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <a class="px-1" href="{{ route('admin.user.show', $user->id) }}">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a class="px-1" href="{{ route('admin.user.edit', $user->id) }}">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <a class="px-1" href="{{ route('admin.user.remove', $user->id) }}">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $roles[$user->role] }}</td>
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
        {{ $users->links('partials.pagination') }}
    </div>
@endsection
