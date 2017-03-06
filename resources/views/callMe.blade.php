@extends('layouts.app')
@section('css')

@stop
@section('header-content')
    <div class="site-heading">
        <h1>联系我</h1>
        <hr class="small">
        <h3>www.weiwenhao.org</h3>
    </div>
@stop
@section('content')
<div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            {{ session('success','系统错误') }}
                        </div>
                    @endif
                    <form method="post" action="/call_me">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('email')?'has-error':'' }}">
                            <label for="exampleInputEmail1"><h2>您的邮箱：</h2></label>
                            <input type="email" name="email" value="{{ old('email') }}" required="" class="form-control" id="exampleInputEmail1" placeholder="请填写您正确的邮箱，以便我日后与您联系。">
                            @if($errors->has('email'))
                                <div class="alert alert-danger" v-if="content_error">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('content')?'has-error':'' }}">
                            <label for="exampleInputPassword1"><h2>内容：</h2></label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control" placeholder="支持MarkDown语法">{{ old('content') }}</textarea>
                            @if($errors->has('content'))
                                <div class="alert alert-danger" v-if="content_error">{{ $errors->first('content') }}</div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success form-control">发送</button>
                    </form>
                </div>
            </div>
</div>

@stop
@section('returnTop')
@stop


