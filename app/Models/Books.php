<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    //设置表名
    protected $table = 'books';

    //允许批量操作的字段
//    protected $fillable = ['pname', 'imgfile','isvip'];
    //不允许批量操作的字段
//    protected $guarded = [];
    public $timestamps = false;
}
