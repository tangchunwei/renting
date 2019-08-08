<?php

namespace App\Http\Controllers\weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BindPhoneController extends Controller
{
        public  function index(){
            
            if(date("Y-m-d H:i:s") > "2019-08-10 18:00:00") {
                return redirect()->route('weixin_login');
            }
            return  view('Weixin.bindphone');
        }
}
