<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = ['title','seo_title','description','content','cat_id','publish_at'];

    //将下列属性设置成carbon对象,即取出的该字段可以操作carbon
    protected $dates = ['publish_at'];

    /**
     * 分类关联模型
     */
    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id','id');
    }

    /**
     * 关键字关联模型
     * @return mixed
     */
    public function keys(){
        return $this->belongsToMany(Key::class);
    }

    /**
     * 评论关联关系
     */
    public function comments()
    {
        return $this->hasMany(Comment::class,'article_id','id');
    }


    /*public function scopePublish($query){
         Article::publish(); 可以类似这样调用
    }*/
}
