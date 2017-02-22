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
    </style>
@stop

@section('header-content')
    <div class="site-heading">
        <h1>{{ $article->category->cat_name }}</h1>
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
                                                <span class="label label-info" style="font-size: 90%"> <i class="glyphicon glyphicon-tags"></i>&nbsp; &nbsp;{{ $key->name }}</span>
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
                                    {{ $article->content }}
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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>评论</h4>
                    </div>
                    <div class="panel-body">
                        <div>
                            {{--评论列表--}}
                            <ul class="list-unstyled">
                                <li class="comment">
                                    <div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <h3>1101140857@qq.com :</h3>
                                            </div>
                                        </div>


                                        <p>
                                            文章对我的帮助很大,但是有几个地方仍然需要改进
                                            文章对我的帮助很大,但是有几个地方仍然需要改进
                                            文章对我的帮助很大,但是有几个地方仍然需要改进
                                        </p>
                                        <br>
                                        <span class="pull-right">
                                            2017年02月21日17:25:29
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>
                                </li>
                                <li class="comment">
                                    <div>
                                        <h3>1101140857@qq.com :</h3>
                                        <p>
                                            文章对我的帮助很大,但是有几个地方仍然需要改进
                                            文章对我的帮助很大,但是有几个地方仍然需要改进
                                            文章对我的帮助很大,但是有几个地方仍然需要改进
                                        </p>
                                        <br>
                                        <span class="pull-right">
                                            2017年02月21日17:25:29
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>
                                </li>
                                <li class="comment">
                                    <div>
                                        <h3>1101140857@qq.com :</h3>
                                        <p>
                                            文章对我的帮助很大,但是有几个地方仍然需要改进
                                            文章对我的帮助很大,但是有几个地方仍然需要改进
                                            文章对我的帮助很大,但是有几个地方仍然需要改进
                                        </p>
                                        <br>
                                        <span class="pull-right">
                                            2017年02月21日17:25:29
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>
                                </li>
                            </ul>
                            {{--评论分页--}}
                            <div class="text-center">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <li>
                                            <a href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li>
                                            <a href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <hr>
                        {{--评论提交表单--}}
                        <form action="" class="">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="自定义用户名 例: 1101140857@qq.com">
                            </div>
                            <div class="form-group">
                                <textarea name="" id="" class="form-control"  rows="6" placeholder="支持MarkDown语法"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 col-md-offset-4">
                                    <img src="http://usr.im/200x50?text=null" width="100%" alt="">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" placeholder="请输入验证码">
                                </div>
                                <div class="pull-right">
                                    <button class="btn btn-success">提交评论</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@stop
