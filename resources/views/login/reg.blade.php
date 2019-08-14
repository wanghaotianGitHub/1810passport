<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <meta name="viewport" content="width=device-width, initial-scale=1  maximum-scale=1 user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="HandheldFriendly" content="True">
</head>
<body>
    <div align="center">
        <h1>欢迎注册</h1><br/>
            <div>
                名称：<input type="text" name="name" id="name" class="validate" placeholder="名称" required>
            </div>
            <br/>
            <div>
                邮箱：<input type="email" name="email" id="email" placeholder="邮箱" class="validate" required>
            </div>
            <br/>
            <div>
                手机：<input type="text" name="tel" id="tel" placeholder="手机号" class="validate" required>
            </div>
            <br/>
            <div>
                密码：<input type="password" name="pwd" id="pwd" placeholder="密码" class="validate" required>
            </div>
            <br/>
            <div>
                身份证正面：<input type="file" name="img1" id="img1" class="validate" required>
            </div>
            <br/>
            <div>
                身份证反面：<input type="file" name="img2" id="img2" class="validate" required>
            </div>
            <br/>
            {{--<input type="submit" id="reg">--}}
            <button id="reg">提交</button>
    </div>
</body>
</html>
<script src="layui/layui.js"></script>
<script src="js/jquery-3.2.1.min.js"></script>
<link href="layui/css/layui.css" rel="stylesheet" type="text/css">
<script>
    $(function(){
        layui.use(['form','layer'],function(){
            var layer=layui.layer;
            $('#reg').click(function(){
                var name = $("input[name='name']").val();
                var email = $("input[name='email']").val();
                var tel = $("input[name='tel']").val();
                var pwd = $("input[name='pwd']").val();
                $.post(
                    "http://1810passport.com/regdo",
                    {name:name,email:email,tel:tel,pwd:pwd},
                    function(res){
                        if(res==1){
                            layer.msg('注册成功', {icon: 1});
                            location.href='/login';
                        }
                    },
                    'json'
                )
            });
        })
    })
</script>