@extends('layouts/main')
@section('content')
    <h2>New Post</h2>
    <form method="post" action="{{route('posts.store')}}" accept-charset="UTF-8">
        @include('partials._form')
    </form>
@stop