@extends('layouts.app')
@section('css')
    <style>
        /*文章界面的上一篇和下一篇*/
        .pager li > a:hover, .pager li > a:focus {
            color: white;
            background-color: #0085A1;
            border: 1px solid #0085A1;
            text-decoration: none;
        }

        .pager li > a {
            text-transform: uppercase;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 1px;
            padding: 15px 25px;
            background-color: white;
            border-radius: 0;
        }
        .intro-header .site-heading, .intro-header .page-heading {
            text-align: center;
            color: white;
        }

        /**
        代码后台透明
         */
        pre {
            background-color: transparent;
            border: 1px solid transparent;
        }
    </style>
@stop

@section('header-content')
    <div class="site-heading">
        <h1>{{ $article->category->name }}</h1>
        <hr class="small">
        <h3>www.weiwenhao.org</h3>
    </div>
@stop
@section('content')
    {{--页面主体--}}
<div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <article>
                                <div class="title text-center">
                                    <h1>{{ $article->title }}</h1>
                                </div>
                                <hr>
                                <div class="meta">
                                    <span>关键字:</span>
                                    @if($article->keys)
                                        @foreach( $article->keys as $key)
                                            <a href="/article?key_id={{ $key->id }}">
                                                <span class="label label-info" style="font-size: 90%"> <i class="glyphicon glyphicon-tag"></i>&nbsp; &nbsp;{{ $key->name }}</span>
                                            </a>
                                            {{--<a href="/blog?tag=rem">{{ $key->name }}</a>--}}
                                        @endforeach
                                    @endif
                                    <span class="pull-right">
                                        {{ $article->publish_at}}
                                    </span>
                                </div>
                            <br>
                                <div class="content">
                                    {!! $article->content !!}
                                </div>
                        </article>
                        <ul class="pager">
                                @if($previous)
                                    <li class="previous">
                                        <a href="/article/{{ $previous->seo_title }}@if(request('cat_id'))?cat_id={{request('cat_id')}}@endif @if(request('key_id'))?key_id={{request('key_id')}}@endif">
                                            <i class="glyphicon glyphicon-arrow-left"></i>
                                            <span>上一篇</span>
                                        </a>
                                    </li>
                                @endif

                                @if($next)
                                    <li class="next">
                                        <a
                                            href="/article/{{ $next->seo_title }}@if(request('cat_id'))?cat_id={{request('cat_id')}}@endif @if(request('key_id'))?key_id={{request('key_id')}}@endif"
                                        >
                                            <span>下一篇</span>
                                            <i class="glyphicon glyphicon-arrow-right"></i>
                                        </a>
                                    </li>
                                @endif
                        </ul>
                    </div>
                </div>
                {{--评论区开始--}}
                <article-comment article_id="{{ $article->id }}" ></article-comment>
                {{--评论区结束--}}
            </div>

            {{--右侧导航栏目--}}
            <div class="col-md-4 col-sm-4">
               @include('layouts.rightNav')
            </div>

        </div>
    </div>

@endsection
@section('js')

    <script>

    </script>
@stop
