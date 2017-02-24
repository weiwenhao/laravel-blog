<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['cat_name','cat_desc'];
    //

    public function articles(){
        return $this->hasMany(Article::class,'cat_id','id');  //就近原则,取出来的是 all > model
    }
}
