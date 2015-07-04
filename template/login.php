<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0" />
<title>叮铃登录界面模板</title>

    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="__PUBLIC__/css/login.css">
</head>

<body>
<div class="box">
		<div class="login-box">
			<div class="login-title text-center">
				<h2><small>叮呤订水后台管理系统</small></h2>
			</div>
			<div class="login-content ">
			<div class="form">
			<form method="post" action="__URL__/login">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <input type="text" id="username" name="username" class="form-control" placeholder="用户名">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="text" id="password" name="password" class="form-control" placeholder="密码">
                </div>
                <div class="btn-login-box">
                    <button type="submit" class="btn btn-sm btn-info btn-login">登录</button>
                </div>

			</form>
			</div>
		</div>
	</div>
</div>

</body>

</html>