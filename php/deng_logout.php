<?php
if(!isset($_SESSION)){ 
    session_start(); 
} 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<?php 
include_once("guan.php");
    session_start();
        if(!isset($_SESSION)){ 
            session_start(); 
        } 
        session_destroy();
        echo "<script>alert('已退出！');window.location.href='../deng.php';</script>";
?>
</body>
</html>