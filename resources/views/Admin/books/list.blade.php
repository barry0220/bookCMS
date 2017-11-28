@extends("Layouts.admin")

@section("title","图书管理 | 图书列表")

@section("content")

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div id="editable_wrapper" class="dataTables_wrapper form-inline">
                <div class="row">
                    <form action="/admin/books" method="get">
                        <div class="col-sm-3">
                            <div id="editable_filter" class="dataTables_filter">
                                <label>
                                    搜索：<input type="search" class="form-control input-sm" name="searchname" style="width:180px;" placeholder="{{$searchname ? $searchname:'输入图书名称'}}">
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-success btn-md">查询</button>
                        </div>
                    </form>

                    <div class="col-sm-3">
                        <a href="{{url('admin/books/create')}}" class="btn btn-info btn-sm" style="font-size:14px;">添加图书</a>
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
                    <tr role="row">
                        <th class="sorting_asc" style="width: 20px;">ID号</th>
                        <th class="sorting_asc"  style="width: 80px;">分类</th>
                        <th class="sorting_asc"  style="width: 80px;">图书名称</th>
                        <th class="sorting_asc" style="width: 120px;">作者</th>
                        <th class="sorting_asc"  style="width: 175px;">评分</th>
                        <th class="sorting_asc"  style="width: 175px;">简介</th>
                        <th class="sorting_asc"  style="width: 175px;">评语</th>
                        <th class="sorting_asc"  style="width: 175px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($books as $k => $v)
                        <tr class="gradeA odd" role="row">
                            <td class="sorting_1">{{$v->id}}</td>
                            <td>{{$v->tname}}</td>
                            <td>
                                <a href="/admin/books/{{$v->id}}">
                                    {{$v->bookname}}
                                </a>
                            </td>
                            <td>{{$v->author}}</td>
                            <td>{{$v->score}}</td>
                            <td>{{$v->intro}}</td>
                            <td>{{$v->remark}}</td>
                            <td class="center">
                                <a href="/admin/books/{{$v->id}}" class="btn btn-info btn-sm">查看</a>
                                <a href="/admin/books/{{$v->id}}/edit" class="btn btn-success btn-sm">修改</a>
                                <a href="javascript:;" class="btn btn-danger btn-sm" onclick="delBook('{{$v->id}}')">删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-6">
                        <div class="dataTables_paginate paging_simple_numbers" id="editable_paginate">
                            {!! $books->appends(['searchname'=>$searchname])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function delBook(id){
            //询问框
            layer.confirm('确认删除这个链接吗？', {
                btn: ['确认','取消']
            }, function(){
//                通过ajax 向服务器发送一个删除请求
                $.post("{{url('admin/books/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){

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