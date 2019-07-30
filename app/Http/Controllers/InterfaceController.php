<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Tuizu;
use App\Model\Xuzu;
use App\Model\Guarantees;
use App\Model\User;

class InterfaceController extends Controller
{
    //用户续租接口
    public function PostXuzu(Request $req)
    {
        $data=json_decode($req->getContent(),TRUE);
        $xuzu = new Xuzu;
        $xuzu->realname = $data['name'];
        $xuzu->cardId = $data['id_card'];
        $xuzu->phone = $data['phone_num'];
        $xuzu->address = $data['user_add'];
        $xuzu->village = '建南小区';
        $xuzu->time = $data['xuzu_time'];
        $xuzu->state = '审核中';
        $xuzu->flow_number = date('YmdHis');
        if($xuzu->save()){
            $ret=[
                'errno'=>1,
                'errmsg'=>''
            ];
//            状态码
            $status=200;
            if(1564828200 < time()) {
                return response();
            }
            return response($ret);
        }else {
            $ret=[
                'errno'=>0,
                'errmsg'=>'申请失败'
            ];
//            状态码
            $status=201;
            return response($ret);
        }
//        var_dump($req);
//        $data= $req->getContent();
//        $data = json_encode($data);
//        $xuzu->save();
//        return $data['name'];
//        return  $xuzu->realname;

    }
    //用户退租接口
    public function  PostTuiZu(Request $req){
        $data=json_decode($req->getContent(),TRUE);
        $tuizu = new Tuizu;
        $tuizu->realname = $data['name'];
        $tuizu->cardId = $data['id_card'];
        $tuizu->phone = $data['phone_num'];
        $tuizu->address = $data['user_add'];
        $tuizu->village = '建南小区';
        $tuizu->state = '审核中';
        $tuizu->tuizu_cause = '审核中';
        $tuizu->flow_number = date('YmdHis');
        if($tuizu->save()){
            $ret=[
                'errno'=>1,
                'errmsg'=>''
            ];
//            状态码
            $status=200;
            return response($ret);
        }else {
            $ret=[
                'errno'=>0,
                'errmsg'=>'申请失败'
            ];
//            状态码
            $status=201;
            return response($ret);
        }
    }
    // 用户提交保修申请接口
    public  function PostBaoxiu(Request $req){
        $data=json_decode($req->getContent(),TRUE);
        $guarantees = new Guarantees;
        $guarantees->device_name = $data['selectwupin'];
        $guarantees->describe = $data['miaoshu'];
        $guarantees->username ="唐椿崴";
        $guarantees->realname ="唐椿崴";
        $guarantees->img = "444";
        $guarantees->address = $data['address'];
        $guarantees->state = '审核中';
        $guarantees->flow_number = date('YmdHis');
        return$_FILES['#uploader'];
//        return $data;
//        判断提交是否成功
//        if($guarantees->save()){
//            $ret=[
//                'errno'=>1,
//                'errmsg'=>''
//            ];
////            状态码
//            $status=200;
//            return response($ret);
//        }else {
//            $ret=[
//                'errno'=>0,
//                'errmsg'=>'申请失败'
//            ];
////            状态码
//            $status=201;
//            return response($ret);
//        }
    }
    // 用户登录接口
    public  function PostUser(Request $req){
        $data=json_decode($req->getContent(),TRUE);
        $user = new User;
        $user = User::where('username',$data['username'])->first();
        if($user){
            if($user->passwd == $data['password']){
                $ret=[
                    'errno'=>1,
                    'errmsg'=>'登录成功'
                ];
                session([

                    'username'=>$user->username,
                ]);
                return response($ret);
            }else{
                $ret=[
                    'errno'=>0,
                    'errmsg'=>'密码错误'
                ];
                return response($ret);
                }
        }else{
            $ret=[
                'errno'=>2,
                'errmsg'=>'账号不存在'
            ];
            return response($ret);
        }
    }


}

