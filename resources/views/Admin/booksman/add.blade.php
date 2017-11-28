@extends('Layouts.admin')

@section("title","图书管理 | 图书添加")

@section("content")
    <style>
        .form-horizontal{
            margin-top:50px;
        }
    </style>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @if(is_object($errors))
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                @else
                    <li>{{ session('errors') }}</li>
                @endif
            </ul>
        </div>
    @endif
    <form method="post" id="art_form" action="{{ url('admin/books')  }}" class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-2 control-label">图书名称</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="bookname" >
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">作者</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="author" >
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">评分</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="score" >
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">简介</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="intro" >
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">评语</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="remark" >
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="col-sm-4 col-sm-offset-2">
            <a href="javascript:history.back();" class="btn btn-white" >取消</a>
            <button class="btn btn-primary" type="submit">保存</button>
        </div>
        {{csrf_field()}}
    </form>
@endsection