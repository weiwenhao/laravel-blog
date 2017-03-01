<?php
/**
 * Created by PhpStorm.
 * User: weiwenhao
 * Date: 17-2-21
 * Time: 下午6:52
 */

namespace App\Repositories;

use App\Models\Key;
use Bosnadev\Repositories\Eloquent\Repository;

class KeyRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Key::class;
    }

    /**
     * 倒序获得标签列表
     * @return mixed
     */
    public function getKeyList()
    {
        return $this->model->orderBy('id','desc')->get();  //查询构造器不存在all方法, all属于orm模型
    }

}