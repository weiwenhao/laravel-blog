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
     * 得到文章的查询构造器
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
}