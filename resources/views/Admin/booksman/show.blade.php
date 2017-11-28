@extends("Layouts.admin")

@section("title","图书管理 | 章节内容浏览")

@section("content")

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div id="editable_wrapper" class="dataTables_wrapper form-inline">
                <div class="row">
                    <div class="col-sm-12">
                        <a href="/admin/booksman/{{$info->id}}/edit" class="btn btn-info btn-sm">编辑内容</a>
                        <a href="/admin/books/{{$info->bookid}}" class="btn btn-info btn-sm">章节目录</a>
                    </div>
                </div>
                <div class="row" style="text-align: center;">
                    <div class="col-sm-12">
                        <h1>{{$info->sectionname}}</h1>
                    </div>
                </div>
                <style>
                    #editable  tr > td {
                        vertical-align: middle;
                    }
                </style>
                <div>
                    <p>{{$info->sectioncontent}}</p>
                </div>
            </div>
        </div>
    </div>

@endsection