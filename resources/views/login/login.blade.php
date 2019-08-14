<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1  maximum-scale=1 user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="HandheldFriendly" content="True">
</head>
<body>
    <div align="center">
        <h1>登录 可用用户名 邮箱 手机号登录</h1><br/>
            <div>
                登录类型：<select name="tt" id="tt">
                        <option value="1">PC</option>
                        <option value="2">H5</option>
                        <option value="3">安卓</option>
                        <option value="4">ios</option>
                    </select>
            </div>
            <br/>
            <div>
                名称：<input type="text" name="name" id="name" class="validate" placeholder="用户名 邮箱 手机号" required>
            </div>
            <br/>
            <div>
                密码：<input type="password" name="pwd" id="pwd" class="validate" placeholder="密码" required>
            </div>
            <br/>
            <button id="login">登录</button>
    </div>
</body>
</html>
<link href="layui/css/layui.css" rel="stylesheet" type="text/css">
<script src="layui/layui.js"></script>
<script src="js/jquery-3.2.1.min.js"></script>
<script>
    $(function() {
        layui.use(['form','layer'],function(){
            var layer = layui.layer;
            $('#login').click(function () {
                var name = $("input[name='name']").val();
                var pwd = $("input[name='pwd']").val();
                var tt = $("#tt").val();
                $.post(
//                    "http://1810passport.com/logindo",
                    "http://1810passport.com/doLogin",
                    {name: name,pwd: pwd,tt:tt},
                    function ($res) {
                        console.log($res);
                        if($res['status']==1){
//                            header("refresh:2;url=/login");
                            location.href('login');
                        }else if($res['status']==1000){
//                            header("refresh:2;url=/appid?token=".$res['token']);
                            location.href('appid');
                            return $res;
                        }
                        alert($res['msg']);
                    },
                    'json'
                )
            });
        })
    })
</script>