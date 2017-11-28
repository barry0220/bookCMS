@extends("Layouts.admin")

@section("title","图书管理 | 章节编辑")

@section("content")

    <form method="post" id="art_form" action="{{ url('admin/booksman').'/'.$info->id   }}" class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-2 control-label">章节名称</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="sname" value="{{$info->sectionname}}">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">章节内容</label>
            <div class="col-sm-9">
                <textarea name="scontent" cols="180" rows="30">{{$info->sectioncontent}}</textarea>
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