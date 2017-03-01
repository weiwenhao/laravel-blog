<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - 空白页</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    {{--csrftoken--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/back/css/bootstrap.min.css" rel="stylesheet">
    <link href="/back/css/font-awesome.css" rel="stylesheet">
    <link href="/back/css/animate.css" rel="stylesheet">
    @yield('css')
    <link href="/back/css/style.css" rel="stylesheet">
</head>

<body class="gray-bg">
{{--内容主体--}}
@yield('content')


<!-- 全局js -->
<script src="/back/js/jquery.min.js"></script>
<script src="/back/js/bootstrap.min.js"></script>
<!-- 自定义js -->
<script src="/back/js/content.js"></script>
@yield('js')
</body>

</html>