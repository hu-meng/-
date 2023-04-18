<?php
if(!isset($_SESSION)){ 
    session_start(); 
} 
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>储存空间</title>
		<link rel="shortcut icon" href="">
		<link href="css/style.css" type="text/css" rel="stylesheet">
	</head>

	<body>
		<script>
			function check(form){
			    if(form.usernc.value=="账号:"){
					alert("无账号，请登录!");form.usernc.focus();return false;
				}
				form.submit();
			}
		</script>
		<div id="topbar">
			<div class="right-nav">
				<?php
                echo "<p name='usernc' id='usernc'>您好：".$_SESSION['name']."</p>";
                echo "<a class='sa' href='php/deng_logout.php'>退出</a>";	
            ?>
			</div>
		</div>

		<div id="content">
			<ul class="nav">
				<li class="first">上传</li>
				<li class="second">储存空间</li>
			</ul>
			<div id="cont1" class="cont">
				<h2 class="contp">上传</h2>
				<form action="php/cun.php" method="post" enctype="multipart/form-data">
					<input type="file" name="file" multiple="multiple" class="input_file" />
					<div><input type="submit" value="上传" class="input_sub" ></div>
				</form>
			</div>
			<div id="cont2" class="cont">
				<h2 class="contp2">储存空间</h2>
				<div>
					<ul class="nav">
						<li class="third">
							<div class="nav2"><img src="images/folder.png" alt=""><br><span>照片</span></div>
						</li>
						<li class="fourth">
							<div class="nav2"><img src="images/folder.png" alt=""><br><span>文件夹</span></div>
						</li>
						<li class="fifth">
							<div class="nav2"><img src="images/folder.png" alt=""><br><span>查询</span></div>
						</li>
					</ul>
					<div class="cun">
						<div id="conta1" class="contb2">
							<h3 class="contp3">照片</h3>
							<table border="1px solid #ccc" cellspacing="0" cellpadding="0">
								<thead>
								<tr style="width: 100%;">
										<th style="width: 240px;letter-spacing: 50px;background-color: #f0f0f0;">
											照片名</th>
										<th style="width: 240px;letter-spacing: 50px;background-color: #f0f0f0;">
											时间</th>
										<th style="letter-spacing: 15px;background-color: #f0f0f0;">
											下载</th>
										<th style="letter-spacing: 15px;background-color: #f0f0f0;">
											删除</th>
									</tr>
								</thead>
								<?php
								include_once("php/guan.php");
								if ( isset( $_GET["page"] ) )
								    $page = $_GET["page"];
								else
								    $page = "";
								if ($page==""){
								    $page=1;}
								    if (is_numeric($page)){
								        $page_size=5;
								        $query="select count(*) as total from tb_images order by id desc";   
								        $result=mysqli_query($conn, $query);
								        $message_count=mysqli_fetch_array($result);
										$message_count=$message_count[0];
								        $page_count=ceil($message_count/$page_size);
								        $offset=($page-1)*$page_size;
								        $name=$_SESSION['name'];
										$sql=mysqli_query($conn, "select * from tb_images where name='$name' order by id desc limit $offset, $page_size");
								        $row=mysqli_fetch_object($sql);
								        if(!$row){
								            echo "<font color='red'>暂无照片文件信息!</font>";
								        }
								        do{
								?>
								<tr bgcolor="#FFFFFF">
									<td><?php echo $row->wenname;?></td>
									<td><?php echo $row->time;?></td><?php $a = $row->lu; $b = $row->wenname;?>
									<td><a href="<?php echo $a?>" download="<?php echo $b?>">下载</a></td>
									<td><a href="<?php echo 'php/del_images.php?id='.$b ?>"  color='red'>删除</a></td>
									
									
								</tr>
								<?php
								        }while($row=mysqli_fetch_object($sql));
								    }
								?>
								</table>
								<br>
								<table width="550" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<!--  翻页条 -->
										<td width="37%">
											&nbsp;&nbsp;页次：<?php echo $page;?>/<?php echo $page_count;?>页&nbsp;记录：<?php echo $message_count;?> 条&nbsp;
										</td>
										<td width="63%" align="right"><?php
								if($page!=1){
								    echo  "<a href=index.php?page=1>首页</a>&nbsp;";
								    echo "<a href=index.php?page=".($page-1).">上一页</a>&nbsp;";
								}
								if($page<$page_count){
								    echo "<a href=index.php?page=".($page+1).">下一页</a>&nbsp;";
								    echo  "<a href=index.php?page=".$page_count.">尾页</a>";
								}
								?>
								
							</table>
						</div>
						<div id="conta2" class="contb2">
							<h3 class="contp4">文件夹</h3>
							<table border="1px solid #ccc" cellspacing="0" cellpadding="0">
								<thead>
								<tr style="width: 100%;">
										<th style="width: 240px;letter-spacing: 50px;background-color: #f0f0f0;">
											照片名</th>
										<th style="width: 240px;letter-spacing: 50px;background-color: #f0f0f0;">
											时间</th>
										<th style="letter-spacing: 15px;background-color: #f0f0f0;">
											下载</th>
										<th style="letter-spacing: 15px;background-color: #f0f0f0;">
											删除</th>
									</tr>
								</thead>
								
								<?php
								if ( isset( $_GET["page"] ) )
								    $page = $_GET["page"];
								else
								    $page = "";
								if ($page==""){
								    $page=1;}
								    if (is_numeric($page)){
								        $page_size=5;
								        $query="select count(*) as total from tb_wen order by id desc";   
								        $result=mysqli_query($conn, $query);
								        $message_count=mysqli_fetch_array($result);
										$message_count=$message_count[0];
								        $page_count=ceil($message_count/$page_size);
								        $offset=($page-1)*$page_size;
								        $name=$_SESSION['name'];
										$sql=mysqli_query($conn, "select * from tb_wen where name='$name' order by id desc limit $offset, $page_size");
								        $row=mysqli_fetch_object($sql);
								        if(!$row){
								            echo "<font color='red'>暂无文件信息!</font>";
								        }
								        do{
								?>
								<tr bgcolor="#FFFFFF">
									<td><?php echo $row->wenname;?></td>
									<td><?php echo $row->time;?></td><?php $a = $row->lu; $b = $row->wenname;?>
									<td><a href="<?php echo $a?>" download="<?php echo $b?>">下载</a></td>
									<td><a href="<?php echo 'php/del_wen.php?id='.$b ?>"  color='red'>删除</a></td>
								</tr>
								<?php
								        }while($row=mysqli_fetch_object($sql));
								    }
								?>
								</table>
								<br>
								<table width="550" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<!--  翻页条 -->
										<td width="37%">
											&nbsp;&nbsp;页次：<?php echo $page;?>/<?php echo $page_count;?>页&nbsp;记录：<?php echo $message_count;?> 条&nbsp;
										</td>
										<td width="63%" align="right"><?php
								if($page!=1){
								    echo  "<a href=index.php?page=1>首页</a>&nbsp;";
								    echo "<a href=index.php?page=".($page-1).">上一页</a>&nbsp;";
								}
								if($page<$page_count){
								    echo "<a href=index.php?page=".($page+1).">下一页</a>&nbsp;";
								    echo  "<a href=index.php?page=".$page_count.">尾页</a>";
								}
								?>
								
							</table>
						</div>
						<div id="conta3" class="contb2">
							<h3 class="contp3">查询</h3>
							<form name="form1" method="post" action="" style="margin:0px;width: 100%;">
								<span style="float:left;">查询文件</span>
								<input name="txt_keyword" type="text" id="txt_keyword" size="40">
								<input class="an" type="submit" name="Submit" value="查找" onClick="return check(form)">
							</form><br>
							<table border="1px solid #ccc" cellspacing="0" cellpadding="0">
								<thead>
								
								</thead>
								
								<?php
								if ( isset( $_POST['txt_keyword'] ) ) {
								    $keyword=$_POST['txt_keyword'];
								    $sql=mysqli_query($conn,"select * from tb_wen where wenname like '%$keyword%' and name='$name'");
								    $sql2=mysqli_query($conn,"select * from tb_images where wenname like '%$keyword%' and name='$name'");
								    $row=mysqli_fetch_object($sql);
								    $row2=mysqli_fetch_object($sql2);
								        if(!$row and !$row2){
								            echo "<font color='red'>您搜索的信息不存在，请使用类似的关键字进行检索!</font>";}
								    		else if($row) {
								    ?>
								    			<table class="table">
								    				<tr style="width: 100%;">
								    						<th style="width: 240px;letter-spacing: 50px;background-color: #f0f0f0;">
								    							照片名</th>
								    						<th style="width: 240px;letter-spacing: 50px;background-color: #f0f0f0;">
								    							时间</th>
								    						<th style="letter-spacing: 15px;background-color: #f0f0f0;">
								    							下载</th>
								    						<th style="letter-spacing: 15px;background-color: #f0f0f0;">
								    							删除</th>
								    				</tr>
								                                            <?php                                        
								        	do{
								    ?>
								                                            <tr bgcolor="#FFFFFF">
								                                                <td><?php echo $row->wenname;?></td>
								                                                <td><?php echo $row->time;?></td><?php $a = $row->lu; $b = $row->wenname;?>
								                                                <td><a href="<?php echo $a?>" download="<?php echo $b?>">下载</a></td>
								                                                <td><a href="<?php echo 'php/del_wen.php?id='.$b ?>"  color='red'>删除</a></td>
								                                            </tr>
								                                            <?php
								    		}while($row=mysqli_fetch_object($sql));
								    ?>
								                                        </table>
								                                        <?php
								    	}
								    	else{
								    		?>
								    					<table class="table">
								    						<tr style="width: 100%;">
								    								<th style="width: 240px;letter-spacing: 50px;background-color: #f0f0f0;">
								    									照片名</th>
								    								<th style="width: 240px;letter-spacing: 50px;background-color: #f0f0f0;">
								    									时间</th>
								    								<th style="letter-spacing: 15px;background-color: #f0f0f0;">
								    									下载</th>
								    								<th style="letter-spacing: 15px;background-color: #f0f0f0;">
								    									删除</th>
								    						</tr>
								    		                                        <?php                                        
								    		    	do{
								    		?>
								    		                                        <tr bgcolor="#FFFFFF">
								    		                                            <td><?php echo $row2->wenname;?></td>
								    		                                            <td><?php echo $row2->time;?></td><?php $a = $row2->lu; $b = $row2->wenname;?>
								    		                                            <td><a href="<?php echo $a?>" download="<?php echo $b?>">下载</a></td>
								    		                                            <td><a href="<?php echo 'php/del_images.php?id='.$b ?>"  color='red'>删除</a></td>
								    		                                        </tr>
								    		                                        <?php
								    				}while($row=mysqli_fetch_object($sql2));
								    		?>
								    		                                    </table>
								    		                                    <?php
								    	}
								    }
								    ?></td>
								                            </tr>
								                        </table></td>
								                </tr>
								            </table>
						</div>
					</div>
				</div>
			</div>




		</div>
		<div class="footer">
			<div class="minxie">
				<span>图片来源声明:</span><br>
				<a href="https://www.flaticon.com/free-icons/folder" title="folder icons">Folder icons created byFreepik - Flaticon</a>
				<br>
				<p></p>
				<a href="https://beian.miit.gov.cn/" class="beian">备案号:</a>
			</div>
			<div style="width:410px;margin:0 auto;">
				<a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=44030902003734"
					style="display:inline-block;text-decoration:none;height:20px;line-height:20px;"><img
						src="../img/gongan.png" style="float:left;">
					<p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#939393;"></p>
				</a>
			</div>
		</div>
	</body>

	<script src="js/dao.js"></script>
	<?php
		mysqli_free_result($sql);
		mysqli_close($conn);
	?>
</html>

