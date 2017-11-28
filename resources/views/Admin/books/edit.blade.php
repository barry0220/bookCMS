@extends('Layouts.admin')

@section("title","图书管理 | 图书修改")

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
    <form method="post" id="art_form" action="{{ url('admin/books').'/'.$book['id']   }}" class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-2 control-label">图书分类</label>
            <div class="col-sm-3">
                <select class="form-control m-b" name="pid" id="type">
                    @foreach($types as $k => $v)
                        <option value="{{$v->id}}" {{$v->pid == 0 ? 'disabled' : ''}} {{$v->id == $book['tid'] ? 'selected' : ''}}>
                            {{$v->tname}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-sm-2 control-label">图书名称</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="bookname" value="{{$book['bookname']}}">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">作者</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="author" value="{{$book['author']}}">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">评分</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="score" value="{{$book['score']}}">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">简介</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="intro" value="{{$book['intro']}}">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">评语</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="remark" value="{{$book['remark']}}">
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="col-sm-4 col-sm-offset-2">
            <a href="javascript:history.back();" class="btn btn-white" >取消</a>
            <button class="btn btn-primary" type="submit">保存</button>
        </div>
        {{csrf_field()}}
        {{method_field('put')}}
    </form>
@endsection