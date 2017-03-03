@extends('admin.layouts.layout')
@section('css')
    <!-- Data Tables -->
    <link href="/back/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    {{--图片裁剪--}}
    <link rel="stylesheet" href="/back/css/plugins/cropper/cropper.min.css">
    <style>

    </style>
@stop
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1 animated fadeInRight">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="file-box">
                            <div class="file">
                                <a href="file_manager.html#">
                                    <span class="corner"></span>

                                    <div class="icon">
                                        <i class="fa fa-file"></i>
                                    </div>
                                    <div class="file-name">
                                        Document_2014.doc
                                        <br/>
                                        <small>添加时间：2014-10-13</small>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <div class="file-box">
                            <div class="file">
                                <a href="file_manager.html#">
                                    <span class="corner"></span>

                                    <div class="image">
                                        <img alt="image" class="img-responsive" src="img/p1.jpg">
                                    </div>
                                    <div class="file-name">
                                        Italy street.jpg
                                        <br/>
                                        <small>添加时间：2014-10-13</small>
                                    </div>
                                </a>

                            </div>
                        </div>

                    </div>
                </div>

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div>
                            <img class="img" src="" alt="">
                        </div>
                        <hr>
                        <form class="form-horizontal" id="add-key"  enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-5 control-label">上传图片:</label>
                                <label class="btn btn-primary" for="inputImage" title="Upload image file">
                                    <input class="hide" id="inputImage" name="file" type="file" accept="image/*">
                                    浏览本地文件
                                </label>
                                <button id="confirm_img" class="btn btn-success">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    {{--datatablesjs--}}
    <script src="/back/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/back/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <!-- layer javascript -->
    <script src="/back/js/plugins/layer/layer.min.js"></script>
    {{--图片裁剪--}}
    <script src="/back/js/plugins/cropper/cropper.min.js"></script>
    <script>
        var Article = function () {
            var run = function () {
                $.ajaxSetup({ //这段话的意思使用ajax,会将csrf加入请求头中
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                /**
                 * 图片裁剪示例
                 */
                var $image = $(".img");
                $image.cropper({
                    aspectRatio: 16/3,
                    // autoCropArea: 1,
                    data: {
                        x: 0,
                        y: 0,
                        width: 1270,
                        height: 380
                    },
                    done: function(data) {  //确定裁剪的坐标,大小

                    },
                });
                var $inputImage = $("#inputImage");

                if (window.FileReader) {
                    $inputImage.change(function() {
                        var fileReader = new FileReader(),
                            files = this.files,
                            file;

                        if (!files.length) {
                            return;
                        }

                        file = files[0];

                        if (/^image\/\w+$/.test(file.type)) {
                            fileReader.readAsDataURL(file);
                            fileReader.onload = function () {
                                $image.cropper("reset", true).cropper("replace", this.result);
                                $inputImage.val("");
                            };
                        } else {
                            showMessage("Please choose an image file.");
                        }
                    });
                } else {
                    $inputImage.addClass("hide");
                }

                //得到剪切过后的 64base数据
                $("#confirm_img").click(function() {
                    var dataURL = $image.cropper("getDataURL", "image/jpeg");
//                    $image.cropper("replace", dataURL);
                    //调用图片上传方法
                    storyImg(dataURL);
                    //等待图标
                    return false; //阻止表单提交
                });
                /**
                 * ajax上传图片
                 */
                function storyImg(dataURL) {
                    $.ajax({
                        type: "POST",
                        url: "/admin/img",
                        data:{'header_img':dataURL },
                        success: function(msg){
                            console.log(msg);
                        },
                        error: function (error) { //200以外的状态码走这里
                            console.log(error.responseJSON);
                        }
                    });
                }

                /**
                 * 鼠标移入微微放大的动画
                 */
                $('.file-box').each(function () {
                    animationHover(this, 'pulse');
                });

            }
            return {
                init : run,
            }
        }();

        //启动上面的函数
        Article.init();
    </script>
@stop


