<?php
require_once("cookies.php");  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公寓管理中心微信报修系统</title>
<!-- paste this code into your webpage -->
<link href="css/table.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/table.js"></script>
<!-- end -->
<style>
body { margin:0; padding:0; background:#f1f1f1; font:70% Arial, Helvetica, sans-serif; color:#555; line-height:150%; text-align:left; }
a { text-decoration:none; color:#057fac; }
a:hover { text-decoration:none; color:#999; }
h1 { font-size:140%; margin:0 20px; line-height:80px; }
h2 { font-size:120%; }
#container { margin:0 auto; width:950px; background:#fff; padding-bottom:20px; }
#content { margin:0 20px; }
p.sig { margin:0 auto; width:680px; padding:1em 0; }
form { margin:1em 0; padding:.2em 20px; background:#eee; }
</style>
   
</head>
<body>
    
<?php
require_once("../db.php");
$id=$_GET["id"]; 
$sql1 = "SELECT * FROM `admin`  where id='".$id."'";
$result1= mysql_query($sql1);
$row1 = mysql_fetch_array($result1);
$name=$row1['name']; 
$role=$row1['role'];		  	  

$sql2 = "SELECT * FROM `region` ";
$result2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($result2))
         {
        $arr2[]=$row2;
          }	
		  
		  	  
?>	
<div id="container">
  <div id="content">
    <!-- all you need with Tablecloth is a regular, well formed table. No need for id's, class names... -->
  <b><?php include("header.php") ?>|欢迎您,点击此处 <a href="edit-admin.php?action=logout">注销</a> 登录！ </b>  
    <form action="" method="post" enctype="multipart/form-data" name="form" id="form" onsubmit="CheckPost();">
  <fieldset>
  <legend>账号信息管理</legend>
  
    <dl id="name" class="title">
   <dt>用户名</dt>
   <dd><input name="name" value="<?php echo $name;?>" type="text" /></dd>
</dl>  
           
   <dl id="password" class="title">
   <dt>密码</dt>
   <dd><input name="password" value="" type="password" /></dd>
</dl>         

  <dl id="role" class="title">
   <dt>用户角色</dt>
      <dd><select id="role" name="role">
	   <option value="公寓管理中心" >公寓管理中心</option>
<?php if( is_array( $arr2 ) ): ?>
<?php foreach(  $arr2 as $item2 ): ?>  			
                <option value="<?php echo $item2['region'];?>" <?php if($item2['region']==$role){echo 'selected="selected"';}?>>
                    <?php echo $item2['region'];?>
                </option>
<?php endforeach; ?>
<?php endif; ?>				
            </select>	</dd>
</dl>
                
<div id="send">
  <p>
    <input name="sub" type="submit" class="buttom"  value="提交表单"/>
  </p>
  </div>
  </fieldset>   
  </form>
 


</body>
</html>
    
    
<?php 
require_once("../db.php"); 
if (!empty($_POST['sub'])){   
$name=$_POST['name'];   
$password=md5($_POST['password']);
$role=$_POST['role'];  
$sql="UPDATE `admin` set `name`='".$name."',`password`='".$password."', `role`='".$role."'";
$result = mysql_query($sql);

echo "<script language=javascript>alert('提交成功');window.window.location.href='admin-role.php';</script>";

    
}

?>
