<?php
/**
 * Created by PhpStorm.
 * User: weiwenhao
 * Date: 17-2-21
 * Time: 下午7:04
 */

namespace App\Http\ViewComposers;

use App\Repositories\ArticleRepository;
use App\Repositories\KeyRepository;
use Illuminate\Contracts\View\View;

class RightNavComposer
{

    /**
     * @var KeyRepository
     */
    private $key;
    /**
     * @var ArticleRepository
     */
    private $articel;

    /**
     * 创建一个新的属性 composer.
     *
     * @param KeyRepository $key
     */
    public function __construct(KeyRepository $key,ArticleRepository $articel)
    {
        // Dependencies automatically resolved by service container...
        $this->key = $key;
        $this->articel = $articel;
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
         * 右侧标签云
         */
        $keys = $this->key->all();

        /*
         * 最新的10篇文章
         */
        $newArticle = $this->articel->getNewArticle(5);
        //绑定变量到view中
        return $view->with(compact('keys','newArticle'));
    }

}