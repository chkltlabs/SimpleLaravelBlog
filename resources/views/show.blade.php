@extends('layouts/main')
@section('content')
    <div class="large-12 columns">
        <h1>{{{ $post->title }}}</h1>
        <br><i><p>Posted by <a href="/user/{{{$user->id}}}">{{{$user->name}}}</a> on {{{ $createdate }}}, Last edit on {{{ $updatedate }}}</p></i>
        <pre>{{{ $post->body }}}</pre>
        <br><br>
            <ul class="no-bullet button-group">
                <li>
                    <a class="tiny button" href="{{ route('posts.index') }}">Back</a>
                </li>
                @if(Auth::id() == $user->id)
                <li>
                    <a class="tiny button" href="{{route('posts.edit', ['post' => $post->id])}}">Edit</a>
                </li>
                <li>
                    <form method="post" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                        @method('delete')
                        @csrf
                        <input class="tiny alert button" type="submit" value="destroy">
                    </form>
                </li>
                @endif
            </ul>
    </div>
@stop