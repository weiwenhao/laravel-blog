<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * 得到评论列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCommentList()
    {
        $article_id = request('article_id');
        $comment_list = Comment::where('article_id',$article_id)->orderBy('created_at','desc')->paginate(5);
        return response()->json($comment_list);
    }

    public function storyComment(CommentRequest $request){

    }

}
