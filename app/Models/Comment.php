<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['username','content','article_id'];

    /**
     * 定义和文章的关联关系
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
