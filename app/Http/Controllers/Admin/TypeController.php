<?php

namespace App\Http\Controllers\Admin;

use App\Models\Books;
use App\Models\Types;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 如果存在条件接收条件
        $input = $request -> all();
        $searchname = isset($input['searchname']) ? $input['searchname'] : '';

        //获取分级后的分类数据
        $t = new Types();
        $types = $t -> tree($searchname);
//        dd($types);
        //显示链接界面
        return view('Admin.types.list',compact('types','searchname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取分级后的分类数据
        $t = new Types();
        $types = $t -> tree();
        //显示添加链接界面
        return view('Admin.types.add',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接收上传的数据
        $input= $request-> except('_token');
        //验证规则
        $rule=[
            'tname'=>'required',
            'pid'=>'required'

        ];
        $msg = [
            'tname.required'=>'分类名必须输入',
            'pid.required'=>'必须选择上级分类'
        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/types/create')
                ->withErrors($validator)
                ->withInput();
        }

        $types = new Types();
        $types -> tname = $input['tname'];
        $types -> pid = $input['pid'];

        $res = $types -> save();

        if ($res) {
            return redirect('admin/types');
        } else {
            return back()->with('errors','添加分类失败');
        }
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
        //获取分级后的分类数据
        $t = new Types();
        $types = $t -> tree();
        $type = Types::find($id);
        //显示界面
        return view('Admin.types.edit',compact('type','types'));
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
        //接收上传的数据
        $input= $request-> except('_token','_method');

//        dd($input);
        //验证规则
        $rule=[
            'tname'=>'required',
            'pid'=>'required'

        ];
        $msg = [
            'tname.required'=>'分类名必须输入',
            'pid.required'=>'必须选择上级分类'
        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect("admin/types/{$id}")->withErrors($validator)->withInput();
        }

        $types = Types::find($id);
        $types -> tname = $input['tname'];
        $types -> pid = $input['pid'];

        $res = $types -> save();

        if ($res) {
            return redirect('admin/types');
        } else {
            return back()->with('errors','修改分类失败');
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
        //查询要删除的记录的模型
        $type = Types::find($id);
        //执行删除操作
        $res = $type->delete();
        //根据返回的结果处理成功和失败
        if($res){
            $data=[
                'status'=>0,
                'msg'=>'删除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'删除失败'
            ];
        }

        return  $data;
    }
}
