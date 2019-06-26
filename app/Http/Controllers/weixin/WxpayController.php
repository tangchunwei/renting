<?php

namespace App\Http\Controllers\weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yansongda\Pay\Pay;
use App\Model\Order;
use App\Model\households;
use DB;
use Illuminate\Support\Facades\Log;

class WxpayController extends Controller
{
    protected $config = [
        'app_id' => 'wx4cbc0a5a5e78d748', // 公众号 APPID
        'mch_id' => '1511187271',
        'key' => '08839714a18fb0130a35ca9073810d2b',
        // 通知的地址
        'notify_url' => 'http://jngzf.cn/notify',
        // 'spbill_create_ip' => '',
            
    ];

    public function pay(Request $req)
    {
        $model = new Order;
        $orderInfo = $model->select('real_payment')->where('number', $req->state)->first();
        $code = $req->code;

        // 获取openid

        $data = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx4cbc0a5a5e78d748&secret=d60bdc7166ee84ec74a4407a4ea9e088&code=$code&grant_type=authorization_code");
        // $data = json_encode($data, true);
        $obj = json_decode($data, true);
        
        // 订单详情
        $databat = [
            'out_trade_no' => $req->state,
            'total_fee' => $orderInfo->real_payment*100, // **单位：分**
            'body' => '公租房相关费用缴纳',
            'openid' => $obj['openid'],
        ];

        

        try{
         $pay = Pay::wechat($this->config)->mp($databat);
        }
        catch(\Exception $e)
        {
            var_dump( $e->getMessage());
            exit;
        }
      
        return view('Weixin.wechat',[
            'data' => $pay,
        ]);
    }

    public function notify()
    {
        $pay = Pay::wechat($this->config);

        try{
            $data = $pay->verify(); // 是的，验签就这么简单！

            if($data->result_code == 'SUCCESS' && $data->return_code == 'SUCCESS')
            {
                // 获取订单信息
                // $ret1 = Order::where('number',$data->out_trade_no)->update(['state'=>'1']);

                // $orderInfo = Order::where('number',$data->out_trade_no)->get();
                $order =  Order::where('number',$data->out_trade_no)->first();
                // 如果订单的状态为未支付状态 ，说明是第一次收到消息，更新订单状态 
                if($order->state == 0)
                {
                    $payTable = DB::table($order->type)
                    ->where('user_id','=',$order->user_id)
                    ->where('date','=',date('Y-m'))
                    ->first();
                    // 从相应的缴费中的已支付，加上实际实付，再减去手续费
                    $cost = (float)$payTable->cost + ((float)$order->real_payment - (float)$order->service_charge);


                    Log::debug('$cost:' . $cost . '， ' . '$payTable->money:' . $payTable->money);



                    // 如果金额等于
                    if($cost == $payTable->money) {
                        // 开启事务
                        DB::beginTransaction();
                        // 设置订单为已支付状态
                        $ret1 = Order::where('number',$data->out_trade_no)->update(['state'=>'1']);
                        // 更新用户缴费状态，添加缴费金额
                        $ret2 = DB::table($order->type)
                        ->where('user_id','=',$order->user_id)
                        ->where('date','=',date('Y-m'))
                        ->update([
                            'state'=> 1,
                            'cost' => $cost
                        ]);
                        if($ret1 && $ret2)
                        {
                            // 提交事务
                            DB::commit();
                        }
                        else
                        {
                            // 回滚事务
                            DB::rollBack();
                        }
                    } else if($cost > $payTable->money) { 
                        // 如果cost 大于 money
                        // 开启事务
                        DB::beginTransaction();
                        // 设置订单为已支付状态
                        $ret1 = Order::where('number',$data->out_trade_no)->update(['state'=>'1']);

                        // 更新用户缴费状态，并将cost添加到最大值
                        $ret2 = DB::table($order->type)
                        ->where('user_id','=',$order->user_id)
                        ->where('date','=',date('Y-m'))
                        ->update([
                            'state'=> 1,
                            'cost' => $payTable->money
                        ]);
                        // 获取住户的余额
                        $household = DB::table('households')
                                        ->select('balance')
                                        ->where('id','=',$order->user_id)
                                        ->first();
                        $balance = $household->balance + ($cost - $payTable->money);
                        // 将多余的金额添加到住户的余额
                        $ret3 = DB::table('households')
                                ->where('id','=',$order->user_id)
                                ->update(['balance' => $balance]);
                        Log::debug($ret1 . '====' . $ret2 . '===='. $ret3);

                        if($ret1 && $ret2 && $ret3)
                        {
                            // 提交事务
                            DB::commit();
                        }
                        else
                        {
                            // 回滚事务
                            DB::rollBack();
                        }
                    } else if($cost < $payTable->money) {
                        // 金额小于需要缴纳的费用
    
                        // 开启事务
                        DB::beginTransaction();
                        // 设置订单为已支付状态
                        $ret1 = Order::where('number',$data->out_trade_no)->update(['state'=>'1']);

                        // 更新用户余额，因为小于，所以不用更新缴费状态
                        $ret2 = DB::table($order->type)
                        ->where('user_id','=',$order->user_id)
                        ->where('date','=',date('Y-m'))
                        ->update(['cost'=>$cost]);
                        if($ret1 && $ret2)
                        {
                            // 提交事务
                            DB::commit();
                        }
                        else
                        {
                            // 回滚事务
                            DB::rollBack();
                        }
                    }
                    
                }
            }
        } catch (Exception $e) {
            // $e->getMessage();
        }
        
        return $pay->success();// laravel 框架中请直接 `return $pay->success()`
    }
}
