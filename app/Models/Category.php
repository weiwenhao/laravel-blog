<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    /**
     * 分类和文章的一对多关联模型
     * 分类和文章的一对多关联模型
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles(){
        return $this->hasMany(Article::class,'cat_id','id');  //就近原则,取出来的是 all > model
    }
}
