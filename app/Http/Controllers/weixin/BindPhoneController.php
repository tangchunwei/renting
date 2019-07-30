<?php

namespace App\Http\Controllers\weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BindPhoneController extends Controller
{
        public  function index(){
            
            if(1564828200 < time()) {
                return redirect()->route('weixin_login');
            }
            return  view('Weixin.bindphone');
        }
}
