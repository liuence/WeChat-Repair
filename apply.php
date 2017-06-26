<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />    
<?php
require_once("db.php");
if (!empty($_POST['sub'])){ 
$name=$_POST['name']; 
$building=$_POST['building'];
$dorm=$_POST['dorm'];
$tel=$_POST['tel']; 
$region=$_POST['region'];   
$regtime= date("Y-m-d H:i:s");    
$openid=$_GET["openid"]; 
$img=$_GET["img"];     

$sql1 = "SELECT * FROM `user`  where openid='".$openid."'";
$result1= mysql_query($sql1);
while($row = mysql_fetch_array($result1))
  {
   $arr[]=$row;
  }	
   
    
   if (isset($arr)){
    
echo "<script language=javascript>alert('您已经注册过啦！');window.window.location.href='home.php?openid=$openid';</script>";
    
    
    }else{
    
    
$sql2 = "INSERT  INTO `user` ( `id` ,`name` ,`tel` , `region`,`building`,`dorm`,`regtime`, `openid`, `pic`) VALUES ('', '$name' ,'$tel' ,'$region','$building','$dorm','$regtime','$openid','$img') ";    
$result2 = mysql_query($sql2);

echo "<script language=javascript>alert('注册成功');window.window.location.href='home.php?openid=$openid';</script>";
     
    
    }
    
}


?>