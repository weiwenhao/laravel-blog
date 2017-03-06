<?php

namespace App\Http\Controllers;

use App\Mail\CallMeMail;
use App\Models\Category;
use App\Models\Key;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Services\MarkDown\MarkDown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    private $article;
    /**
     * @var MarkDown
     */
    private $markdown;
    /**
     * @var CategoryRepository
     */

    /**
     * ArticleController constructor.
     * @param ArticleRepository $article
     */
    public function __construct(ArticleRepository $article,MarkDown $markdown)
    {
        $this->article = $article;
        $this->markdown = $markdown;
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
        return view('home',compact('articles'));
    }



    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($seo_title)
    {
        $article = $this->article->findBy('seo_title',$seo_title);
        $article->content = $this->markdown->convertToHtml($article->content);//markdown解析
        $pager = $this->article->getPager($article->publish_at);
        $next = $pager['next'];
        $previous = $pager['previous'];
        return view('show',compact('article','next','previous'));
    }

    /**
     * 展示联系我的表单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCallMe()
    {
        return view('callMe');
    }
    /**
     * 接收用户发送的邮件表单请求
     * @param Request $request
     */
    public function callMe(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'content' => 'required|min:6',
        ],[
            'content.min' => '君可谓字字珠玑呀！'
        ]);
        //发送邮件  to为要发送到的邮件地址,这里是别人联系我,所以选择我自己的邮件地址
        Mail::to('ay1101140857@163.com')->send(new CallMeMail($request)); //依赖注入
        return redirect('/call_me')->withSuccess('邮件已发送');
    }


}
