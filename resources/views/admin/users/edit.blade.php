@extends('admin.layouts.main')

@section('title', 'Пользователи')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактировать пользователя</h1>
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
                    <div class="col-4">
                        <form action="{{ route('admin.user.update', $user->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Имя пользователя"
                                    value="{{ $user->name }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="Электронная почта"
                                    value="{{ $user->email }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <select class="form-select" name="role" id="pet-select">
                                    <option disabled>Выберите роль</option>
                                    @foreach ($roles as $id => $role)
                                        <option value="{{ $id }}" {{ $id === $user->role ? 'selected' : '' }}>
                                            {{ $role }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Редактировать</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
