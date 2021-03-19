<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .btn-info {
            color: #fff;
        }
    </style>
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel Forum
                </a>
                @auth
                    <a href="{{ route('users.notifications') }}">{{ auth()->user()->unreadNotifications->count() }} <span class="ml-2">Unread Notifications</span></a>
                @endauth
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if (in_Array(request()->path(), ['login','register','password/reset','password/email']))
                @yield('content')
            @else
                <div class="container">
        
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-4">
                            @auth
                                <a href="{{ route('discussions.create') }}" style="width:100%" class="btn btn-info mb-2 text-capitalize">add discussion</a>
                            @else
                                <a href="{{ route('login') }}" style="width:100%" class="btn btn-info mb-2">Sign in to add discussion</a>
                            @endauth

                            <div class="card">
                                <div class="card-header">Channels</div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($channels as $channel)
                                            <li class="list-group-item">
                                                <a href="{{ route('discussions.index') }}?channel={{ $channel->slug }}">{{ $channel->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            @yield('content')
                        </div>
                    </div>
                </div>
            @endif
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>
</html>
