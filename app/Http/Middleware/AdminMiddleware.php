<?php
namespace App\Http\Middleware;
use Closure;
class AdminMiddleware{
    public function handle($request, Closure $next){
        $token=$request->get('token');
        $token=TtModel::where(['token'=>$token])->first();
        if(empty($token)){
            echo '您的账号已在其他终端登录，请重新登录';
            header("refresh:2;url=/login");
        }
        return $next($request);
    }
}
