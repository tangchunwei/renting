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
            if(date("Y-m-d H:i:s") > "2019-07-05 00:00:00") {
                return redirect()->route('weixin_login');
            }
            $rent =  Rent::select('money','cost')
            ->where('user_id',session('id'))
            ->where('date', date('Y-m'))
            ->first();
            $elec = Electric::select('money','cost')
            ->where('user_id',session('id'))
            ->where('date', date('Y-m'))
            ->first();
            $prop = Property::select('money','cost')
            ->where('user_id',session('id'))
            ->where('date', date('Y-m'))
            ->first();
            $water = Water::select('money','cost')
            ->where('user_id',session('id'))
            ->where('date', date('Y-m'))
            ->first();
            // 当前月份已经支付的费用
            $arr = ['rent'=>0,'water'=>0,'prop'=>0,'elec'=>0,'jwt'=>$jwt];
            $paid = 0;
            if($rent) {
                $arr['rent'] = $rent->money - $rent->cost;
                $paid += $rent->cost;
            }
            if($water) {
                $arr['water'] = $water->money - $water->cost;
                $paid += $water->cost;
            }
            if($prop) {
                $arr['prop'] = $prop->money - $prop->cost;
                $paid += $prop->cost;
            }
            if($elec) {
                $arr['elec'] = $elec->money - $elec->cost;
                $paid += $elec->cost;
            }
            $arr['paid'] = $paid;
            $arr['ishouse'] = $ishouse;
            // return view('Weixin.index',[
            //     'ishouse'=>$ishouse,
            //     'rent' => isset($rent->money)?($rent->money - $rent->cost):'0.00',
            //     'elec' => isset($elec->money)?($elec->money - $elec->cost):'0.00',
            //     'prop' => isset($prop->money)?($prop->money - $prop->cost):'0.00',
            //     'water' => isset($water->money)?($water->money - $water->cost):'0.00',
            //     'jwt' => $jwt,
            //     'paid' => $paid
            // ]);
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
