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
        /**
         *dd($request->all());
         * array:7 [▼
        "_token" => "7c7Ga7Sxpoi6fijMFWaBpxxHjt9adbndUEmwOAdU"
            "title" => "ssss"
            "description" => "sdffffffffffffffffffffffffff"
            "cat_id" => "3"
            "key_id" => array:2 [▼
                0 => "4"
                1 => "1"
            ]
            "content" => "sddddddddddddddddddddddddddddddddddddddddddds"
            "publish_at" => "2017-03-01 09:06:44"
            ]
         */
//        dd($request->input('key_id')); //input的效果和get的效果相同
        //seo_title设置
        $seo_title = translug($request->get('title'));
        //数据入库
        $article = $this->article->create(array_merge($request->all(),['seo_title'=>$seo_title]));
        //插入key_id到中间表;
        $article->keys()->attach($request->get('key_id'));
        //重定向到文章列表页
        return redirect('/admin/article')->withSuccess('新文章已经添加成功');
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
        //关键字数据
        $keys = $this->key->all(['id','name']);
        //分类数据
        $cats = $this->cat->all(['id','cat_name']);
        //单条文章数据
        $article = $this->article->find($id);
        //$key_ids
        $key_ids =array_column($article->keys->toArray(),'id');
        //返回一个试图文件,并分配数据
        return view('admin.article.edit',compact('article','keys','cats','key_ids') );
    }

    /**
     * Update the specified resource in storage.
     * @param ArticleRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = $this->article->find($id);
        //更新 seo_title
        //seo_title设置
        $seo_title = translug($request->get('title'));
        //更新文章列表 , update方法,可以更新多行数据
        $res = $article->update(array_merge($request->all(),['seo_title'=>$seo_title]));
        if($res){
            //更新文章对应标签, 添加时使用 attach([]) ,更新应该使用 sync([])
            $article->keys()->sync($request->get('key_id'));
            //重定向
            return redirect('/admin/article')->withSuccess('文章更新成功');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        dd($this->article->delete($id));//int  1  0
        //删除中间表中的数据
        $article = $this->article->find($id);
        $article->keys()->sync([]);
        $res = $article->delete($id);
        return response()->json($res);
    }
}
