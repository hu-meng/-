<?php
include_once("guan.php");
$name=$_POST['name'];
$pass=$_POST['pass'];
$email=$_POST['email'];
$date=date("Y-m-d H:i:s");
$dengdate=date("Y-m-d H:i:s");

$a=mysqli_query($conn,"select name from `tb_kong` where name='$name'");
$b=mysqli_num_rows($a);
$c=mysqli_query($conn,"select email from `tb_kong` where email='$email'");
$d=mysqli_num_rows($c);
if(!$b){
    $sql=mysqli_query($conn, "insert into tb_kong(name,pass,email,date,dengdate) values('$name','$pass','$email','$date','$dengdate')");	//执行插入操作
    if($sql){
        echo "<script>alert('注册成功');window.location.href='../deng.php';</script>";
    }
}
else if($d){
    echo "<script>alert('邮箱已存在，请换一个');window.location.href='../zhuce.php';</script>";
}
else{
    echo "<script>alert('帐号已存在，请换一个');window.location.href='../zhuce.php';</script>";
 
}


mysqli_free_result($sql);
mysqli_close($conn);
?>