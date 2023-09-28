@extends('layouts.main')

@section('title', 'Блог')

@section('content')
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
