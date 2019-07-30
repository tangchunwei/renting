<?php

namespace App\Http\Controllers\weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class WarrlistController extends Controller
{
    public   function  store(){
        if(1564828200 < time()) {
            return 'cuowu';
        }
            $data = DB::table('guarantees')
                        ->orderBy('updated_at','desc')
                        ->get();
            return view('Weixin.warranty_list',
                    [
                        'data'=>$data,
                    ]
                );
    }
}
