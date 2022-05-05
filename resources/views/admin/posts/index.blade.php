@section('title', 'Home')
@extends('layout')

@section('content')

    @foreach ($posts as $post)
        @include('admin/partials.summary')
    @endforeach

@endsection
