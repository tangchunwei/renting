<?php

namespace App\Http\Controllers\weixin;
//use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Guarantees;
class WarrantyController extends Controller
{
    public  function  index(){
        return view('Weixin.warranty_claim');
    }

    //接受报修图片保存数据库
    public  function  getImages(Request $req){
        if(1564828200 < time()) {
            return 'cuowu';
        }
        //判断文件夹是否存在
        if(is_dir('uploads/'.date("Y-m-d"))){
            //保存用户上传的图片
            $filename = time() . '_' . str_random(10) . '.png';
            $path=$req->fileVal->move('uploads/'.date("Y-m-d"), $filename);
            //Log::info($path);
            //保存路径$path到数据库
            // $path=config('app.url')  .'/'  . $path;
            $path=str_replace('\\','/',$path);
        }else{
            //保存用户上传的图片
            mkdir('uploads/'.date("Y-m-d"), 0777,true);
            $filename = time() . '_' . str_random(10) . '.png';
            $path=$req->fileVal->move('uploads/'.date("Y-m-d"), $filename);
            // $path=config('app.url')  .'/'  . $path;
            $path=str_replace('\\','/',$path);
            //Log::info($path);
        }
        session([
            'path' => $path,
        ]);
        return [
            'path' => $path,
        ];
    }
    //接收用户报修单
    public  function  getMessage(Request $req){
        //获取表单提交的数据
            $data=$req->all();
            //实例化模型
            $guarantees=new Guarantees;
            //设置模型属性
            $guarantees->id=null;
            $guarantees->flow_number=date("Ymd").time();
            $guarantees->username=session('username');
            $guarantees->realname=session('realname');
            $guarantees->device_name=$data['active'];
            $guarantees->img=session('path');
            $guarantees->address=session('address');
            $guarantees->describe=$data['describe'];
            $guarantees->state="审核中";
            $ret=$guarantees->save();
            $req->session()->forget('path');
            return "200";
    }
    public  function  failed(){
        return view('Weixin.baoxiufailed');
    }
}
