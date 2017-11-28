<?php

namespace App\Http\Controllers\Admin;

use App\Models\Books;
use App\Models\Contents;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BooksManController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //返回图书管理页面
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
        $info = Contents::find($id);
        //显示查看章节内容界面
        return view('Admin.booksman.show',compact('info'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //引入编辑页面
        $info = Contents::find($id);
        //显示查看章节内容界面
        return view('Admin.booksman.edit',compact('info'));
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
            'sname'=>'required',
            'scontent'=>'required',
        ];
        $msg = [
            'sname.required'=>'章节名必须输入',
            'scontent.required'=>'章节内容必须输入',
        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect("admin/booksman/{$id}/edit")->withErrors($validator)->withInput();
        }


        $section = Contents::find($id);
        $section -> sectionname = $input['sname'];
        $section -> sectioncontent = $input['scontent'];

        $res = $section -> save();

        if ($res) {
            return redirect('admin/booksman'.'/'.$id);
        } else {
            return back()->with('errors','修改章节内容失败');
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
        //
        $res = true;
        if($res){
            $data=[
                'status'=>0,
                'msg'=>'删除成功aaaa'
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
