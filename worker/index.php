<?php
require_once("../db.php");
$sql2 = "SELECT * FROM `region` ";
$result2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($result2))
         {
        $arr2[]=$row2;
  
  }	

?>

<head>
    <title>微信在线报修</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css" /> 
	<link rel="stylesheet" href="/css/style.css" /> 
	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"> </script> 
	<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"> </script> 
</head>
<script type="text/javascript">
    
function onBridgeReady(){
 WeixinJSBridge.call('hideOptionMenu');
}

if (typeof WeixinJSBridge == "undefined"){
    if( document.addEventListener ){
        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
    }else if (document.attachEvent){
        document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
        document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
    }
}else{
    onBridgeReady();
}
    
</script>
<div data-role="page" id="page1"> <!--  page  -->
 
    <div data-role="header"> <!-- header 頁眉 -->
        <h1>维修工管理入口</h1>
      </div>    <!-- 頁眉 End  -->
 
    <br />
<div data-role="content">	
 <form id="myform" name="myform" action="check.php" method="post" data-ajax="false"> 	
    <div data-role="fieldcontain">
     
        <label for="name">
               用户名：
         </label>
         <input name="name"  placeholder="" value="" type="text" />
  	</div>
	 <div data-role="fieldcontain">
       <label for="password">
               密　码：
         </label>
         <input name="password"  placeholder="" value="" type="password" />
	</div>	 
    <div data-role="fieldcontain">
		    <label for="role">
                苑区：
            </label>			
            <select id="role" name="role">
<?php if( is_array( $arr2 ) ): ?>
<?php foreach(  $arr2 as $item2 ): ?>  			
                <option value="<?php echo $item2['region'];?>">
                    <?php echo $item2['region'];?>
                </option>
<?php endforeach; ?>
<?php endif; ?>				
            </select>
	</div>			

             <input id="sub" name="sub" type="submit" value="登录">
 </form>
<label for="weixin">
<center>您也可以使用微信账号授权登录:</center>
</label><br>
<center><a href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0bb1e5f3113fdeb3&redirect_uri=http://houqin.xiaojinke.com/worker/home.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect" data-ajax="false"><img src="../image/wx_logo.png" /></a></center>
     </div>
	 
<div data-role="footer" data-position="fixed">
    	<h4>微信报修管理系统</h4>
</div>	 
</div>
 <!--page end --> 
