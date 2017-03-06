<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    protected $comment;

    /**
     * CommentController constructor.
     * @param $comment
     */
    public function __construct(CommentRepository $comment)
    {
        $this->comment = $comment;
    }

    /**
     * dataTable表格服务器模式下需要的数据源
     */
    public function ajaxIndex()
    {
        $res = $this->comment->getDataTables();
        return $res;//转化成json对象并返回
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $res = $this->comment->delete($id);
        return response()->json($res);  //true
    }
}
