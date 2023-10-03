@extends('layouts.main')

@section('title', 'Блог')

@section('content')
    @if (count($posts) != 0)
        @foreach ($posts as $post)
            @include('main.post.index')
        @endforeach
    @else
        <div class="card m-3">
            <div class="card-body">
                Посты не найдены
            </div>
        </div>
    @endif

    {{ $posts->links('partials.pagination') }}

    <script>
        $(document).ready(function() {
            $(".card-text").each(function() {
                if ($(this).height() < 400) {
                    $(this).siblings(".card-gradient").hide();
                    $(this).siblings(".card-button").hide();
                }
            })
        })
    </script>
@endsection
