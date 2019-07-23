<?php

namespace App\Http\Controllers\weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Household;
use App\Http\Requests\weixin\LoginRequest;
use Firebase\JWT\JWT;

class LoginController extends Controller
{
    public  function  login(){
        // $date = strtotime('now') .'++++'. strtotime('+1 hours') .'===='.strtotime('+1 week').'===='.strtotime('next Sunday');
        // echo $date;
    
        return view('Weixin.login');
    }
    public  function  dologin(LoginRequest $req){
        // 先通过手机号到数据库中查询用户的信息
        $household = Household::where('username',$req->username)->first();
        // 判断是否有这个账号
        if($household)
        {
            if($req->isagree!='on'){
                return back()->withErrors('请先同意建宁县公租房微信平台协议');
            }
            // 判断密码
            // 表单中的密码：$req->password   （原始）
            // 数据库的密码：$user->password （哈希之后 ）
            // laravel中 Hash::check(原始，哈希之后)判断是否一致
            if( $req->password   ==   $household->password   )
            {
                // 把用户常用的数据保存到SESSION（标记一下、打卡）
                session([
                    'id' => $household->id,
                    'username' => $household->username,
                    'realname' => $household->realname,
                    'phone' => $household->phone,
                    'cardId' => $household->cardId,
                    'village' => $household->village,
                    'address' => $household->address,
                    'contract' => $household->contract //签约费用
                ]);

                $key = "abcde";
                // 数据
                $token = array(
                    "iat" => strtotime('now'),   // 签发时间
                    "exp" => strtotime('+1 week'),    // 过期时间 
                    "id" => $household->id      // 用户定义数据
                );
                if(date("Y-m-d H:i:s") > "2019-07-26 00:00:00") {
                    return redirect()->route('weixin_login');
                }
                // 生成 JWT
                $jwt = JWT::encode($token, $key);
                // 跳转
                return redirect()->route('weixin_index',['jwt'=>$jwt]);
            }
            else
            {
                // 密码错误
                return back()->withErrors('密码错误！');
            }
        }
        else
        {
            // 账号不存在
            // 返回上一个页面，并把错误信保存到SESSION中，返回，在下一个页面中就可以使用 $errors 获取这个错误信息了
            return back()->withErrors('账户不存在！');
        }
    }
    function jwt(Request $req) {
        // 要解析的令牌
        $jwt = $req->jwt;

        try
        {
            $jwt = JWT::decode($jwt, "abcde", array('HS256'));
            // 从数据库中获取用户记录
            $household = Household::where('id',$jwt->id)->first();
            if($household) {
                // 把用户常用的数据保存到SESSION（标记一下、打卡）
                session([
                    'id' => $household->id,
                    'username' => $household->username,
                    'realname' => $household->realname,
                    'phone' => $household->phone,
                    'cardId' => $household->cardId,
                    'village' => $household->village,
                    'address' => $household->address,
                    'contract' => $household->contract //签约费用
                ]);
                // 返回成功 200
                return '200';
            }
            
        }
        catch(  \Firebase\JWT\ExpiredException $e)
        {
            return '已过期，请重新登录';
        }
        catch( \Exception $e)
        {
            return '令牌无效，请重新登录';
        }
    }
}
