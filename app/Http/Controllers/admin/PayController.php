<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Household;
use App\Model\Rent;
use App\Model\Water;
use App\Model\Electric;
use App\Model\Property;
use DB;
class PayController extends Controller
{
    //收费管理
    function index(Request $req) {
        // 定义date
        $date = $req->date ? $req->date : date('Y-m');
  
        $db =  DB::table('households')
                    ->select('households.id','username','realname',
                    'rent.money as rent','rent.state as rent_state',
                    'water.money as water','water.state as water_state',
                    'property.money as prop','property.state as prop_state',
                    'electric.money as elec','electric.state as elec_state')
                    ->leftJoin('rent',function($join) use ($date) {
                        $join->on('households.id','=','rent.user_id')
                                ->where('rent.date','=',$date);
                    })->leftJoin('water',function($join) use ($date) {
                        $join->on('households.id','=','water.user_id')
                                ->where('water.date','=',$date);
                    })->leftJoin('property',function($join) use ($date) {
                        $join->on('households.id','=','property.user_id')
                                ->where('property.date','=',$date);
                    })->leftJoin('electric',function($join) use ($date) {
                        $join->on('households.id','=','electric.user_id')
                                ->where('electric.date','=',$date);
                    });
        if($req->keyword) {
            $db = $db->where(function($q) use($req){
                            $q->where('households.id','like',"%$req->keyword%")
                                ->orWhere('username','like',"%$req->keyword%")
                                ->orWhere('realname','like',"%$req->keyword%");
                        });
        } 
        $date = date('Y-m');
        // 分别从缴费表中查询记录，只要查询到一条，即本月还有没有缴费的用户，显示 未缴纳 按钮
        $pay = Rent::where([
            ['state','=','0'],
            ['date','=',$date],
        ])->first();
        if(!$pay) {
            $pay = Water::where([
                ['state','=','0'],
                ['date','=',$date],
            ])->first();
            if(!$pay){
                $pay = Electric::where([
                    ['state','=','0'],
                    ['date','=',$date],
                ])->first();
                if(!$pay) {
                    $pay = Property::where([
                        ['state','=','0'],
                        ['date','=',$date],
                    ])->first();
                }
            }
            
            
        }
       
        $t = date('t'); // 本月一共有几天
        $d = date('d'); // 当前是第几天
        if($pay && ($t - $d) < 7) {
            $warning = 0;
        } else {
            $warning = 1;
        }
        
        // 排除用户名注销的住户
        $data = $db->where('address','!=','')
                   ->orderBy('households.id','desc')->paginate(15);
        
        return view('admin.household.pay',[
            'data' => $data,
            'req' => $req,
            'date' => $date,
            'max_date' => date('Y-m'),
            'warning' => $warning
        ]);
    }

    function add(Request $req) {
        $req->validate([
            'id' => 'required',
            'price' => 'required',
            'type' => 'required'
        ],[
            'id.required' => '未知用户，请重新操作',
            'price.required' => '金额不能为空',
            'type.required' => '缴费类型不能为空'
        ]);
        $date = date("Y-m");
        // 先查询数据库，来判断是否重复添加了
        $costs = DB::table($req->type)
                    ->where('user_id','=',$req->id)
                    ->where('date','=',$date)
                    ->first();
        // 判断记录是否已经存在
        if(!$costs) {
            DB::table($req->type)->insert([
                'user_id' => $req->id,
                'money' => $req->price,
                'date' => date('Y-m')
            ]);
        }
       
        return back();
    }
    function edit(Request $req) {
        $req->validate([
            'id' => 'required',
            'price' => 'required',
            'type' => 'required'
        ],[
            'id.required' => '未知用户，请重新操作',
            'price.required' => '金额不能为空',
            'type.required' => '缴费类型不能为空'
        ]);
        // 更改数据
        DB::table($req->type)
        ->where('user_id','=',$req->id)
        ->where('date','=',date('Y-m'))
        ->update(['money'=>$req->price]);
        return back();
    }
    // 删除
    public function delete(Request $req) {
        DB::table($req->table)->where('id', $req->id)->delete();
        return back();
    }
    function fixed(Request $req){
        // 先根据类型和id查找数据
        $model = DB::table($req->type)
        ->where('user_id','=',$req->id)
        ->where('date','=',date('Y-m'));
        $data = $model->get();
        // 判断是否已经缴费
        if($data[0]->state == '0') {
            
            $model->update(['cost'=>$data[0]->money,'state'=>'1']);
        }
        return back();
    }
    public function info(Request $request, $uid)
    {
        // return $uid;
        // 获取该用户的所有历史记录  
        /**
         * 一个一个表查吧，通过下拉框选择缴费项
         */
        $key = $request->keyword ? $request->keyword : 'rent';
   
        $user = DB::table('households')
                ->select('id','username','realname')
                ->where('id', $uid)
                ->first();
        $data = DB::table($key)
                ->where('user_id', $uid)
                ->orderBy('date', 'desc')
                ->get();
        return view('admin.household.info',[
            'data' => $data,
            'key' => $key,
            'user'=>$user,
        ]);
    }
    public function details(Request $req)
    {
        $date = $req->date ? $req->date : date('Y-m');
        $table = $req->table ? $req->table : 'rent';
  
        $db =  DB::table('households')
                    ->select('households.id','username','realname',$table.'.money',
                        $table.'.state',$table.'.date',$table.'.cost')
                    ->leftJoin($table ,function($join) use ($date) {
                        $join->on('households.id','=','user_id')
                                ->where('date','=',$date);
                    });
        // 排除用户名注销的住户
        $data = $db->where('address','!=','')
                ->where('state', 1)
                ->orderBy('households.id','desc')->get();
        return view('admin.household.details',[
            'data' => $data,
            'date' => $date,
            'table'=> $table
        ]);
    }

    // 预警
    function warning(Request $req) {
        // 定义date
        $date = $req->date ? $req->date : date('Y-m');
  
        $data =  DB::table('households')
                    ->select('households.id','username','realname',
                    'rent.money as rent','rent.state as rent_state',
                    'water.money as water','water.state as water_state',
                    'property.money as prop','property.state as prop_state',
                    'electric.money as elec','electric.state as elec_state')
                    ->leftJoin('rent',function($join) use ($date) {
                        $join->on('households.id','=','rent.user_id')
                                ->where('rent.date','=',$date);

                    })->leftJoin('water',function($join) use ($date) {
                        $join->on('households.id','=','water.user_id')
                                ->where('water.date','=',$date);

                    })->leftJoin('property',function($join) use ($date) {
                        $join->on('households.id','=','property.user_id')
                                ->where('property.date','=',$date);

                    })->leftJoin('electric',function($join) use ($date) {
                        $join->on('households.id','=','electric.user_id')
                                ->where('electric.date','=',$date);

                    })
                    ->where('address','!=','') // 排除用户名注销的住户
                    ->where(function ($query) {       
                        $query->where('rent.state','=', 0)
                              ->orWhere('water.state','=', 0)
                              ->orWhere('property.state','=', 0)
                              ->orWhere('electric.state','=', 0);
                    })
                    ->orderBy('households.id','desc')
                    ->paginate(15);
                    // ->get();
 
    
        return view('admin.payment.warning',[
            'data' => $data,
            'req' => $req,
            'date' => $date,
            'max_date' => date('Y-m'),
        ]);
    }
}
