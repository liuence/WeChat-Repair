<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require_once("../db.php"); 
 if (!empty($_GET["id"])){ 
   $id = $_GET["id"]; 
   $sql = "delete  FROM `admin` where id='".$id."'";
   $result = mysql_query($sql);
   echo "<script language=javascript>alert('删除成功');window.window.location.href='admin-role.php';</script>";  
     
     }
//print_r($arr);
 ?>    