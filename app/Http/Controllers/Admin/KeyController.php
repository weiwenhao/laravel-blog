<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\KeyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KeyController extends Controller
{
    protected $key;

    /**
     * KeyController constructor.
     * @param $key
     */
    public function __construct(KeyRepository $key)
    {
        $this->key = $key;
    }

    /**
     * 获得关键字列表,返回json数据
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxIndex()
    {
        $keys = $this->key->getKeyList();
        return response()->json($keys);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keys = $this->key->all();
        return view('admin.key.list',compact('keys'));
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
        //表单验证
        $this->validate($request, [
//            'title' => 'required|unique:posts|max:255',
            'name' => 'required|unique:keys,name,'.$id
        ],[
            'name.required' => '请填写关键字！',
            'name.unique' => '该关键字已经被使用！'
        ]);
        //入库操作
        $key = $this->key->find($id);
        $key->name = $request->get('name');
        $res = $key->save();
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
        //
    }
}
