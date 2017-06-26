<?php
header('Content-Type: text/html; charset=utf-8');
if($_POST["name"]&&$_POST["password"]){
setcookie("name", $_POST['name']);	
setcookie("role", $_POST['role']);
}
require_once("../db.php");
$sql="select * from admin where name='".$_POST['name']."' && password='".md5($_POST['password'])."' && role='".$_POST['role']."'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
 $arr[]=$row;
 }	
 
if(isset($arr)){
echo("<script type='text/javascript'> alert('登录成功！');location.href='admin-index.php';</script>");
}
else
{
echo("<script type='text/javascript'> alert('你输入的用户名或密码错误，请重新输入！');location.href='../admin1';</script>");
}
?>
