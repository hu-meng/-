<?php
if(!isset($_SESSION)){ 
    session_start(); 
} 	
	include_once("guan.php");
	$deng=date("Y-m-d H:i:s");
	$name=$_SESSION['name'];
	$sql=mysqli_query($conn,"select * from tb_kong where name='$name'"); 
	$row=mysqli_fetch_object($sql); 
	if(!$row){
		if($_POST['name']!=""){	
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
		header('Content-type:text/html;charset=utf-8');
		if($_FILES['file']['error'] == 0){
			$fileName = $_FILES['file']['name'];
			$fileSize = $_FILES['file']['size'];
			$tmp_name = $_FILES["file"]["tmp_name"];
			$fileTypeInfo = ['exe','dll','com','ocx','vxd','sys','vbs','asp','jsp','hta','htm'];
			$fileTypeInfo2 = ['jpg','png','JPEG','TIFF','GIF','PSD',' RAW','EPS','SVG','PDF','BMP','tif'];
			$fileType = substr(strrchr($fileName,'.'),1);
			if(in_array($fileType,$fileTypeInfo)){ 
				echo "<script>alert('上传失败,不允许上传');window.location.href='../index.php';</script>";
				mysqli_free_result($sql);
				mysqli_close($conn);
				return;
			}
			date_default_timezone_set('PRC');
			if(in_array($fileType,$fileTypeInfo2)){
				if(!file_exists("../cunchu/".$_SESSION['name']."/img")){
						mkdir("../cunchu/".$_SESSION['name']."/img");
						if(move_uploaded_file($tmp_name,"../cunchu/".$_SESSION['name']."/img/".$fileName)){
							$lu="cunchu/".$_SESSION['name']."/img/".$fileName;
							$sql=mysqli_query($conn, "insert into tb_img(name,wenname,time,lu) values('$name','$fileName','$deng','$lu')");
							echo "<script>alert('上传成功');window.location.href='../index.php';</script>";
							mysqli_free_result($sql);
							mysqli_close($conn);
						}
				}else{
					
					if(move_uploaded_file($tmp_name,"../cunchu/".$_SESSION['name']."/img/".$fileName)){
						$lu="cunchu/".$_SESSION['name']."/img/".$fileName;
						$sql=mysqli_query($conn, "insert into tb_img(name,wenname,time,lu) values('$name','$fileName','$deng','$lu')");
						echo "<script>alert('上传成功');window.location.href='../index.php';</script>";
						mysqli_free_result($sql);
						mysqli_close($conn);
					}
				}
			}
			if(!file_exists("../cunchu/".$_SESSION['name']."/wen")){
					mkdir("../cunchu/".$_SESSION['name']."/wen");
					
					if(move_uploaded_file($tmp_name,"../cunchu/".$_SESSION['name']."/wen/".$fileName)){
						$lu="cunchu/".$_SESSION['name']."/wen/".$fileName;
						$sql=mysqli_query($conn, "insert into tb_wen(name,wenname,time,lu) values('$name','$fileName','$deng','$lu')");
						echo "<script>alert('上传成功');window.location.href='../index.php';</script>";
						mysqli_free_result($sql);
						mysqli_close($conn);
					}
			}else{
				
				if(move_uploaded_file($tmp_name,"../cunchu/".$_SESSION['name']."/wen/".$fileName)){
					$lu="cunchu/".$_SESSION['name']."/wen/".$fileName;
					$sql=mysqli_query($conn, "insert into tb_wen(name,wenname,time,lu) values('$name','$fileName','$deng','$lu')");
					echo "<script>alert('上传成功');window.location.href='../index.php';</script>";
					mysqli_free_result($sql);
					mysqli_close($conn);
				}
			}
		}else{
			echo "上传失败".$_FILES['file']['error'];
			mysqli_free_result($sql);
			mysqli_close($conn);
		}
	}

?>
