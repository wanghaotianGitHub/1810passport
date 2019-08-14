<?php
namespace App\Http\Controllers\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Model\TtModel;
class AppController extends Controller{
    public function doLogin(Request $request){
        $data=$request->post();
//        dd($data);
        $url='http://1810passport.com/doLoginApi';
        $res=$this->req_api($data,$url);
//        dd($res);
        $res=json_decode($res,true);
        return $res;
    }
    //请求接口方法
//    public function req_api($data,$url){
//        $client=new Client();
//        $res=$client->request('POST',$url,[
//            'form_params' => $data
//        ]);
//        $response=$res->getBody();
//        return $response;
//    }
    public function req_api($data,$url){
        //初始化
        $ch=curl_init();
        //设置接口地址
        curl_setopt($ch,CURLOPT_URL,$url);
        //post提交
        curl_setopt($ch,CURLOPT_POST,1);
        //提交数据fields   returntransfer
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //发送请求
        $data=curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    public function doLoginApi(Request $request){
        $data=$request->all();
        $user = TtModel::where(['name'=>$data['name']])->first();
        if($user){
            $user=$user->toArray();
            if($data['pwd']==$user['pwd']){
                $token=substr(md5(rand(10000,99999).time()),10,30);
                $tt=[
                    1=>2,
                    2=>1,
                    3=>4,
                    4=>3
                ];
                if($data['tt']!=$user['tt']){
                    TtModel::where(['id'=>$user['id']])->update(['token'=>$token,'expire'=>time()+86400]);
                }else{
                    TtModel::where(['id'=>$user['id'],'tt'=>$tt[$data['tt']]])->delete();
                    $arr=[
                        'name'=>$data['name'],
                        'pwd'=>$data['pwd'],
                        'tt'=>$data['tt'],
                        'token'=>$token,
                        'expire'=>time()+86400
                    ];
                    TtModel::insert($arr);
                }
                return $res=[
                    'status'=>1000,
                    'msg'=>'登录成功',
                    'token'=>$token
                ];
            }else{
                return $res=[
                    'status'=>1,
                    'msg'=>'用户名或密码错误1'
                ];
            }
        }else{
            return $res=[
                'status'=>1,
                'msg'=>'用户名或密码错误2'
            ];
        }
    }
}