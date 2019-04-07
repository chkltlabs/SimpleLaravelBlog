@extends('layouts/main')
@section('content')
    <div class="large-12 columns">
        <h1>{{{ $post->title }}}</h1>
        <br><i><p>Posted by <a href="/user/{{{$user->id}}}">{{{$user->name}}}</a> on {{{ $createdate }}}, Last edit on {{{ $updatedate }}}</p></i>
        <pre>{{{ $post->body }}}</pre>

        <br><br>
        <p><a class="tiny button" href="{{ route('posts.index') }}">Back</a></p>
    </div>
@stop