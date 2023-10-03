@extends('layouts.main')

@section('title', 'Блог')

@php
    use Carbon\Carbon;
    Carbon::setLocale('ru');
@endphp

@section('content')
    @include('main.post.index')
    @include('main.comments.index')
    @include('main.modals.editPostModal')
@endsection
