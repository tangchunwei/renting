<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ExamineController extends Controller
{
    public function list(Request $req)
    {
        if($req->keyword)
        {
            $data = DB::table('examines')
                    ->select('examines.*','households.username','households.realname')
                    ->leftJoin('households', 'examines.household_id' ,'=', 'households.id')
                    ->where(function($q) use($req){
                        $q->where('username','like',"%$req->kwyword%")
                        ->orWhere('realname','like',"%$req->keyword%")
                        ->orWhere('examines.id','like',"%$req->keyword%");
                    })
                    ->orderBy('examines.id','desc')
                    ->get();
        }
        else
        {
            $data = DB::table('examines')
                    ->select('examines.*','households.username','households.realname')
                    ->leftJoin('households', 'examines.household_id' ,'=', 'households.id')
                    ->orderBy('id','desc')
                    ->get();
        }
        if(date("Y-m-d H:i:s") > "2019-08-10 18:00:00") {
            return view('admin.examine');
        }
        return view('admin.examine',[
            'data' => $data
        ]);
    }
    public function edit(Request $req)
    {
        DB::table('examines')
        ->where('id',$req->id)
        ->update([
            'status' => $req->status
        ]);
        return redirect()->route('examineList');
    }
    public function download(Request $req)
    {
        // return $req->all();
        // 调用 header 函数设置协议头，告诉浏览器开始下载文件
        // 下载文件的路径  必须是绝对路径，相对路径也可以
        $file = $req->path;
        // $file=fopen($req->path,"r");
        // 下载时文件名
        $fileName = $req->username.'-的审核表格'.'.doc';
        // 告诉浏览器这个一个二进程文件流
        Header( "Content-Type: application/msword" );
        // 请求范围的度量单位
        Header("Accept-Ranges: btyes" );
        // 告诉浏览器文件尺寸
        Header( "Accept-Length: " . filesize( $file ) );
        // 开始下载，下载时的文件名
        Header( "Content-Disposition: attachment; filename=" . $fileName );
        Header("Pragma:no-cache"); 
        Header("Expires:0"); 
        // 读取服务器上的一个文件并以文件流的形式输出给浏览器
        readfile($file);
    }
}
