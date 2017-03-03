<?php
/**
 * Created by PhpStorm.
 * User: weiwenhao
 * Date: 17-3-2
 * Time: 下午3:37
 */

namespace App\Repositories;


use App\Models\Comment;
use Bosnadev\Repositories\Eloquent\Repository;

class CommentRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Comment::class;
    }

    /**
     * 删除文章id对应的所有评论
     * @param $article_id
     * @return mixed
     */
    public function deleteComment($article_id)
    {
        $res =  $this->model->where('article_id',$article_id)->delete();
//        dd($res); // 7 返回删除了评论的数目??这原生的的很像
        return $res;
    }

    public function getDataTables()
    {
        $draw = request('draw',1);
        $order['field'] =  request('columns.'.request('order.0.column',0).'.name','id');
        $order['dir'] = request('order.0.dir','asc'); //设置默认的排序值,不过一般都是在前端dt的配置文件中设置
        $start = request('start');
        $length = request('length');
        $search['value'] = request('search.value');
        $search['regex'] = request('search.regex','false'); //字符串格式的false和true
        $data = $this->model->with('article');
        if ($search['value']){
            if ($search['regex'] == 'true'){ //使用正则,
                $data =  $data->where('username','like',"%{$search['value']}%")
                    ->orWhere('content','like',"%{$search['value']}%")
                    ->orderBy($order['field'],$order['dir']);
            }else{
                $data =  $data->where('username',$search['value'])
                    ->orWhere('content',$search['value'])
                    ->orderBy($order['field'],$order['dir']);
            }
        }
        //记录总记录数
        $total = $data->count();
        //加上排序和分页
        $data = $data->orderBy($order['field'],$order['dir'])->offset($start)->limit($length)->get(['id','username','content','article_id','goodNum','created_at']);
        //为返回对象添加一个name,再添加两个按钮,编辑和删除
        foreach ($data as $value){ //取出关联键才能使用关联模型, 对象自带引用传递属性 ,$value是单个article模型
            $value->article_name = $value->article->title;
        }
        return [
            "draw" => $draw,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            "data" => $data
        ];
    }
}