<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Services\MarkDown\MarkDown;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $markdown;

    /**
     * CommentController constructor.
     * @param $markdown
     */
    public function __construct(MarkDown $markdown)
    {
        $this->markdown = $markdown;
    }

    /**
     * 得到评论列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCommentList()
    {
        $article_id = request('article_id');
        $comment_list = Comment::where('article_id',$article_id)->orderBy('created_at','desc')->paginate(5);
        //进行markdown解析
        foreach ($comment_list as $comment){  //这种代码段如何优化
            $comment->content = $this->markdown->convertToHtml($comment->content);
        }
        return response()->json($comment_list);
    }

    public function storyComment(CommentRequest $request){
        /*$request->all()*/
        $res = Comment::create($request->all());
        return response()->json($res);
    }

}
