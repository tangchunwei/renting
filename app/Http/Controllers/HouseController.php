<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\House;
use App\Model\Village;
use App\Model\Household;
use DB;
class HouseController extends Controller
{
    // 房屋出租状态
    public function house(Request $req){

        if($req->keyword){
            
            $house = House::where(function($q) use($req){

                $q->where('house_id','like',"%$req->keyword%")
                  ->orWhere('state','like',"%$req->keyword%")
                  ->orWhere('hold_name','like',"%$req->keyword%")
                  ->orWhere('hold_phone','like',"%$req->keyword%")
                  ->orWhere('residual_lease','like',"%$req->keyword%")
                  ->orWhere('start_time','like',"%$req->keyword%")
                  ->orWhere('village','like',"%$req->keyword%")
                  ->orWhere('end_time','like',"%$req->keyword%");
            })->orderBy('state','asc')->orderBy('id','desc')->get();
        }else {
            $house = House::orderBy('state','asc')->orderBy('id','desc')->get();
        }
        $vills = Village::select('name')->get();
        
        return view('admin.house.house',[
            'house'=>$house,
            'req'=>$req,
            'vills'=>$vills
        ]);
    }

    // 新增房屋
    public function add_house(){

        $village = Village::get();

        return view('admin.house.create',['village'=>$village]);
    }

    // 执行新增
    public function doAdd_house(Request $req){
        
        if($req->house_id=='' || $req->village=='' || $req->house_area=='' || $req->rent==''){
            return back()->withInput()->withErrors(['error'=>'输入数据不完整！']);
            
        }else {
            if(House::where('house_id',$req->house_id)->count()){
                return back()->withInput()->withErrors(['error'=>'房屋编号已存在，新增失败']);
            }else{
                $house = new House;
                $house->fill($req->all());

                $house->save();

                return redirect()->route('house');
            }
            
        } 
    } 
    public function edit($id)
    {
        $data = House::find($id);
        return view('admin.house.update',['data'=>$data]);
    }
    public function update(Request $req)
    {
        $model = House::find($req->id);
        $model->house_id = $req->house_id;
        $model->rent = $req->rent;
        $model->house_area = $req->house_area;
        $model->save();
        return redirect()->route('house');
    }
    // 删除房屋
    public function del_house($id){

        $house = House::find($id);
        $house->delete();

        $household = Household::where('address',$house->house_id)->first();
        if($household){
            $household->delete();
        }

        return back();
    }
    public function house_change(){
        $changes = DB::table('house_changes')
        ->select('house_changes.*','households.username')
        ->leftJoin('households','house_changes.household_id','=','households.id')
        ->get();
        // return $changes;
        return view('admin.house.house_change',[
            'changes' => $changes
        ]);
       
    }

    public function house_doChange(Request $req)
    {
        
        // return $req->to_examine;
        if($req->to_examine == '1')
        {
            // return $req->now;
             // 1. 根据now在house表中找到对应的房屋，获取数据$data，然后清空
            $data = House::where('house_id', $req->now)->first();
      
            // $arr = [
            //     'state' => '已出租',
            //     'hold_name' => $data->hold_name,
            //     'hold_phone' => $data->hold_phone,
            //     'start_time' => $data->start_time,
            //     'end_time' => $data->end_time, 
            // ];
            // 2. 根据want找到想变更的房屋，将$data 添加到表中，
            House::where('house_id',$req->want)
            ->update([
                'state' => '已出租',
                'hold_name' => $data->hold_name,
                'hold_phone' => $data->hold_phone,
                'start_time' => $data->start_time,
                'end_time' => $data->end_time, 
                'residual_lease' => $data->residual_lease,
            ]);
            // var_dump($arr);
            // die;
            // return $data;
            House::where('house_id',$req->now)
            ->update([
                'state' => '未出租',
                'hold_name' => '',
                'hold_phone' => '',
                'start_time' => '',
                'end_time' => '',
                'residual_lease' => '',
            ]);
            
            // 3. 将household对应的住户数据，改为对应want的数据
            Household::where('username',$req->username)
            ->update([
                'address' => $req->want,
            ]);
        
        }
        DB::table('house_changes')
        ->where('id',$req->id)
        ->update([
            'to_examine' => $req->to_examine
        ]);
       return redirect()->route('house_change');


    }

}