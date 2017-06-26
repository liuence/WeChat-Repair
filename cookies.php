<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting(0);
if(!isset($_COOKIE["name"])){
  echo("<script type='text/javascript'> alert('非法访问,请先登录');location.href='/admin/index.php';</script>");
  exit();
}
//检测是否登录，若没登录则转向登录界面
if($_GET['action'] == "logout"){
    setcookie("name", "", time()-3600);
    setcookie("password", "", time()-3600);
	setcookie("role", "", time()-3600);
    echo '注销登录成功！点击此处 <a href="/admin/index.php">登录</a>';
    exit;
}
?>