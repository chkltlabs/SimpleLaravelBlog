<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>The EverBlog</title>
    <link rel="stylesheet" href="{{ asset('css/compile.css') }}" />
    <script src="{{ asset('js/vendor/modernizr.js') }}"></script>
</head>

<body>

<!-- Header and Nav -->

<nav class="top-bar" data-topbar>
    <ul class="title-area button-group">
        <li class="name">
            <h1><a href="/">The EverBlog</a></h1>
        </li>
        <li class="name login" style="float: right">
            @if(!Auth::check())
                <h1><a href="{{{ route('login') }}}">Login</a></h1>
            @else
                <form method="post" action="{{{ route('logout') }}}">
                    @csrf
                    <h1><a><input style="all: unset;" type="submit"value="Logout"></a></h1>
                </form>

            @endif
        </li>
    </ul>
</nav>

<!-- End Header and Nav -->

@if(session('message'))
    <div class="alert-box success">
        {{{ session('message') }}}
    </div>
@endif
@if(session('warning'))
    <div class="alert-box alert">
        {{{ session('warning') }}}
    </div>
@endif


<div class="row">
    <div class="large-12">
        @yield('content')
    </div>
</div>


<!-- Footer -->

<footer class="row">
    <div class="large-12 columns">
        <hr />
        <div class="row">
            <div class="large-6 columns">
                <p>©2019 Erik Gratz</p>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('js/vendor/jquery.js') }}"></script>
<script src="{{ asset('js/vendor/foundation.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>