<?php
namespace App\Http\Controllers\Port;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
class LoginController extends Controller{
    public function reg(){
        return view('login.reg');
    }
    //注册执行
    public function regdo(Request $request){
        $data = $request->input();
        $appid = Str::random(5);
        $appsecret = Str::random(10);
        $data['appid'] = $appid;
        $data['appsecret'] = $appsecret;
        $pwd = password_hash($data['pwd'], PASSWORD_BCRYPT);
        $data['pwd'] = $pwd;
        $res = DB::table('user')->insert($data);
        if ($res) {
            echo 1;
        } else {
            echo 2;
        }
    }
    public function file(Request $request){
        $file1 = $request->file('img1');
        $file2 = $request->file('img2');
        $save_path = date('Ymd');               //存放图片的文件夹
        $file_name = time() . mt_rand(1, 999);              //图片名字
        $ext1 = $file1->getClientOriginalExtension();   //图片的后缀名
        $ext2 = $file2->getClientOriginalExtension();
        $f_name1 = $file_name . '.' . $ext1; //拼接图片名称
        $f_name2 = $file_name . '.' . $ext2;
        $file1->storeAs($save_path, $f_name1, $f_name2);
    }
    public function login(){
        return view('login.login');
    }
//    public function logindo(Request $request){
//        $name = $request->input('name');
//        $pwd = $request->input('pwd');
//        $u = DB::table("user")->where(['name' => $name])->orWhere(['email' => $name])->orWhere(['tel' => $name])->first();
//        if ($u) {
//            //验证登录
//            if(password_verify($pwd, $u->pwd)){
//                $token = substr(md5($u->id . Str::random(8) . mt_rand(11, 999999)), 10, 10);
//                $redis_user_token_key = 'u:token:' . $u->id . '';
//                Redis::set($redis_user_token_key, $token);
//                $respose = [
//                    'error' => 0,
//                    'msg' => '登录成功',
//                    'data' => [
//                        'token' => $token,
//                        'id' => $u->id
//                    ]
//                ];
//                return $respose;
//            } else {
//                echo "1";
//            }
//        }
//    }
    public function appid(){
        return view('login.appid');
    }
    public function weather(){
        return view('login.weather');
    }
    public function weatherdo(){
        $url = "https://free-api.heweather.net/s6/weather/{weather-type}?{parameters}";
        $res = file_get_contents($url);
        $lar = json_decode($res, true);
        $msg = $lar['text'];
        var_dump($msg);
    }
    public function show(){
        //1、初始化
        $ch = curl_init();
        //2、设置参数
        $url = 'http://wthrcdn.etouch.cn/weather_mini?city=北京市';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');  //字体类型
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
        //3、采集
        $re = curl_exec($ch);
        $res = json_decode($re, true);  //json格式转化为数组
        if (curl_errno($ch)) {
            var_dump(curl_error($ch));
        }
        //4、关闭
        curl_close($ch);
        var_dump($res);
    }
}