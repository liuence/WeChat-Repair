<?php
$code=$_GET["code"];
$url='https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx0bb1e5f3113fdeb3&secret=8b73f13bf044d99b65b62bfddde77a15&code='.$code.'&grant_type=authorization_code';
$data=file_get_contents($url);
$arr = json_decode($data,true);
$access_token=$arr['access_token'];
$openid=$arr['openid'];
$userinfo='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
$user=file_get_contents($userinfo);
$json = json_decode($user,true);
//print_r($json);
$nickname=$json['nickname'];
$city=$json['city'];
$headimgurl=$json['headimgurl'];
$headimgurl2=str_replace("/0", "/64",$headimgurl);

require_once("db.php");
$sql1 = "SELECT * FROM `user`  where openid='".$openid."'";
$result1 = mysql_query($sql1);
while($row1 = mysql_fetch_array($result1))
  {
   $arr1[]=$row1;
  }	

if(isset($arr1))
{
    
echo "<script language=javascript>;window.window.location.href='home.php?openid=$openid';</script>";

}

$sql2 = "SELECT * FROM `building` ";
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
<script language="javascript"> 

function check() 
{  
if (document.myform.name.value.length == 0) {  
alert("请输入您的姓名!"); 
document.myform.name.focus(); 
return false; 
}    
    
if (document.myform.tel.value.length == 0) {  
alert("请输入您的手机!"); 
document.myform.tel.focus(); 
return false; 
}
             
if (document.myform.dorm.value.length == 0) {  
alert("请输入您的房间号!"); 
document.myform.dorm.focus(); 
return false; 
}     

    
return true; 
} 

</script>   

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

<div data-role="page" id="page2" >
    <div data-theme="a" data-role="header">
        <h3 id="header">
           绑定微信
        </h3>
    </div>  
   <div data-role="content">
<form id="myform" name="myform" action="apply.php?openid=<?php echo $openid;?>&img=<?php echo $headimgurl;?>" method="post"  data-ajax="false" onsubmit = "return check();">     
  	<center><img class="profile-image" src="<? echo $headimgurl; ?>" height="100" width="100"  alt="Avatar" / ></center>    
        <div data-role="fieldcontain">
            <label for="name">
                姓名：
            </label>
            <input data-transition="none" name="name" id="name" placeholder="" value="" type="text">
        </div>
		<div data-role="fieldcontain">
            <label for="tel">
                手机：
            </label>
            <input data-transition="none" name="tel" id="tel" placeholder="" value="" type="text">
        </div>                        
        <div data-role="fieldcontain">
            <label for="region">
                单元：
            </label>
            <select id="region" name="region">
                <option value="南苑">
                    南苑
                </option>
                <option value="沁苑">
                    沁苑
                </option>
                <option value="欣苑">
                    欣苑
                </option>
                <option value="西苑">
                    西苑
                </option>
                <option value="东苑">
                    东苑
                </option>
            </select>
        </div>
		<div data-role="fieldcontain">
            <label for="building">
                楼栋号：
            </label>
            <select id="building" name="building">
<?php if( is_array( $arr2 ) ): ?>
<?php foreach(  $arr2 as $item2 ): ?>  
                <option value="<?php echo $item2['building'];?>">
                    <?php echo $item2['building'];?>
                </option>
<?php endforeach; ?>
<?php endif; ?>				
            </select>
        </div>
		<div data-role="fieldcontain">
            <label for="dorm">
                房间号：
            </label>
            <input data-transition="none" name="dorm" id="dorm" placeholder="填写示例:423" value="" type="text">
        </div>
        <input name="sub" id="sub" type="submit" value="注册">
</form>   
    </div>		
<div data-role="navbar" data-iconpos="top" data-theme="a" data-position="fixed">
        <ul>
            <li>
                <a href="home.php"  data-ajax="false" data-transition="none" data-theme="a" data-icon="home">
                    报修广场
                </a>
            </li>
            <li>
                <a href="form.php"  data-ajax="false" data-transition="none" data-theme="a" data-icon="edit">
                    我要报修
                </a>
            </li>
            <li>
                <a href="my.php"  data-ajax="false" data-transition="none" data-theme="a" data-icon="info">
                    我的报修
                </a>
            </li>
        </ul>
</div>
    
</div>   