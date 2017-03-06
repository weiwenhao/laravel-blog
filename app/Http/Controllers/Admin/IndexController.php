<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    protected $article;

    /**
     * IndexController constructor.
     * @param $article
     */
    public function __construct(ArticleRepository $article)
    {
        $this->article = $article;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articleCount = $this->articleCount();
        return view('admin.index',compact('articleCount'));
    }

    /**
     * 文章的总数
     * @return mixed
     */
    private function articleCount(){
       return  $this->article->all()->count();
    }
}
