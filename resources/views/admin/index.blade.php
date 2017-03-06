@extends('admin.layouts.layout')
@section('css')
<style>
</style>
@stop
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

        <div class="col-sm-4">
            <div class="my-widget widget navy-bg p-lg text-center">
                <div class="m-b-md">
                    <i class="fa fa-heart-o"></i>
                    <h1 class="m-xs">{{ $articleCount }}</h1>
                    <h3 class="font-bold no-margins">
                        文章总数
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="my-widget widget lazur-bg p-lg text-center">
                <div class="m-b-md">
                    <i class="fa fa-sun-o"></i>
                    <h1 class="m-xs">456</h1>
                    <h3 class="font-bold no-margins">
                        日访问量
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="my-widget widget red-bg p-lg text-center">
                <div class="m-b-md">
                    <i class="fa fa-moon-o"></i>
                    <h1 class="m-xs">456</h1>
                    <h3 class="font-bold no-margins">
                        月访问量
                    </h3>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
@section('js')
<script>
	
</script>
@stop