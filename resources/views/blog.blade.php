@extends('layouts/main')
@section('content')
    <h1>The EverBlog</h1>
    <i><p>Where anyone can say anything</p></i>
    <a class="success tiny button" href="{{ route('posts.create') }}">Write Something...</a>
    <ul class="no-bullet">
    @foreach($blog_posts as $post)
<div class="box">
    <li>

        <li>
            <ul class="no-bullet button-group">
                <h2><a href="{{{ route('posts.show', ['post' => $post->id]) }}}">{{{ $post->title }}}</a></h2>
{{--                @if(Auth::id() == $post->user_id)--}}
{{--                    <li>--}}
{{--                        <a class="tiny button" href="{{route('posts.edit', ['post' => $post->id])}}">Edit</a>--}}

{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <form method="post" action="{{ route('posts.destroy', ['post' => $post->id]) }}">--}}
{{--                            @method('delete')--}}
{{--                            @csrf--}}
{{--                            <input class="tiny alert button" type="submit" value="destroy">--}}
{{--                        </form>--}}
{{--                    </li>--}}
{{--                @endif--}}
                </ul>
            </li>
        @foreach($users as $user)
            @if($user->id == $post->user_id)
                <p class="tiny"><i>By <a href="/user/{{{$user->id}}}">{{{$user->name}}}</a></i></p>
            @endif
        @endforeach
        <pre>{{{ $post->body }}}</pre>
        @php
            $origCreateDate = date("F d, Y", strtotime(substr($post->created_at, 0, 10)));
            $origUpdateDate = date("F d, Y", strtotime(substr($post->updated_at, 0, 10)));
        @endphp
        <p>Originally posted on {{$origCreateDate}}, last edited on {{$origUpdateDate}}</p>
    </li>
</div>
    @endforeach
    </ul>
@stop