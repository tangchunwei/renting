<?php

namespace App\Http\Controllers\weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Rent;
use App\Model\Water;
use App\Model\Electric;
use App\Model\Property;
use App\Model\Order;
use App\Model\Household;
use DB;
class OrderController extends Controller
{
    public function index()
    {
        $date = date('Y-m');
        $rent = Rent::where([
            ['user_id','=', session('id')],
            ['state','=','0'],
            ['date','=',$date],
        ])->first();
        $water = Water::where([
            ['user_id','=', session('id')],
            ['state','=','0'],
            ['date','=',$date],
        ])->first();
        $elec = Electric::where([
            ['user_id','=', session('id')],
            ['state','=','0'],
            ['date','=',$date],
        ])->first();
        $prop = Property::where([
            ['user_id','=', session('id')],
            ['state','=','0'],
            ['date','=',$date],
        ])->first();
        return view('Weixin.month',[
            'rent' => $rent,
            'water' => $water,
            'elec' => $elec,
            'prop' => $prop
        ]);
    }
    public function create(Request $req)
    {
        // $name = '';
        // if($req->type == 'rent')
        //     $name = '房租';
        // elseif($req->type == 'water')
        //     $name = '水费';
        // elseif($req->type == 'electric')
        // 获取缴费信息
        $data = DB::table($req->type)
            ->where([
                ['user_id',session('id')],
                ['date','=',date('Y-m')],
            ])
            ->first();
        // 获取手续费信息
        $poundage = DB::table('poundage')->where('status','1')->first();
        // 获取折扣
        $household = Household::where('id', session('id'))->select('discount')->first();

      
        $num = time();
        $total = (float)$data->money - (float)$data->cost - (float)$household->discount;
        if($poundage) {
            $total += (float)$poundage->sum;
        }
        return view('Weixin.order',[
            'data' =>$data,
            'num' => $num,
            'name' => $req->type,
            'poundage'=>$poundage,
            'total'=>$total,
            'discount' => $household->discount
        ]);

    }
    public function success()
    {
        return view('Weixin.wxsuccess');
    }


    public function ajaxOrder(Request $req)
    {
        // return $req->type;
        // 通过表名，查询当前月的是否支付成功
        // return DB::table($req->type)->where([
        //     ['user_id','=',session('id')],
        //     ['date','=',date('Y-m')],
        // ])->get();
   
        return Order::where('number',$req->num)->first();
    }  
    public function store(Request $req)
    {   
        $num = $req->number;
        $model = new Order;
        $model->number = $num;
        $model->user_id = session('id');
        $model->real_payment = $req->real_payment;  // 应该缴纳的费用 + 手续费
        $model->type = $req->type;
        $model->state = '0';
        $model->service_charge = $req->service_charge; // 手续费
        $model->discount = $req->discount;
        $model->save();

        // session('cip',$req->cip);
      
        return redirect("https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx4cbc0a5a5e78d748&redirect_uri=http://jngzf.cn/wxpay&response_type=code&scope=snsapi_base&state=$num#wechat_redirect");
    }
}
