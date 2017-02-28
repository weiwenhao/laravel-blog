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
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    添加成功
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="penel-title">文章列表<a href="/admin/article/create" class="btn btn-success pull-right">添加文章</a>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table id="article-list" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>标题</th>
                                <th>简介</th>
                                <th>分类</th>
                                <th>发布时间</th>
                                <th>修改时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>

                        </table>
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

<script>
    var Article = function () {
        var run = function () {
            var table = $('#article-list').DataTable( {
                stateSave: false,//保存当前页面状态,再次刷新进来依旧显示当前状态,比如本页的排序规则,显示记录条数
                "language": {
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

                "serverSide": true,//开启服务器模式
                "searchDelay": 1000, //搜索框请求间隔
                // "lengthMenu": [15,25,50], //自定义每页显示条数菜单

                "search" : {
                    "regex": true
                },
                "ajax": {
                    "url" : '/admin/article/ajaxIndex',
                },
                "columns": [
                    /*{ 服务器模式不可添加
                     'data': null,
                     'title': "<input type='checkbox' name='checklist' id='checkall' />"
                     },*/

                    {
                        'name':'id', //传递给服务器的字段
                        'data':'id', //对应json中的字段
                        'title': 'ID', //会覆盖title
                    },
                    {
                        'name':'title',
                        'data':'title'
                    },
                    {
                        'name':'description',
                        'data':'description',
                        "orderable" : false,
                        render : function (data, type, row, meta) {
                            return '<div style="width:100px;overflow: hidden;white-space:nowrap;text-overflow: ellipsis;">'+data+'</div>';
                        }
                    },
                    {
                        'data':'cat_name',
                        "orderable" : false,
                    },
                    {
                        'name':'publish_at',
                        'data':'publish_at',
                    },
                    {
                        'name':'updated_at',
                        'data':'updated_at'
                    },
                    {
                        /*// 如果上面数居中office对于的值为 null 或者 undefined 则直接显示为空字符串
                         "defaultContent": "<a href='' class='btn btn-xs btn-info'><i class='glyphicon glyphicon-edit'></i> 编辑</a> " +
                         "<button href='' class='btn btn-xs btn-danger'><i class='glyphicon glyphicon-trash'></i>  删除</button>",
                         */
                        //操作列
                        'data' : null,
                        "orderable" : false, //是否开启排序
                    }

                ],
                //
                "columnDefs": [
                    /*{
                     "data": null,
                     "defaultContent": "<a href='' class='btn btn-xs btn-info'><i class='glyphicon glyphicon-edit'></i> 编辑</a> " +
                     "<button href='' class='btn btn-xs btn-danger'><i class='glyphicon glyphicon-trash'></i>  删除</button>",
                     "targets": -1  // 这里 -1 代表最后一列
                     },*/
                    {
                        // 'width': "120px",
                        targets: -1, //最后一列,
                        render: function(data, type, row, meta) {
                            // return '<input type="checkbox" name="checklist" value="' + row.id + '" />' //return的数据会覆盖第 targets中指定的列数
                            //row中拥有一行中的所有数据, row.id  row.name row.display_name
                            return "<a href='/admin/permission/"+row.id+"/edit' class='btn btn-xs btn-info'><i class='glyphicon glyphicon-edit'></i> 编辑</a>" +
                                "<button  value="+row.id+"  class='btn btn-xs btn-danger del-permission'><i class='glyphicon glyphicon-trash'></i>  删除</button>";
                        }
                    },
                    //给第二列指定宽度为表格整个宽度的20%
                    { "width": "20%", "targets": 1 }
                ],

            });
            $.ajaxSetup({ //这段话的意思
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', 'button.del-permission', function() {
                var url = '/admin/permission/'+$(this).val();
                layer.confirm('确定删除此数据？', {
                    btn: ['确定', '取消'],
                    icon: 2,
                },function(index){
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        success: function(data){
                            if (data){
                                //刷新dt
                                table.ajax.reload(null, false); //databales对象从新加载
                            }
                        }

                    });
                    layer.close(index);
                });
            });

        }
        return {
            init : run,
        }
    }();
    Article.init();
</script>
@stop


