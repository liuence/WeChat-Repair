<?php
require_once("../db.php");
$sql = "SELECT * FROM `info` ";
$sql1 = "SELECT * FROM `user` ";
$sql2="select * from `info` where date(time) = curdate()";
$sql3="SELECT * FROM `info` WHERE TO_DAYS(NOW()) - TO_DAYS(time) = 1";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
         {
        $arr[]=$row;
          }	
$result1 = mysql_query($sql1);
while($row1 = mysql_fetch_array($result1))
         {
        $arr1[]=$row1;
          }	
$result2 = mysql_query($sql2);		  
while($row2 = mysql_fetch_array($result2))
         {
        $arr2[]=$row2;
          }	
$result3 = mysql_query($sql3);		  
while($row3 = mysql_fetch_array($result3))
         {
        $arr3[]=$row3;
          }		  
$max=count($arr);
$max1=count($arr1);
$max2=count($arr2);
$max3=count($arr3);
?>