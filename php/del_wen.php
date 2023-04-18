<?php
if(!isset($_SESSION)){ 
    session_start(); 
} 
include('guan.php');
$name=$_SESSION['name'];
$b=$_GET['id'];
$b=addslashes($b);
$sql=mysqli_query($conn,"select * from tb_kong where name='$name'"); 
$row=mysqli_fetch_object($sql); 

if(!$row){
		if($name!=""){
			echo "<script>alert('未登录,未检测到账号!');window.location.href='../deng.php';</script>";
			mysqli_free_result($sql);
			mysqli_close($conn);
			return;
		}
		echo "<script>alert('未知错误!');window.location.href='../deng.php';</script>";
		mysqli_free_result($sql);
		mysqli_close($conn);
		return;
	}
if($sql){
	$status=unlink("../cunchu/$name/wen/$b");    
	if($status){  
		mysqli_query($conn,"DELETE FROM tb_wen WHERE name = '$name' and wenname = '$b'  limit 1");
		echo "<script>alert('删除成功');window.location.href='../index.php';</script>";
	}else{  
		echo "<script>alert('删除失败！错误');window.location.href='../index.php'</script>";   
	}  
	mysqli_free_result($sql);
	mysqli_close($conn);
	return;
}
else{
	echo "<script>alert('删除失败！');window.location.href='../index.php'</script>";
	mysqli_free_result($sql);	
	mysqli_close($conn);	
	return;
}
?>