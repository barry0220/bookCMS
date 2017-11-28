<?php

namespace App\Http\Controllers\Admin;

use App\Models\Books;
use App\Models\Contents;
use App\Models\Types;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
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
        //获取所有符合条件的书籍
        $books = \DB::table('books')
            ->leftJoin('types','books.tid','=','types.id')
            ->select('books.*','types.tname')
            ->where('books.bookname','like','%'.$searchname.'%')
            ->paginate(6);

        //返回图书列表页面
        return view('Admin.books.list',compact('books','searchname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $t = new Types();
        $types = $t->tree();
        //显示添加页面
        return view('Admin.books.add',compact('types'));
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
            'bookname'=>'required',
            'author'=>'required',
            'score'=>'required',
            'intro'=>'required',
            'remark'=>'required'
        ];
        $msg = [
            'bookname.required'=>'书名必须输入',
            'author.required'=>'作者必须输入',
            'score.required'=>'评分必须输入',
            'intro.required'=>'简介必须输入',
            'remark.required'=>'评语必须输入'
        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/books/create')
                ->withErrors($validator)
                ->withInput();
        }

        //验证当前选择分类是否存在子类
        $pid = $input['pid'];
        $res = Types::where('pid',$pid)->first();

//        dd($res);

        if ($res) {
            return back()->with('errors','当前所选图书分类不是详细分类');
        }

        $books = new Books();
        $books -> bookname = $input['bookname'];
        $books -> score = $input['score'];
        $books -> author = $input['author'];
        $books -> intro = $input['intro'];
        $books -> remark = $input['remark'];
        $books-> tid = $pid;

        $res = $books -> save();

        if ($res) {
            return redirect('admin/books');
        } else {
            return back()->with('errors','添加图书失败');
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
        //显示图书内容页面 章节内容等
        $book = \DB::table('books')
            ->leftJoin('types','books.tid','=','types.id')
            ->select('books.*','types.tname')
            ->where('books.id',$id)
            ->first();

        $t = new Types();
        $types = $t->tree();
        $contents = Contents::where('bookid',$id)->get();

        return view('Admin.books.section',compact('contents','book','types'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $t = new Types();
        $types = $t -> tree();
        $book = Books::find($id);
        //显示界面
        return view('Admin.books.edit',compact('book','types'));
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
            'bookname'=>'required',
            'author'=>'required',
            'score'=>'required',
            'intro'=>'required',
            'remark'=>'required'
        ];
        $msg = [
            'bookname.required'=>'书名必须输入',
            'author.required'=>'作者必须输入',
            'score.required'=>'评分必须输入',
            'intro.required'=>'简介必须输入',
            'remark.required'=>'评语必须输入'
        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect("admin/types/{$id}/edit")->withErrors($validator)->withInput();
        }

        //验证当前选择分类是否存在子类
        $pid = $input['pid'];
        $res = Types::where('pid',$pid)->first();

        if ($res) {
            return back()->with('errors','当前所选图书分类不是详细分类');
        }

        $books = Books::find($id);
        $books -> bookname = $input['bookname'];
        $books -> score = $input['score'];
        $books -> author = $input['author'];
        $books -> intro = $input['intro'];
        $books -> remark = $input['remark'];
        $books-> tid = $pid;

        $res = $books -> save();

        if ($res) {
            return redirect('admin/books');
        } else {
            return back()->with('errors','修改图书失败');
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
        $book = Books::find($id);
        //执行删除操作
        $res = $book->delete();
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
