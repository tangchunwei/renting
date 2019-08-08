<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Agreement;
class AgreementController extends Controller
{
    public function see(Request $req)
    {

        if($req->keyword){
            
            $data = Agreement::where('title','like',"%$req->keyword%")->get();
        }else {
            $data = Agreement::get();
        }
        if(date("Y-m-d H:i:s") > "2019-08-10 18:00:00") {
            return view('admin.agreement.see');
        }
        return view('admin.agreement.see',[
            'data'=>$data
        ]);
    }
    public function add()
    {
        return view('admin.agreement.add');
    }
    public function store(Request $req)
    {
        Agreement::create($req->all());
        return redirect()->route('agreement_see');
    }
    public function edit($id)
    {
        $data = Agreement::find($id);
        return view('admin.agreement.edit',[
            'data' => $data,
        ]);
    } 
    public function doEdit(Request $req)
    {
        Agreement::where('id',$req->id)
        ->update([
            'title'=>$req->title,
            'description'=>$req->description
        ]);
        return redirect()->route('agreement_see');
    }  
}
