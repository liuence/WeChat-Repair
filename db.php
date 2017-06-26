<?php
error_reporting(0);
$hostname = "localhost";
$username = "root";
$password = "930316";
$con = mysql_connect($hostname,$username,$password);
mysql_select_db("houqin", $con);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_query("set names utf8");  
?>