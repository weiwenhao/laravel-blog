@extends('admin.layouts.layout')
@section('css')
    <!-- Data Tables -->
    <link href="/back/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <style>

    </style>
@stop
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ session('success','系统错误') }}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="penel-title">分类列表</h3>
                    </div>
                    <div class="panel-body">
                        <table id="cat-list" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>分类名称</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                    <div class="panel-footer">
                        <form class="form-horizontal" id="add-cat">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-5 control-label">添加分类:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="name" class="form-control"  placeholder="分类名称">
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-success">添加</button>
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
    {{--datatablesjs--}}
    <script src="/back/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/back/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <!-- layer javascript -->
    <script src="/back/js/plugins/layer/layer.min.js"></script>
    <script>
        var Cat = function () {
            var run = function () {
                /**
                 * 这里改成ajax数据源
                 * datatables配置
                 * @type {jQuery}
                 */
                var table = $('#cat-list').DataTable( {
                    stateSave: false,//保存当前页面状态,再次刷新进来依旧显示当前状态,比如本页的排序规则,显示记录条数
                    language: {
                        "sProcessing": "处理中...",
                        "sLengthMenu": "每页显示 _MENU_ 条记录",
                        "sZeroRecords": "没有匹配结果",
                        "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
                        "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
                        "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
                        "sInfoPostFix": "",
                        "sSearch": "搜索:",
                        "sUrl": "",
                        "sEmptyTable": "表中数据为空",
                        "sLoadingRecords": "载入中...",
                        "sInfoThousands": ",",
                        "oPaginate": {
                            "sFirst": "首页",
                            "sPrevious": "上页",
                            "sNext": "下页",
                            "sLast": "末页"
                        },

                    }, //语言国际化
                    // "lengthMenu": [15,25,50], //自定义每页显示条数菜单
                    "sAjaxDataProp" : '',//加上该条ajax数据源才有效
                    "ajax": "/admin/category/ajax_category",
                    "order": [[ 0, "desc" ]],
                    "columns": [
                        { "data": "id" },
                        { "data": "name" },
                        { "data": null ,"orderable" : false, "width": "20%",}
                    ],
                    "columnDefs": [
                        //给第二列指定宽度为表格整个宽度的20%
                        {
                            "targets": -1, //制定列
                            render : function (data, type, row, meta) { //row相当于数据表中的一行,即get获得的一行数据
                                return "<button value='"+row.id+"' class='btn btn-xs btn-info edit-cat'><i class='fa fa-edit'></i> 编辑</button>&nbsp;"+
                                "<button value='"+row.id+"' class='btn btn-xs btn-danger del-cat'><i class='fa fa-trash'></i>  删除</button>";
                            }

                        }
                    ],
                });
                /**
                 * ajax删除标签
                 */
                $.ajaxSetup({ //这段话的意思使用ajax,会将csrf加入请求头中
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('body').on('click', 'button.del-cat', function() {
                    var url = '/admin/category/'+$(this).val(); //this代表删除按钮的DOM对象
                    layer.confirm('你确定要将该标签吗？', {
                        btn: ['确定', '取消'],
                        icon: 2,
                    },function(index){ //index代表当前的弹窗?? //1
//                     console.log(index); //1
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            success: function(data){
                                if (data){
                                    //刷新dt
                                    table.ajax.reload(null, false); //databales对象从新加载
                                    layer.close(index); //关闭larvel弹出框
                                    layer.msg('删除成功');
                                }
                            }

                        });

                    });
                });

                /**
                 * ajax编辑标签
                 * 在原有的tr上制作出编辑表单
                 */
                $('body').on('click','button.edit-cat',function () {
                    //点击编辑按钮,触发所有的取消事件
                    $('.close-cat').trigger('click');
//                     console.log(this); //<button value="1" class="btn btn-xs btn-info edit-cat">

                    //得到需要的数据
                    var button = $(this)
                    var tr = button.parent().parent(); //tr是一个jq对象
                    var td2 = tr.find('td').eq(1); //第二列td,即是拥有名字的那一列td
                    var cat_name = td2.text();      //取得第2的td中的值
                    //重新定义
                    button.parent().html("<button value='"+button.val()+"' class='btn btn-xs btn-success confirm-cat'><i class='fa fa-check'></i> 确定</button>&nbsp;"+
                        "<button value='"+button.val()+"' cat_name='"+cat_name+"' class='btn btn-xs btn-danger close-cat'><i class='fa fa-close'></i>  取消</button>"
                    )
                    //将第2栏的td内部追加一变成一个编辑框,value=原来td中的html值
                    td2.html('<input type="text" name="cat_name" value="'+cat_name+'" class="form-control"/>');
                    //点击确定发送ajax,回调中如果添加完成,则更改第二栏中cat的值
                })

                /*
                * 点击取消时取消表单的提交,将表单恢复原样
                * */
                $('body').on('click','button.close-cat',function () {
                    var button = $(this);//取消按钮
                    var tr = button.parent().parent(); //tr是一个jq对象
                    var td2 = tr.find('td').eq(1); //第二列td,即是拥有名字的那一列td
                    var cat_name = button.attr('cat_name');
                    var cat_id = button.val()
                    //第二列设置为文本框
                    td2.html(cat_name);
                    button.parent().html("<button value='"+cat_id+"' class='btn btn-xs btn-info edit-cat'><i class='fa fa-edit'></i> 编辑</button>&nbsp;" +
                        "<button value='"+cat_id+"' class='btn btn-xs btn-danger del-cat'><i class='fa fa-trash'></i>  删除</button>");
                })

                /**
                 *ajax提交编辑菜单
                 */
                $('body').on('click','button.confirm-cat',function () {
                    //找到该行的input输入框
                    var button = $(this)
                    var tr = button.parent().parent(); //tr是一个jq对象
                    var td2 = tr.find('td').eq(1); //第二列td,即是拥有名字的那一列td
                    var cat_name = td2.find('input').val();
                    var id = button.val();
                    //ajax,post提交到后台添加数据
                    $.ajax({
                        type: "PUT",
                        url: "/admin/category/"+id,
                        data: "name="+cat_name,
                        success: function(msg){
                             if(msg){ // true
                                //重新加载datatables
                                 table.ajax.reload(null, false);
                                 layer.msg('修改完毕');
                             }
                        },
                        error: function (error) { //200以外的状态码走这里
                            var name_error = error.responseJSON.name[0];
                            //弹出错误信息
                            layer.alert(name_error, {
                                icon: 2,
                                title: '错误',
                            });
                        }
                    });
                });

                /**
                 * ajax添加标签信息
                 */
                $('body').on('submit','form#add-cat',function () {
                    var data = $(this).serialize(); //name=sfsadf%E5%AE%89%E6%8A%9A&test=sdfsdfsdf
                    var form = $(this);
                    //可以直接去尝试在表单中使用find搜索input,且name为name的
                    //ajax添加一条数据
                    $.ajax({
                        type: "POST",
                        url: "/admin/category",
                        data:data,
                        success: function(msg){
                             if(msg){
                                 //清空表单
                                 form.trigger('reset');
                                 //刷新datatables
                                 table.ajax.reload(null, false);
                                 //提示添加成功
                                 layer.msg('添加成功');
                             }
                        },
                        error: function (error) { //200以外的状态码走这里
                            var name_error = error.responseJSON.name[0];
                            layer.alert(name_error, {
                                icon: 2,
                                title: '错误',
                            });

                        }
                    });
                    return false;//阻止表单提交
                })
            }

            //返回整个函数
            return {
                init : run,
            }
        }();

        //启动上面的函数
        Cat.init();
    </script>
@stop


