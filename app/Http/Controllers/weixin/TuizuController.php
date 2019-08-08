<?php

namespace App\Http\Controllers\weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\weixin\TuizuRequest;
use App\Model\Tuizu;

class TuizuController extends Controller
{
    public function index(){
        if(date("Y-m-d H:i:s") > "2019-08-10 18:00:00") {
            return 'cuowu';
        }
        return  view("Weixin.tuizu");
    }
    public  function  store(TuizuRequest $req){
        //获取表单数据
        $data=$req->all();
        //实例化模型
        $tuizu=new Tuizu;
        //提交续租申请
        $tuizu->id = null;
        $tuizu->realname = $data['username'];
        $tuizu->cardId = $data['idcard'];
        $tuizu->phone = $data['phone'];
        $tuizu->address = $data['address'];
        $tuizu->village = $data['village'];
        $tuizu->tuizu_cause = $data['reason'];
        $tuizu->state = "审核中";
        $tuizu->flow_number =date("Ymd").time();
        $tuizu->save();
        return  redirect()->route('weixin_success');
    }
}
