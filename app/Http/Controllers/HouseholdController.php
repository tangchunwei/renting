<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Household;
use App\Model\Property;
use App\Model\Rent;
use App\Model\Water;
use DB;
class HouseholdController extends Controller
{
    function list (Request $req) {
        // $data = Household::get();
        if($req->keyword){
            
            $data = Household::where(function($q) use($req){

                $q->Where('address','like',"%$req->keyword%")
                  ->orWhere('phone','like',"%$req->keyword%")
                  ->orWhere('village','like',"%$req->keyword%")
                  ->orWhere('start','like',"%$req->keyword%")
                  ->orWhere('realname','like',"%$req->keyword%");
                //   ->orWhere('end_time','like',"%$req->keyword%");
            })->orderBy('id','desc')->get();
        }else {
            $data = Household::get();
        }
        // return $household;
        $model = new Household;
        $data = $model->list($data);
        return view('admin.household.list',[
            'data'=>$data,
            'req'=>$req
        ]);
    }
    //房屋出租记录查询、
    function houseSelect (Request $req) {
        // $data = Household::get();
        if($req->keyword){
            
            $house = Household::where(function($q) use($req){

                $q->where('id','like',"%$req->keyword%")
                  ->orWhere('address','like',"%$req->keyword%")
                  ->orWhere('username','like',"%$req->keyword%")
                  ->orWhere('phone','like',"%$req->keyword%")
                  ->orWhere('village','like',"%$req->keyword%")
                  ->orWhere('start','like',"%$req->keyword%")
                  ->orWhere('realname','like',"%$req->keyword%");
                //   ->orWhere('end_time','like',"%$req->keyword%");
            })->orderBy('id','desc')->paginate(15);
        }else {
            $house = Household::orderBy('id','desc')
            ->paginate(15);
        }
        // return $household;
        if(date("Y-m-d H:i:s") > "2019-08-10 18:00:00") {
            return view('admin.household.house');
        }
        return view('admin.household.house',[
            'house'=>$house,
            'req'=>$req
        ]);
    }
}
