<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />   
<?php  
if ($_SERVER['REQUEST_METHOD'] == 'POST')  
{  
    require_once("db.php");
	$id=$_GET["id"]; 
	$openid=$_GET["openid"]; 
	$review=$_POST['review'];
	$status="已评价";
	$reviewtime=date("Y-m-d H:i:s"); 
	$sql="UPDATE `info` set `review`='".$review."',`reviewtime`='".$reviewtime."',`status`='".$status."' where id='".$id."'";   
	$result = mysql_query($sql);
	echo "<script language=javascript>alert('提交成功');window.window.location.href='page.php?id=$id&openid=$openid';</script>";
	}  


?> 