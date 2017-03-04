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
                <div class="row" id="img">
                    <div class="col-sm-12">
                        @foreach($imgs as $img)
                            <div class="file-box" >
                                <div class="file" style="position: relative;">{{--相对定位--}}
                                    <div style="position: absolute;top: -10px;right:-10px;"> {{--绝对定位--}}
                                        <button class="del-img btn btn-circle btn-default" value="{{$img->id}}"><i class="fa fa-times"></i></button>
                                    </div>
                                    <a value="{{ $img->img }}" class="show_img">
                                        <span class="corner"></span>
                                        <div>
                                            <img alt="image" class="img-responsive" src="{{ $img->sm_img }}">
                                        </div>
                                        <div class="file-name">
                                            <br>
                                            <small>添加时间：{{ $img->created_at->toDateString() }}</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
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
        var img = new Vue({
            el: '#img',
            data: {
                imgs:[],
            },
            created(){
                axios.get('/admin/img/get_imgs', {
                	/*params: {
                		article_id: this.article_id,
                	}*/
                })
                .then(response=> {
                	 console.log(response);

                })
                .catch(error=> {
                	console.log(error);
                });
            },
            computed:{

            },
            methods:{

            }
        })






        var Article = function () {
            var run = function () {
                $.ajaxSetup({ //这段话的意思使用ajax,会将csrf加入请求头中
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                /*
                * ajax删除一张图片
                * */
                $('button.del-img').click(function () {
                     //整个 file-box 框框
                    var img_div = $(this).parent().parent().parent();
                    //需要删除的图片的id
                    var img_id = $(this).val();
                    var url = '/admin/img/'+img_id;
                    layer.confirm('你确定要将该标签吗？', {
                        btn: ['确定', '取消'],
                        icon: 2,
                    },function(index){ //index代表当前的弹窗?? //1
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            success: function(data){
                                if (data){
                                    //清除img_div
                                    img_div.parent().remove(img_div);
                                    layer.close(index); //关闭larvel弹出框
                                    layer.msg('删除成功');
                                }
                            }

                        });
                    });

                });

                /*
                * 显示大图
                * */
                $('a.show_img').click(function () {
//                     console.log($(this).val());
                    //layer iframe弹出层,显示图片地址
                    var url = $(this).attr('value');
                    layer.open({
                        type: 2,
                        title: false,
                        closeBtn: 0,
                        area: ['1270px','380px'],
                        shade: 0.5,
                        shadeClose: true,
                        content: url,
                    });
                });
                
                
                (function() {
                    /**
                     * 图片裁剪示例
                     */
                    var $image = $(".img");
                    $image.cropper({
                        aspectRatio: 1270/380,
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
                })();


            }
            return {
                init : run,
            }
        }();

        //启动上面的函数
        Article.init();
    </script>
@stop


