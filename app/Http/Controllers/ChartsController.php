<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Household;
use DB;
class ChartsController extends Controller
{
    public function main(){
        $date = 1;
        $end = date("Y-m-d");
        $m = 7;
        $time = strtotime($end) - 3600*24*30*$m;
        $start = date('Y-m-d',$time); 
 
        $data = DB::table('properties')
                    ->leftJoin('households','households.username','=','properties.username')
                    ->select('village',DB::raw('(water_rent+power_rate+rent+property_fee+other_expenses) as moneys'),'is_pay','data','address')
                    ->whereBetween('start',[$start,$end])
                    ->get();
  
        $villages = DB::table('villages')->select('id','name')->get();
        if(date("Y-m-d H:i:s") > "2019-08-10 18:00:00") {
            return view('core.charts');
        }
        return view('core.charts',[
            'data'=>$data,
            // 'pays'=>$pays,
            'villages'=>$villages
        ]);
    }
}
