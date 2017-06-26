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
if (document.myform.tel.value.length == 0) {  
alert("请输入您的手机!"); 
document.myform.tel.focus(); 
return false; 
}
       
if (document.myform.building.value.length == 0) {  
alert("请输入您的楼栋号!"); 
document.myform.building.focus(); 
return false; 
}      
 
if (document.myform.dorm.value.length == 0) {  
alert("请输入您的房间号!"); 
document.myform.dorm.focus(); 
return false; 
}  
   
if (document.myform.content.value.length == 0) {  
alert("请输入您的报修内容!"); 
document.myform.content.focus(); 
return false; 
}   
    
return true; 
} 

</script>   
<?php
require_once("db.php");
$openid=$_GET["openid"]; 
$sql1 = "SELECT * FROM `user` where openid='".$openid."'";
$result1= mysql_query($sql1);
while($row1 = mysql_fetch_array($result1))
         {
        $arr1[]=$row1;
          }		  		  
if (!isset($arr1)){
		
echo "<script language=javascript>alert('请使用微信登录!');window.window.location.href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0bb1e5f3113fdeb3&redirect_uri=http://houqin.xiaojinke.com/wx.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';</script>";	
	
}

$sql2 = "SELECT * FROM `region` ";
$result2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($result2))
         {
        $arr2[]=$row2;
          }	
$sql3 = "SELECT * FROM `building` ";
$result3 = mysql_query($sql3);
while($row3 = mysql_fetch_array($result3))
         {
        $arr3[]=$row3;
          }			  
		  
?> 
<div data-role="page" id="page2">
<div data-theme="a" data-role="header" data-tap-toggle="false">
<a href="home.php?openid=<?php echo $_GET["openid"];?>" data-role="button" data-inline="true" data-icon="home" data-iconpos="notext" data-ajax="false"> Default panel</a>  
        <h3 id="header">
           我要报修
        </h3>
<a href="" data-role="button" data-rel="back" data-inline="true" data-icon="arrow-l" data-iconpos="notext" data-ajax="false" > Default panel</a>  
    </div>
    
<div data-role="content">
 <form id="myform" name="myform" action="update.php?openid=<?php echo $_GET["openid"];?>" method="post"  enctype="multipart/form-data" data-ajax="false" onsubmit = "return check();">                       
        <div data-role="fieldcontain">
            <label for="region">
                单元：
            </label>			
            <select id="region" name="region">
<?php if( is_array( $arr2 ) ): ?>
<?php foreach(  $arr2 as $item2 ): ?>  			
                <option value="<?php echo $item2['region'];?>" <?php if($item2['region']==$arr1[0]['region']){echo 'selected="selected"';}?>>
                    <?php echo $item2['region'];?>
                </option>
<?php endforeach; ?>
<?php endif; ?>				
            </select>
        </div>
		 <div data-role="fieldcontain">
            <label for="building">
                楼栋：
            </label>
             <select id="building" name="building">
<?php if( is_array( $arr3 ) ): ?>
<?php foreach(  $arr3 as $item3 ): ?>  
                <option value="<?php echo $item3['building'];?>" <?php if($item3['building']==$arr1[0]['building']){echo 'selected="selected"';}?>>
                    <?php echo $item3['building'];?>
                </option>
<?php endforeach; ?>
<?php endif; ?>				
            </select>
        </div>
        <div data-role="fieldcontain">
            <label for="dorm">
                房间：
            </label>
            <input name="dorm" id="dorm" placeholder="" value="<?php echo $arr1[0]['dorm']?>" type="text">
        </div>
		 <div data-role="fieldcontain">
            <label for="tel">
                联系方式：
            </label>
            <input name="tel" id="tel" placeholder="" value="<?php echo $arr1[0]['tel']?>" type="text">
        </div>
		<div data-role="fieldcontain">
            <label for="file">
                上传图片：
            </label>
            <input type="file" name="file" id="file" /> 
        </div>
        <div data-role="fieldcontain">
            <label for="content">
                报修内容：
            </label>
            <textarea name="content" id="content" placeholder=""></textarea>
        </div>
        <input id="sub" name="sub" type="submit" value="提交">
 </form>    
    </div>
		
      		<div data-role="panel" id="rightpanel" data-theme="b"  data-position="right">  
				
			<div class="panel-content"> 
<input name="" id="searchinput2" placeholder="" value="" type="search">
			</div> <!-- /content wrapper for padding -->  				
		</div> <!-- /leftpanel --> 
		

<div data-role="navbar" data-position="fixed" data-iconpos="top" data-theme="a">
        <ul>
            <li>
                <a href="home.php?openid=<?php echo $_GET["openid"];?>" data-ajax="false" data-transition="none" data-theme="a" data-icon="home">
                    报修广场
                </a>
            </li>
            <li>
                <a href="form.php?openid=<?php echo $_GET["openid"];?>" data-ajax="false" data-transition="none" data-theme="a" data-icon="edit">
                    我要报修
                </a>
            </li>
            <li>
                <a href="my.php?openid=<?php echo $_GET["openid"];?>" data-ajax="false" data-transition="none" data-theme="a" data-icon="info">
                    我的报修
                </a>
            </li>
        </ul>
</div>
    
</div>   