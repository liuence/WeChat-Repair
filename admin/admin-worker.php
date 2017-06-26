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
  <b><?php include("header.php") ?>|欢迎您,点击此处 <a href="admin-worker.php?action=logout">注销</a> 登录！ </b>  
    <form action="" method="post" enctype="multipart/form-data" name="form" id="form" onsubmit="CheckPost();">
  <fieldset>
  <legend>新增维修工账号</legend>
  
    <dl id="name" class="title">
   <dt>用户名</dt>
   <dd><input name="name" value="" type="text" /></dd>
</dl> 
    <dl id="tel" class="title">
   <dt>联系电话</dt>
   <dd><input name="tel" value="" type="text" /></dd>
</dl>  
    <dl id="password" class="title">
   <dt>密码</dt>
   <dd><input name="password" value="" type="password" /></dd>
</dl>     
  <dl id="role" class="title">
   <dt>用户角色</dt>
      <dd><select id="role" name="role">
<?php if( is_array( $arr2 ) ): ?>
<?php foreach(  $arr2 as $item2 ): ?>  			
                <option value="<?php echo $item2['region'];?>" <?php if($item2['region']==$region){echo 'selected="selected"';}?>>
                    <?php echo $item2['region'];?>
                </option>
<?php endforeach; ?>
<?php endif; ?>	
			<option value="专项维修" >专项维修</option>
			<option value="假期维修" >假期维修</option>
            </select>	</dd>
</dl>
    <dl id="openid" class="title">
   <dt>Openid</dt>
   <dd><textarea name="openid" cols=40 rows=4>
</textarea></dd>
                
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
$role=$_POST['role'];
$tel=$_POST['tel'];
$openid=$_POST['openid'];
$password=md5($_POST['password']); 

$sql = "INSERT  INTO `worker` ( `id` ,`name` ,`password`,`role`, `openid`, `tel`) VALUES ('', '$name','$password','$role' ,'$openid','$tel') ";    
$result = mysql_query($sql);

echo "<script language=javascript>alert('提交成功');window.window.location.href='admin-workerlist.php';</script>";

    
}

?>
