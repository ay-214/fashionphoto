<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- 各ページごとにtitleタグを入れる --}}
        <title>@yield('title')</title>

        <!-- Scripts -->
         {{-- Laravel標準で用意されているJavascriptを読み込む --}}
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込む --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- front用のcssを読み込む --}}
        <link href="{{ asset('css/front.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="mx-auto">
            
         <div class="toptitle">Styling/minimum</div>
        </div>
        <div id="app">
            {{-- 画面上部に表示するナビゲーションバー --}}
            <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav">
                        
                        <!-- Authentication Links -->
                        {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a></li>
                        {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                        @else
                            <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                 </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('messages.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            {{-- ここまでナビゲーションバー --}}
            <div class="col-md-4 mx-auto">
            <div class="subtitle1">ミニマム身長さん達で作る、</div>
            <div class="subtitle2">ミニマム身長さんのためのコーディネートヒント。</div>
            </div>
            {{-- 投稿に対してフリーワードでの検索機能をつける --}} 
            <div class="col-md-2 mx-4">
                <div>...コーディネートを検索</div>
                    <form action="{{ route('fashion.search') }}" 
                        method="GET">
                        <input type="search" name="query" placeholder="検索..." required>
                        <button type="submit">Search</button>
                    </form>
            </div>

            <main class="py-4">
                 {{-- コンテンツをここに入れる --}}
                 @yield('content')
            </main>
            <div class="row">
                    <div class="d-flex justify-content-center">
                        {{ $posts->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                    </div>
            </div>
        </div>
    </body>
</html>


