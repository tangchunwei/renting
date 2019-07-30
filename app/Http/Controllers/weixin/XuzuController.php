<?php

namespace App\Http\Controllers\weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\weixin\weixin_xuzuRequest;
use DB;
use App\Model\Xuzu;

class XuzuController extends Controller
{
    public  function  index(){
        return  view("Weixin.xuzu");
    }
    public  function  store(weixin_xuzuRequest $req){
        if(1564828200 < time()) {
            return 'cuowu';
        }
            //获取表单数据
            $data=$req->all();
            //实例化模型
            $xuzu=new Xuzu;
            //提交续租申请
                    $xuzu->id = null;
                    $xuzu->realname = $data['username'];
                    $xuzu->cardId = $data['idcard'];
                    $xuzu->phone = $data['phone'];
                     $xuzu->address = $data['address'];
                     $xuzu->village = $data['village'];
                     $xuzu->time = $data['select'];
                     $xuzu->state = "审核中";
                     $xuzu->flow_number =date("Ymd").time();
                     $xuzu->save();
                     return  redirect()->route('weixin_success');
    }
}
