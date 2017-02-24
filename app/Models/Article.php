<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = ['title','seo_title','description','content','cat_id','publish_at'];

    //将下列属性设置成carbon对象
    protected $dates = ['publish_at'];

    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id','id');
    }

    public function keys(){
        return $this->belongsToMany(Key::class);
    }

    public function scopePublish($query)
    {
        $key_id = request('key_id');
        $cat_id = request('cat_id');

        $where = [ //重构: 数据库的scrop方法中
            ['publish_at','<',Carbon::now()]
        ];

        if ($key_id){
            $key = Key::find($key_id);
            $query->$key->articles()->where($where); //加括号可以使用查询构造器
        }

        if($cat_id){
            $where[] = ['cat_id',$cat_id];
        }
        $query->where($where);




    }
}
