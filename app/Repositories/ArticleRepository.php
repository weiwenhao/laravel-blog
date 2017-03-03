<?php
/**
 * Created by PhpStorm.
 * User: wwh
 * Date: 17-2-18
 * Time: 下午12:06
 */

namespace App\Repositories;


use App\Models\Article;
use App\Models\Key;
use Bosnadev\Repositories\Eloquent\Repository;
use Carbon\Carbon;

class ArticleRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Article::class;
    }


    /**
     * 得到文章列表,带有缓存
     * @return mixed    数组套对象
     */
    public function getArticleList($pageSize){
        /*if(\Cache::get('articles')){
            return \Cache::get('articles');
        }
        \Cache::put('articles',$data,60);

        */
        $data = $this->commonBuilder()->select('id','title','seo_title','description','publish_at')->orderBy('publish_at','desc')->paginate($pageSize);
        return $data;
    }


    /**
     * 得到最新的几篇文章,服务于右侧文章列表
     */
    public function getNewArticle($num){
        $data = $this->model->where('publish_at','<',Carbon::now())->orderBy('publish_at','desc')->limit($num)->get(['title','seo_title']);
        return $data;
    }

    /**
     * 得到文章显示页面的上一篇和下一篇数据
     * @return array
     */
    public function getPager($thisPublicshAt){

        //下一篇  发表时间要早于(小于)当前这篇文章的发表时间
        $next = $this->commonBuilder()->where('publish_at','<',$thisPublicshAt)->select('title','seo_title','publish_at')->orderBy('publish_at','desc')->first();

        //上一篇
        $previous = $this->commonBuilder()->where('publish_at','>',$thisPublicshAt)->select('title','seo_title','publish_at')->orderBy('publish_at','asc')->first();

        return [
            'next'=>$next,
            'previous' => $previous
        ];
    }


    /**
     * 得到文章的datetables需要用到的数据
     * @return mixed Builder
     */
    private function commonBuilder(){
        $key_id = request('key_id');
        $cat_id = request('cat_id');
        $search = request('search');
        $where = [ //重构: 数据库的scrop方法中
            ['publish_at','<',Carbon::now()]
        ];

        if($cat_id){
            $where[] = ['cat_id',$cat_id];

        }
        $data = $this->model->where($where);

        //搜索这里类似与cat_id直接加条件即可
        if($search){ //不带标签部分,如果带标签怎么处理?连表吗?
            $data = $data->where('title','like',"%$search%")
                ->orWhere('description','like',"%$search%");
//                ->orWhere('content','like',"%$search%"); //标题部分.在where的基础上添加一个
        }

        if ($key_id){
            $key = Key::find($key_id);
            $data = $key->articles()->where($where); //加括号可以使用查询构造器
        }

        return $data;
    }


    /**
     * ajaxIndex获得datatables需要的数据
     * @return array
     */
    public function getDataTables(){  // [] column
//        dd(request()->all());
        $draw = request('draw',1);
        $order['field'] =  request('columns.'.request('order.0.column',0).'.name','id');
        $order['dir'] = request('order.0.dir','asc'); //设置默认的排序值
        $start = request('start');
        $length = request('length');
        $search['value'] = request('search.value');
        $search['regex'] = request('search.regex','false'); //字符串格式的false和true
        $data = $this->model->with('category');
        if ($search['value']){
            if ($search['regex'] == 'true'){ //使用正则,
                $data =  $data->where('title','like',"%{$search['value']}%")
                    ->orWhere('description','like',"%{$search['value']}%")
                    ->orderBy($order['field'],$order['dir']);
            }else{
                $data =  $data->where('title',$search['value'])
                    ->orWhere('description',$search['value'])
                    ->orderBy($order['field'],$order['dir']);
            }
        }
        //记录总记录数
        $total = $data->count();
        //加上排序和分页
        $data = $data->orderBy($order['field'],$order['dir'])->offset($start)->limit($length)->get(['id','title','seo_title','description','publish_at','updated_at','cat_id']);
        //为返回对象添加一个name,再添加两个按钮,编辑和删除
        foreach ($data as $value){ //取出关联键才能使用关联模型, 对象自带引用传递属性 ,$value是单个article模型
            $value->name = $value->category->name;
        }
        return [
            "draw" => $draw,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            "data" => $data
        ];
    }
}