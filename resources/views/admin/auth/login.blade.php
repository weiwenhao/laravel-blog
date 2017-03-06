@extends('admin.layouts.layout')
@section('content')
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">w</h1>

            </div>
            <h3>Blog Admin</h3>

            <form class="m-t" role="form" method="post" action="/admin/login">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('email')?'has-error':'' }}">
                    <input type="email" name="email" class="form-control" placeholder="邮箱" required="">
                    @if($errors->has('email'))
                        <span class="help-block m-b-none">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password')?'has-error':'' }}">
                    <input type="password" name="password" class="form-control" placeholder="密码" required="">
                    @if($errors->has('password'))
                        <span class="help-block m-b-none">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>

            </form>
        </div>
    </div>
@endsection
