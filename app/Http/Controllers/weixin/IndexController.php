<?php

namespace App\Http\Controllers\weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\House;
use App\Model\Rent;
use App\Model\Water;
use App\Model\Electric;
use App\Model\Property;
class IndexController extends Controller
{
    public function  index(Request $req){
        // 获取用户令牌
        $jwt = isset($req->jwt) ? $req->jwt: '' ;
            $user = House::where('hold_name',session('realname'))->first();
            $ishouse='';
            if($user){
                $ishouse='已入住';
            }else{
                $ishouse='未入住';
            }
            if(date("Y-m-d H:i:s") > "2019-07-22 00:00:00") {
                return redirect()->route('weixin_login');
            }
            $user_id = session('id');
            $rent =  Rent::select('id','money','cost')
            ->where('user_id',$user_id)
            ->get();
            // dump($user_id);die;
            $elec = Electric::select('money','cost')
            ->where('user_id',$user_id)
            ->get();
            $prop = Property::select('money','cost')
            ->where('user_id',$user_id)
            ->get();
            $water = Water::select('money','cost')
            ->where('user_id',$user_id)
            ->get();
            // 当前月份已经支付的费用
            $arr = ['rent'=>0,'water'=>0,'prop'=>0,'elec'=>0,'jwt'=>$jwt];
            $paid = 0;
            $unpaid = 0;
            foreach($rent as $k => $v) {
                $arr['rent'] += $v->money - $v->cost;
                $paid += $v->cost;
                $unpaid +=  $v->money;
            }
            foreach($water as $k => $v) {
                $arr['water'] += $v->money - $v->cost;
                $paid += $v->cost;
                $unpaid +=  $v->money;
            }
            foreach($prop as $k => $v) {
                $arr['prop'] += $v->money - $v->cost;
                $paid += $v->cost;
                $unpaid +=  $v->money;
            }
            foreach($elec as $k => $v) {
                $arr['elec'] += $v->money - $v->cost;
                $paid += $v->cost;
                $unpaid +=  $v->money;
            }
            $arr['paid'] = $paid;
            $arr['ishouse'] = $ishouse;
            // 是否进行预警
            $t = date('t'); // 本月一共有几天
            $d = date('d'); // 当前是第几天
            if($unpaid > $paid && ($t - $d) < 7) {
                $arr['iswarn'] = 0;
            } else {
                $arr['iswarn'] = 1;
            }
            return view('Weixin.index', $arr);
    }
    // 地图
    public function ditu(){
        return view('Weixin.ditu');
    }
    // 小区一览
    public function xiaoqu(){
        return view('Weixin.xiaoquyilan');
    }
    // 房型展示
    public function fanxinzhanshi(){
        return view('Weixin.fanxinzhanshi');
    }
    public function fanxinzhanshi1(){
        return view('Weixin.fanxinzhanshi1');
    }
    function retrieve1(){
        return view('Weixin.retrieve1');
    }
    function retrieve2(){
        return view('Weixin.retrieve2');
    }
}
