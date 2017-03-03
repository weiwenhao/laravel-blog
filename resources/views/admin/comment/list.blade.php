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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="penel-title">标签列表</h3>
                    </div>
                    <div class="panel-body">
                        <table id="comment-list" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>用户名</th>
                                <th>评论内容</th>
                                <th>文章标题</th>
                                <th>点赞数</th>
                                <th>评论时间</th>
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
    <!-- layer javascript -->
    <script src="/back/js/plugins/layer/layer.min.js"></script>
    <script>
        var Article = function () {
            var run = function () {
                /**
                 * datatables配置
                 * @type {jQuery}
                 */
                var table = $('#comment-list').DataTable( {
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
                    "order": [[ 4, "desc" ]],
                    "serverSide": true,//开启服务器模式
                    "searchDelay": 1000, //搜索框请求间隔
                    // "lengthMenu": [15,25,50], //自定义每页显示条数菜单

                    "search" : {
                        "regex": true  //正则搜索还是精确搜索
                    },
                    "ajax": {
                        "url" : '/admin/comment/ajax_index',
                    },
                    "columns": [
                        {
                            'name':'username', //传递给服务器的字段,排序等一些操作时可以用到
                            'data':'username', //对应json中的字段
                            'title': '用户名', //会覆盖title
                            "orderable" : false,
                        },
                        {
                            'name':'content',
                            'data':'content',
                            "orderable" : false,
                            width: '40%'
                            /*render : function (data, type, row, meta) { //data可以理解为row的缩减版本,只拥有该列拥有的数据
                                return '<div style="width: 200px;overflow: hidden;white-space:nowrap;text-overflow: ellipsis;">'+row.content+'</div>';
                            }*/
                        },
                        {
                            'name':'article_name',
                            'data':'article_name',
                            "orderable" : false,

                        },
                        {
                            'name': 'goodNum',
                            'data':'goodNum',
                            /*"orderable" : false,*/
                        },
                        {
                            'name':'created_at',
                            'data':'created_at'
                        },
                        {
                            'data' : null,
                            "orderable" : false, //是否开启排序
                            render: function(data, type, row, meta) {
                                return "<button value="+row.id+" class='btn btn-xs btn-danger del-comment'><i class='fa fa-trash'></i>  删除</button>";
                            }
                        }

                    ],

                });
                /**
                 * ajax删除文章
                 */
                $.ajaxSetup({ //这段话的意思使用ajax,会将csrf加入请求头中
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('body').on('click', 'button.del-comment', function() {
                    var url = '/admin/comment/'+$(this).val(); //this代表删除按钮的DOM对象
                    layer.confirm('你确定要将该文章吗？', {
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
                                    layer.close(index); //关闭larvel弹出框
                                    layer.msg('删除成功');
                                }
                            }

                        });

                    });
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


