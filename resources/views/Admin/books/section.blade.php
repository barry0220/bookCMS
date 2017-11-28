@extends("Layouts.admin")

@section("title","图书管理 | 图书列表")

@section("content")

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div id="editable_wrapper" class="dataTables_wrapper form-inline">
                <div class="row">
                    <div class="col-sm-3">
                        <a href="{{url('admin/books')}}">图书管理</a> >
                        <a href="{{url('admin/books')}}">{{$book->tname}}</a> >
                        <a href="{{url('admin/books')}}">{{$book->bookname}}</a>
                    </div>
                    <div class="col-sm-3">
                        <a href="{{url('admin/books')}}" class="btn btn-info btn-sm" style="font-size:14px;">图书列表</a>
                    </div>

                </div>
                <style>
                    #editable  tr > td {
                        vertical-align: middle;
                    }
                </style>
                <table class="table table-striped table-bordered table-hover  dataTable"
                       id="editable" role="grid" aria-describedby="editable_info">
                    <thead>
                    <tr>
                        <th colspan="2"><h1 style="padding-left: 100px">{{$book->bookname}}</h1></th>
                    </tr>
                    <tr role="row">
                        <th class="sorting_asc"  style="width: 80px;">章节</th>
                        <th class="sorting_asc"  style="width: 175px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contents as $k => $v)
                        <tr class="gradeA odd" role="row">
                            <td>
                                <a href="/admin/booksman/{{$v->id}}">
                                    {{$v->sectionname}}
                                </a>
                            </td>
                            <td class="center">
                                <a href="/admin/booksman/{{$v->id}}" class="btn btn-info btn-sm">查看</a>
                                <a href="/admin/booksman/{{$v->id}}/edit" class="btn btn-success btn-sm">修改</a>
                                <a href="javascript:;" class="btn btn-danger btn-sm" onclick="delSection('{{$v->id}}')">删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--<div class="row">--}}
                    {{--<div class="col-sm-4">--}}

                    {{--</div>--}}
                    {{--<div class="col-sm-6">--}}
                        {{--<div class="dataTables_paginate paging_simple_numbers" id="editable_paginate">--}}
                            {{--{!! $books->appends(['searchname'=>$searchname])->render() !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
    <script>
        function delSection(id){
            //询问框
            layer.confirm('确认删除这个链接吗？', {
                btn: ['确认','取消']
            }, function(){
//                通过ajax 向服务器发送一个删除请求
                $.post("{{url('admin/booksman/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){

                    if(data.status == 0){
                        layer.msg(data.msg, {icon: 6});
                        setTimeout(function(){
                            location.href = location.href;
                        },3000)
                    }else{
                        layer.msg(data.msg, {icon: 5});
                    }
                })
            });
        }

    </script>

@endsection