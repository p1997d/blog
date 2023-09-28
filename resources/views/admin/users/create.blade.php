@extends('admin.layouts.main')

@section('title', 'Пользователи')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Созадть пользователя</h1>
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
                        <form action="{{ route('admin.user.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Имя пользователя"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="Электронная почта"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Пароль">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select class="form-select" name="role" id="pet-select">
                                    <option selected disabled>Выберите роль</option>
                                    @foreach ($roles as $id => $role)
                                        <option value="{{ $id }}" {{ old('role') == $id ? 'selected' : '' }}>
                                            {{ $role }}</option>
                                    @endforeach
                                </select>
                                @error('role')
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
