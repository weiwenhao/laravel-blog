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
    <style>
        body{
            /*font-family:Georgia, "Times New Roman",
            "Microsoft YaHei", "微软雅黑",  !*win下的默认中文字体*!
            STXihei, "华文细黑", !*mac下的默认中文字体*!
            sans-serif;*/
            font-family: NotoSansHans-Regular,AvenirNext-Regular,arial,Hiragino Sans GB,"Microsoft Yahei","Hiragino Sans GB","WenQuanYi Micro Hei",sans-serif;;
        }

        /*背景透明*/
        #touming-nav {
            filter: alpha(opacity=0);
            background-color: transparent;
            border-color: transparent;
        }
        /*字体显示清楚*/
        #touming-nav .navbar-nav > li > a {
            color: #FFF;
        }
        #touming-nav .navbar-nav > li > a:hover {
            color: #C9BCC4;;
        }
        #touming-nav .navbar-brand {
            color: #FFF;
        }
        /*背景透明完*/

        /**
        回到顶部
         */
        #returnTop{
            position:fixed;
            right: 10px;
            bottom: 10px;
            display: none;
        }

        code{
            font-size: 18px;
        }
        /**
        pre代码片段去边框
         */
       /* pre {
            background-color: transparent;
            border : transparent;
        }*/
    </style>
</head>
<body>
<div id="app">
        <nav id="touming-nav" class="navbar navbar-default navbar-fixed-top ">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#touming-navbar-collapse">
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

                <div class="collapse navbar-collapse" id="touming-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        @foreach($categorys as $category)
                            <li><a href="/article?cat_id={{ $category->id }}">{{ $category->name }}</a></li>
                        @endforeach
                        <li><a href="/call_me">CALL ME</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <nav  id="nav" class="navbar navbar-default navbar-fixed-top " style="display: none" >
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
                        <li><a href="/call_me">CALL ME</a></li>
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
                                @if($title)
                                    {{ $title }}
                                @else
                                    <img class="img-responsive center-block" src="/img/logo.png" alt="">
                                @endif
                               {{--{{ $title or config('blog.title') }}--}}
                            </h1>
                            <hr class="small">
                            <h2>www.weiwenhao.xyz</h2>
                        </div>
                        @show
                    </div>
                </div>
            </div>
        </header>

        @yield('content')
    </div>
{{--页脚开始--}}
<footer class="container-fluid" >
    <div class="panel panel-default">
        <div class="panel-body text-center">
            <p class="text-info">Copyright © 魏文豪</p>
            <p class="" style="font-size: 10px">豫ICP备17001857号-1</p>
        </div>
    </div>
</footer>
{{--返回顶部--}}
@section('returnTop')
<div id="returnTop">
    <button class="btn btn-lg btn-info"><i class="glyphicon glyphicon-chevron-up"></i></button>
</div>
@show
{{--页脚结束--}}
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
    <script>
        $("#returnTop").click(function () {
            var speed=500;//滑动的速度
            $('body,html').animate({ scrollTop: 0 }, speed);
            return false;
        });
        $(window).on('scroll',function(){
            // div 滚动了
            var size = this.scrollY;
            if(size != 0){
                $('#nav').fadeIn(500);
                $('#touming-nav').fadeOut(500);

                if(size > 150){
                    $("#returnTop").fadeIn('1000');
                }else {
                    $("#returnTop").fadeOut(1000);
                }

            }else{
                $('#touming-nav').fadeIn(366);
                $('#nav').fadeOut(366);

                $("#returnTop").fadeOut(1000);
            }
        });
    </script>
</body>
</html>
