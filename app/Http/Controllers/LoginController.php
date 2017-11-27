<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function getAdd($name)
    {
    	// return "这里是getAdd方法,姓名是".$name;
    	return route('ad');
    }

    public function getDoAdd($a,$b,$c,$d)
    {
    	echo "这里是getDoAdd方法";
    	echo "<pre>";
    	echo $a."++++++".$b."++++++".$c."++++++".$d;
    	
    }
}
