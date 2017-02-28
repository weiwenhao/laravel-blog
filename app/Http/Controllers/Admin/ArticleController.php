<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\KeyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    protected $article;
    /**
     * @var KeyRepository
     */
    private $key;
    /**
     * @var CategoryRepository
     */
    private $cat;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $article
     * @param KeyRepository $key
     * @param CategoryRepository $cat
     */
    public function __construct(ArticleRepository $article,KeyRepository $key,CategoryRepository $cat)
    {
        $this->article = $article;
        $this->key = $key;
        $this->cat = $cat;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.article.list');
    }

    /**
     * ajax获得文章数据
     */
    public function ajaxIndex(){
        $res = $this->article->getDataTables();
        return response()->json($res);//转化成json对象并返回
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //关键字数据
        $keys = $this->key->all(['id','name']);
        //分类数据
        $cats = $this->cat->all(['id','cat_name']);
        return view('admin.article.add',compact('keys','cats'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        dd($request->all());
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
