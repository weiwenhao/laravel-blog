<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Key;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $article;
    /**
     * @var CategoryRepository
     */

    /**
     * ArticleController constructor.
     * @param ArticleRepository $article
     */
    public function __construct(ArticleRepository $article)
    {
        $this->article = $article;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articles = $this->article->getArticleList(5);


//          dd($articles); //这里得到的是一个分页实例LengthAwarePaginator,因此可以调用该实例的方法
        return view('home',compact('articles','cat_name','key_name'));
    }



    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($seo_title)
    {
        $article = $this->article->findBy('seo_title',$seo_title);
        $pager = $this->article->getPager($article->publish_at);
        $next = $pager['next'];
        $previous = $pager['previous'];
        return view('show',compact('article','next','previous'));
    }


}
