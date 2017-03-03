<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $category;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $category
     * @internal param $category
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * 获得关键字列表,返回json数据
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxIndex()
    {
        $cat = $this->category->all();
        return response()->json($cat);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.list');
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
        //表单验证
        $this->validate($request, [
//            'title' => 'required|unique:posts|max:255',
            'name' => 'required|unique:categories'
        ],[
            'name.required' => '请填写分类名！',
            'name.unique' => '该分类名已经被使用！'
        ]);
        //数据插入
        $res = $this->category->create($request->all());
        if($res){
//            return response()->json($res); //直接把新插入的整条数据返回??前台不需要
            return response()->json(1);
        }
        //响应
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
        //表单验证
        $this->validate($request, [
//            'title' => 'required|unique:posts|max:255',
            'name' => 'required|unique:categories,name,'.$id
        ],[
            'name.required' => '请填写分类名！',
            'name.unique' => '该分类名已经被使用！'
        ]);
        //入库操作
        $category = $this->category->find($id);
        $category->name = $request->get('name');
        $res = $category->save();
        return response()->json($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->category->find($id);
        $res = $category->delete($id);
        return response()->json($res);  //true

    }
}
