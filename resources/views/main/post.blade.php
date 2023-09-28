@extends('layouts.main')

@section('title', 'Блог')

@php
    use Carbon\Carbon;
    Carbon::setLocale('ru');
@endphp

@section('content')
    @include('main.includes.post')
    @include('main.includes.comments')
@endsection
