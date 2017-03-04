<?php

namespace App\Http\Controllers\Admin;

use App\Models\Img;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ImgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imgs = Img::get();
        return view('admin.img.list',compact('imgs'));
    }

    /**
     * 返回相册列表,   [{},{}]
     * @return \Illuminate\Http\JsonResponse
     */
    public function getImgs(){
        $imgs = Img::get();
        return response()->json($imgs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //判断一下$request是否为空
        if($request->get('header_img')){
            //设置图片的保存路径
            $path = public_path(config('blog.img_path'));
//        dd($path);  //""/home/weiwenhao/Code/blog/public/uploads/images/""
            $image_name = date('YmdHis').'.jpg';
//        dd($path.$image_name); // "/home/weiwenhao/Code/blog/public/uploads/images/20170304000643.jpg"
            //原图
            \Image::make($request->get('header_img'))->resize(1270,380)->save($path.$image_name);
            //缩略图
            \Image::make($request->get('header_img'))->resize(198,(198/1270)*380)->save($path.'sm_'.$image_name);

            //数据入库
            $res = Img::create([
                'img' => $image_name,
                'sm_img' => 'sm_'.$image_name,
            ]);
            if($res){
                return response()->json([
                    'img' => $res->img,
                    'sm_img' => $res->sm_img
                ]);
            }
        }
        return response()->json(false);
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
        //删除文件目录的文件
        $img = Img::find($id);

        $img_file = public_path($img->img);
        $sm_img_file = public_path($img->sm_img);
        @unlink($sm_img_file);
        @unlink($img_file);
        //删除记录
        $res = $img->delete();
        //返回json
        return response()->json($res);
    }
}
