@extends('layouts/main')
@section('content')
    <h2>Edit Post</h2>
    <form method="post" action="{{route('posts.update', ['post' => $post->id])}}" accept-charset="UTF-8">
        @method('put')
        @include('partials._form')
    </form>
@stop