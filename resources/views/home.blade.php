@extends('layouts.app')
@section('css')

@stop
@section('content')

{{--页面主体--}}
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    @foreach($articles as $k => $article)
                    <div class="post-preview">
                        <a
                            href="{{ url('article',[$article->seo_title]) }}@if(request('cat_id'))?cat_id={{request('cat_id')}}@endif @if(request('key_id'))?key_id={{request('key_id')}}@endif"
                        >
                            <h1 class="post-title">{{ $article->title }}</h1>
                            <h3 class="post-subtitle">{{ $article->description }}</h3>
                        </a>

                        <p class="post-meta">
                            Wei on {{ $article->publish_at->toDateString() }}
                            in
                            @if($article->keys)
                                @foreach( $article->keys as $key)
                                    <a href="/article?key_id={{ $key->id }}">
                                        <span class="label {{ request('key_id') == $key->id?'label-success':'label-info' }}"  style="font-size: 66%"> <i class="glyphicon glyphicon-tag"></i>&nbsp; &nbsp;{{ $key->name }}</span>
                                    </a>
                                    {{--<a href="/blog?tag=rem">{{ $key->name }}</a>--}}
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <hr>
                    @endforeach
                    <div class="text-center">
                        {{ $articles->appends(['cat_id'=>request('cat_id'),'key_id'=>request('key_id'),'search'=>request('search')])->links() }}
                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-4 col-sm-4">
        @include('layouts.rightNav')
        </div>

    </div>
</div>

@endsection
