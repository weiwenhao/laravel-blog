<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{

    protected $fillable = ['img','sm_img'];

    /**
     * 取出原图图片名称时加上图片路径
     * @param $data
     * @return string
     */
    public function getImgAttribute($data)
    {
        return config('blog.show_img_path').$data;
    }

    /**
     * 取出缩略图字段时加上路径
     * @param $data
     * @return string
     */
    public function getSmImgAttribute($data)
    {
        return config('blog.show_img_path').$data;
    }
}
