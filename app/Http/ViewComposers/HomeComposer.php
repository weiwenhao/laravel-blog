<?php
/**
 * Created by PhpStorm.
 * User: weiwenhao
 * Date: 17-2-21
 * Time: 下午7:04
 */

namespace App\Http\ViewComposers;


use App\Models\Img;
use App\Repositories\CategoryRepository;
use App\Repositories\KeyRepository;
use Illuminate\Contracts\View\View;

class HomeComposer
{
    /**
     * @var CategoryRepository
     */
    private $category;
    /**
     * @var KeyRepository
     */
    private $key;

    /**
     * 创建一个新的属性 composer.
     *
     * @param CategoryRepository $category
     * @param KeyRepository $key
     */
    public function __construct(CategoryRepository $category,KeyRepository $key)
    {
        // Dependencies automatically resolved by service container...

        $this->category = $category;
        $this->key = $key;
    }
    /**
     * 绑定数据到视图.
     *
    Laravel 学院致力于提供优质 Laravel 中文学习资源
    198本文档由 Laravel 学院(LaravelAcademy.org)提供
     * @return void
     */
    public function compose(View $view)
    {
        /**
         *
         */
        $categorys = $this->category->all();

        /*
         * 页头画布的文字,包括标题
         */
        $cat_id = request('cat_id');
        $key_id = request('key_id');
        $title = null;
        //指定标题栏目
        if ($cat_id){
            $title = $this->category->find($cat_id)->name;
        }
        //指定标题栏目
        if ($key_id){
            $title = $this->key->find($key_id)->name;
        }

        /**
         * 右侧标签云
         */
        $keys = $this->key->all();

        /**
         * header_img 的图片路径
         * 随机取得一张图片
         */
        $imgs = Img::get(['img']);
        $leng = $imgs->count();
        if($leng > 0 ){
            $img_path = $imgs[mt_rand(0,$leng-1)]->img;
        }else{
            $img_path = null;
        }



        //绑定变量到view中
        return $view->with(compact('categorys','title','keys','img_path'));
    }

}