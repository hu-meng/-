<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>储存空间</title>
	<link rel="shortcut icon" href="../img/hu.png">
    <link href="css/deng.css" type="text/css" rel="stylesheet">
</head>
<script>
	function check(form){
		if(form.name.value==""){
			alert("请输入帐号!");form.name.focus();return false;
		}
		if(form.pass.value==""){
			alert("请输入密码!");form.pass.focus();return false;
		}
		form.submit();
	}
</script>
<body>
    <div id="loginDiv">
        <form class="form1" action="php/check_deng.php" name="form1" method="post">
            <h1 style="text-align: center;color: aliceblue;">登录</h1>
            <p>账号:<input id="name" type="text" placeholder="请输入账号" name="name"></p>

            <p>密码:<input id="pass" type="password" placeholder="请输入密码" name="pass"></p>
            <div style="text-align: center;margin-top: 30px;">
                <button type="submit" name="sub" class="button" onclick="return check(form1);">登录</button>
				<button type="button" class="button" onclick="window.location.href='zhuce.php'">注册</button>
            </div>
			
        </form>
    </div>

</body>

</html>
<script src="js/deng.js"></script>