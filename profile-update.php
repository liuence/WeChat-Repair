<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />   
<?php  
if ($_SERVER['REQUEST_METHOD'] == 'POST')  
{  
    require_once("db.php"); 
	$openid=$_GET["openid"]; 
	$name=$_POST['name']; 
	$tel=$_POST['tel'];   
	$region=$_POST['region'];
	$building=$_POST['building'];
	$dorm=$_POST['dorm'];     	
	$sql="UPDATE `user` set `name`='".$name."',`tel`='".$tel."',`region`='".$region."', `building`='".$building."' , `dorm`='".$dorm."' where openid='".$openid."'";   
	$result = mysql_query($sql);
	echo "<script language=javascript>alert('提交成功');window.window.location.href='home.php?openid=$openid';</script>";
	}  


?> 