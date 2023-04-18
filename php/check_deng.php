<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<?php
include_once("guan.php");
$deng=date("Y-m-d H:i:s");
if(!isset($_SESSION)){ 
    session_start(); 
} 
if($_SESSION['login_status']!="True")
{
		if($_POST['name']!="" && $_POST['pass']!=""){
			$name=$_POST['name'];
			$pass=$_POST['pass'];
			$sql=mysqli_query($conn,"select * from tb_kong where name='$name' and pass ='$pass'"); 
			$row=mysqli_fetch_object($sql); 
			if(!$row){
		
				echo "<script>alert('登录失败,帐号或者密码错误!');window.location.href='../deng.php';</script>";
				echo "<font color='red'>帐号或者密码错误!</font>";}
				mysqli_free_result($sql);
			if($sql){
				$_SESSION['login_status']="True";
				$_SESSION['name'] = $name;
				$sql=mysqli_query($conn, "update `tb_kong` set dengdate='".date("Y-m-d H:i:s")."' where name='$name'");
				echo "<script>alert('登录成功');window.location.href='../index.php';</script>";
				
			}
			mysqli_free_result($sql);
			mysqli_close($conn);
		}else{
			echo "<script>alert('登录用户名或者密码不能为空！');window.location.href='../deng.php'</script>";
		}
}else{
	echo "<script>alert('已经登陆成功，无需再次登陆');window.location.href='../index.php';</script>";
}
?>
</body>
</html>
