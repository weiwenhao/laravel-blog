@extends('admin.layouts.layout')
@section('css')
    {{--select2--}}
    <link rel="stylesheet" href="/back/css/select2.min.css">
    {{--markdown--}}
    <link rel="stylesheet" type="text/css" href="/back/css/plugins/markdown/bootstrap-markdown.min.css" />
<style>

</style>
@stop
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加文章</h5>

                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="/admin/article">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('title')?'has-error':'' }}">
                                <label class="col-sm-3 control-label">文章标题：</label>
                                <div class="col-sm-8">
                                    <input  name="title"  type="text" value="{{old('title')}}" class="form-control" minlength="3" required="" aria-required="true">
                                    @if($errors->has('title'))
                                        <span class="help-block m-b-none">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('description')?'has-error':'' }}">
                                <label class="col-sm-3 control-label">文章简介：</label>
                                <div class="col-sm-8">
                                    <textarea name="description" class="form-control" cols="30" rows="3" minlength="9" required="" aria-required="true">{{old('description')}}</textarea>
                                    @if($errors->has('description'))
                                        <span class="help-block m-b-none">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('cat_id')?'has-error':'' }}">
                                <label class="col-sm-3 control-label">分类选择：</label>
                                <div class="col-sm-8">
                                    <select class="cat-select form-control" name="cat_id">
                                        <option value="">请选择</option>
                                        @foreach($cats as $cat)
                                            <option value="{{ $cat->id }}" {{ $cat->id == old('cat_id')?'selected':'' }}>{{ $cat->name }}</option>
                                       @endforeach
                                    </select>
                                    @if($errors->has('cat_id'))
                                        <span class="help-block m-b-none">{{ $errors->first('cat_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('key_id')?'has-error':'' }}">
                                <label class="col-sm-3 control-label">关键字选择：</label>
                                <div class="col-sm-8">
                                    <select class="key-select form-control" multiple="multiple" name="key_id[]">
                                        @foreach($keys as $key)
                                            <option value="{{ $key->id }}" {{ in_array($key->id,old('key_id',[]))?'selected':'' }}>{{ $key->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('key_id'))
                                        <span class="help-block m-b-none">{{ $errors->first('key_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('content')?'has-error':'' }}">
                                <label class="col-sm-3 control-label">文章内容：</label>
                                <div class="col-sm-8">
                                    <textarea name="content" data-provide="markdown" rows="10">{{ old('content') }}</textarea>
                                    @if($errors->has('content'))
                                        <span class="help-block m-b-none">{{ $errors->first('content') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('publish_at')?'has-error':'' }}">
                                <label class="col-sm-3 control-label">发布时间：</label>
                                <div class="col-sm-8">
                                    <input name="publish_at" value="{{ old('publish_at',\Carbon\Carbon::now()) }}" class="form-control layer-date" placeholder="YYYY-MM-DD hh:mm:ss" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                    <label class="laydate-icon"></label>
                                    @if($errors->has('publish_at'))
                                        <span class="help-block m-b-none">{{ $errors->first('publish_at') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-danger" type="submit">返回</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    {{--select2--}}
    <script src="/back/js/select2.min.js"></script>

    <!-- simditor -->
    <script type="text/javascript" src="/back/js/plugins/markdown/markdown.js"></script>
    <script type="text/javascript" src="/back/js/plugins/markdown/to-markdown.js"></script>
    <script type="text/javascript" src="/back/js/plugins/markdown/bootstrap-markdown.js"></script>
    <script type="text/javascript" src="/back/js/plugins/markdown/bootstrap-markdown.zh.js"></script>
    {{--日期选择器--}}
    <script src="/back/js/plugins/layer/laydate/laydate.js"></script>
<script>
    $(document).ready(function() {
        //分类下拉框
        $(".cat-select").select2();
        //关键字下拉框
        $(".key-select").select2({
            placeholder: '可输入关键字搜索'
        });

    });
</script>
@stop