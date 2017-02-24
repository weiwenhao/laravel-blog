<div class="panel panel-default">
    <div class="panel-heading">搜索</div>
    <div class="panel-body">
        <div class="col-md-8">
            <input type="text" class=" form-control">
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> 搜索</button>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">关键字</div>
    <div class="panel-body">
        @if($keys)
            @foreach( $keys as $key)
                <a href="/article?key_id={{ $key->id }}"
                   style="font-size: {{ mt_rand(12,30) }}px;color:rgb({{ mt_rand(0,255) }}, {{ mt_rand(0,255) }}, {{ mt_rand(0,255) }});"
                >{{ $key->name }}</a>
                {{--<a href="/blog?tag=rem">{{ $key->name }}</a>--}}
            @endforeach
        @endif
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">最新文章</div>
    <div class="panel-body">
        <ul class="list-unstyled">
            @if($newArticle)
                @foreach($newArticle as $article)
                    <li style="margin-top: 20px"><a href="/article/{{ $article->seo_title }}">{{ $article->title }}</a></li>
                @endforeach
            @endif
        </ul>
    </div>
</div>