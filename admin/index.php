<?php
require_once("../db.php");
$sql2 = "SELECT * FROM `region` ";
$result2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($result2))
         {
        $arr2[]=$row2;
          }	

?>

<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh-CN">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>公寓管理中心微信报修管理系统</title>
	<link rel='stylesheet' id='admin-css'  href='css/admin.css' type='text/css' media='all' />
<link rel='stylesheet' id='fresh-css'  href='css/fresh.css' type='text/css' media='all' />
<meta name='robots' content='noindex,nofollow' />
	</head>
	<body class="login">
	<div id="login">	
<form name="loginform" id="loginform" action="check.php" method="post">
	<p>
		<label for="user_login">用户名<br />
		<input type="text" name="name" id="user_login" class="input" value="" size="20" tabindex="10" /></label>
	</p>
	<p>
		<label for="user_pass">密码<br />
		<input type="password" name="password" id="user_pass" class="input" value="" size="20" tabindex="20" /></label>
	</p>
	
		<input type="hidden" name="role" id="user_pass" class="input" value="公寓管理中心" size="20" tabindex="20" />
	
	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="登录" tabindex="100" />
		<input type="hidden" name="redirect_to" value="login.php" />
		<input type="hidden" name="testcookie" value="1" />
	</p>
</form>
<script type="text/javascript">
function wp_attempt_focus(){
setTimeout( function(){ try{
d = document.getElementById('user_login');
d.focus();
d.select();
} catch(e){}
}, 200);
}

wp_attempt_focus();
if(typeof wpOnload=='function')wpOnload();
</script>
	
	</div>

	
		<div class="clear"></div>
	</body>
	</html>