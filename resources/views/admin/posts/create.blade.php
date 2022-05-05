@section('title', 'New Post')
@extends('layout')

@section('content')

    <h1 class="title">Create a new post</h1>

    <form method="post" action="{{ route('posts.store') }}">  <!--запрос post отправляется при отправке в posts.store .
    это относится к методу store в PostController-->

        @csrf
        @include('admin.partials.errors')

        <div class="field">
            <label class="label">Title</label>
            <div class="control">
                <input type="text" name="title" value="{{ old('title') }}" class="input" placeholder="Title" minlength="5" maxlength="100" required />
            </div>
        </div>

        <div class="field">
            <label class="label">Content</label>
            <div class="control">
                <textarea name="content" class="textarea" placeholder="Content" minlength="5" maxlength="2000" required rows="10">{{ old('content') }}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link is-outlined">Publish</button>
            </div>
        </div>

    </form>

@endsection
