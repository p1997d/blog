@extends('layouts.main')

@section('title', 'Блог')

@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;
    Carbon::setLocale('ru');
@endphp

@section('content')
    <div class="card m-3">
        <div class="card-header">
            {{ $user->name }}
            @if ($user->role === 1)
                <span class="badge rounded-pill bg-secondary">Модератор</span>
            @endif
        </div>
        <div class="card-body">
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">Постов:</h5>
                        <p class="card-text">{{ $userPostsCount }}</p>
                    </div>
                    <div class="col">
                        <h5 class="card-title">Лайков:</h5>
                        <p class="card-text">{{ $userLikesCount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($posts->reverse() as $post)
        @include('main.includes.post')
    @endforeach
    <script>
        $(document).ready(function() {
            $(".card-text").each(function() {
                if ($(this).height() < 400) {
                    $(this).siblings(".card-gradient").hide();
                }
            })
        })
    </script>
@endsection
