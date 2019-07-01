<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Household;

class HouseController extends Controller
{
    public function show(Request $req)
    {
        $data = Household::select('households.*','houses.rent', 'houses.house_area')
                    ->join('houses', 'houses.house_id','=','households.address')
                    ->where('households.realname',$req->name)
                    ->first();
        // dump($data);
        return view('admin.show',[
            'data' => $data
        ]);
    }
}
