<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'WEIWENHAO') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        @foreach($categorys as $category)
                            <li><a href="/article?cat_id={{ $category->id }}">{{ $category->name }}</a></li>
                        @endforeach
                        <li><a href="#">CALL ME</a></li>

                    </ul>
                </div>
            </div>
        </nav>

        <header class="intro-header" style="background-image: url('{{ $img_path?$img_path:'/img/header1.jpg' }}')">
            <div class="container">
                <div class="row">
                    <div class=" col-md-10 col-md-offset-1">
                        @section('header-content')
                        <div class="site-heading">
                            <h1>
                                @if(request('key_id'))
                                    <i class="glyphicon glyphicon-tag"></i>
                                @endif
                               {{ $title or config('blog.title') }}
                            </h1>
                            <hr class="small">
                            <h2>www.weiwenhao.org</h2>
                        </div>
                        @show
                    </div>
                </div>
            </div>
        </header>

        @yield('content')
    </div>
{{--页脚开始--}}
<footer class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-body text-center">
            <p class="text-info">Copyright © 魏文豪</p>
        </div>
    </div>
</footer>
{{--页脚结束--}}
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    {{--弹出层临时解决方案,带完善--}}
    <script src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{asset('vendor/layer/layer.js')}}"></script>

    @yield('js')
</body>
</html>
