@extends('admin.layouts.adminLayout')

@section('content')
    <div class="container">
        {{ auth('admin')->user()->name }}
    </div>
@endsection
