<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    //设置表名
    protected $table = 'types';

    public $timestamps = false;

    //排序并给分类名称添加缩进
    public function tree($searchname=''){
        $types =  $this->where('tname','like','%'.$searchname.'%')->get();
//        return $types;
        if (!empty($searchname)){
            return $types;
        }
        return  $this->getTree($types,0);
    }
    //给分类名称添加缩进
    public function getTree($types,$pid = 0,$lev=1){
        static $arr = array();
        foreach($types as $k=>$v){
            //遍历分类
            if($v->pid == $pid){
                //给分类添加层级
                $types[$k]['lev'] = $lev;
                //修改分类名称便于分类显示
                $types[$k]['tname'] = str_repeat('　',($lev-1)*2).'--'.$types[$k]['tname'];
                $arr[] = $types[$k];

                //传入当前分类ID 查询子分类
                $this->getTree($types,$v->id,$lev+1);
            }
        }
        return $arr;
    }
}
