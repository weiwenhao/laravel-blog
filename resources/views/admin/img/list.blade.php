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
    <div class="wrapper wrapper-content" id="img">
        <div class="row" >
            <div class="col-sm-11 col-sm-offset-1 animated fadeInRight">
                <div class="col-sm-12">
                    <template v-for="(img,index) in imgs">
                        <div class="file-box"  >
                            <div class="file" style="position: relative;">{{--相对定位--}}
                                <div style="position: absolute;top: -10px;right:-10px;"> {{--绝对定位--}}
                                    <button @click="del_img(img,index)" class="btn btn-circle btn-default" :value="img.id"><i class="fa fa-times"></i></button>
                                </div>
                                <a @click="show_img(img)">
                                <span class="corner"></span>
                                <div>
                                    <img alt="image" class="img-responsive" :src="img.sm_img">
                                </div>
                                <div class="file-name">
                                    <br>
                                    <small>添加时间：@{{ img.created_at }}</small>
                                </div>
                                </a>
                            </div>
                        </div>
                    </template>
                    <div class="file-box">
                        <a href="/admin/img/create">
                            <button  id="add-img" class="btn btn-default  dim btn-large-dim btn-outline" type="button">
                                <i class="glyphicon glyphicon-plus"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('js')
    {{--引入打包后的admin.js 主要包含 vue 和 vue-axios--}}
    <script src="/js/admin.js"></script>
    <!-- layer javascript -->
    <script src="/back/js/plugins/layer/layer.min.js"></script>
    <script>
        var img = new Vue({
            el: '#img',
            data: {
                ifAddImg: null,
                imgs: [],
                dialogVisible: false,
            },
            created(){
                this.get_imgs();
            },
            methods: {
                /*
                 * 获得图片列表数据
                 * */
                get_imgs(){
                    axios.get('/admin/img/get_imgs', {})
                    .then(response => {
                        this.imgs = response.data; //这里是数据变化源

                        this.$nextTick(function () {
                            $('.file-box').each(function () {
                                animationHover(this, 'pulse');
                            });
                        })
                    })
                    .catch(error => {
                        console.log(error);
                    });
                },

                /**
                 *
                 * 展示一张图片
                 * */
                show_img(img){
                    layer.open({
                        type: 2,
                        title: false,
                        closeBtn: 0,
                        area: ['1280px', '400px'],
                        shade: 0.5,
                        shadeClose: true,
                        content: img.img,
                    });
                },

                /*
                * 删除一张图片
                **/
                del_img(img,index){
                    this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(() => {
                        //点了确定定操作时
                        axios.delete('/admin/img/'+img.id)
                        .then(response=> {
                            if(response.data){
//                                this.get_imgs();
                                this.imgs.splice(index,1);
                                this.$message({
                                    type: 'success',
                                    message: '删除成功!'
                                });
                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });


                    }).catch(() => {
                        //点了取消操作时
                        /*this.$message({
                            type: 'info',
                            message: '已取消删除'
                        });*/
                    });



                    /**/
                },

            }

        });
    </script>
@stop


