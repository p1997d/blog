@extends('layouts.main')

@section('title', 'Блог')

@section('content')
    @foreach ($posts as $post)
        @include('main.includes.post')
    @endforeach

    {{ $posts->links('main.includes.pagination') }}

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
