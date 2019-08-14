<?php
namespace App\Http\Controllers\Port;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class PortController extends Controller{
    public function login(){
        //页面来源
        $referer = $_SERVER['HTTP_REFERER'];
        $data = [
            'referer'=>urlencode($referer)
        ];
        return view('login.login',$data);
    }
    //登录处理
    public function loginDo(Request $request){
        $name = $request->input('name');
        $pwd  = $request->input('pwd');
        $u = DB::table("reg")->where(['name'=>$name])->first();
//        var_dump($u);
        if($u){
            //验证登录
            if(password_verify($pwd,$u->pwd)){
                //登录成功   生成token
                $token = substr(md5($u->id.Str::random(8).mt_rand(11,999999)),10,10);
//                var_dump($token);
//                $uto = DB::table("reg")->where(['token'=>$token])->insert();
                $redis_user_token_key = 'u:token:'.$u->id.'';
                Redis::set($redis_user_token_key,$token);
                $respose = [
                    'error' => 0,
                    'msg' => '登录成功',
                    'data' =>[
                        'token'=> $token,
                        'id' => $u->id
                    ]
                ];
                return $respose;
            }
        }else{
            echo "1";
        }
    }
}