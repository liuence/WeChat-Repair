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
<style type="text/css">
.ui-li-desc {  
white-space: normal;  
}  
</style >
<?php
require_once("db.php");
$openid=$_GET["openid"];
$id=$_GET["id"]; 
$sql = "SELECT * FROM `info`  where id='".$id."'";
$result= mysql_query($sql);
$row = mysql_fetch_array($result);
$author=$row['author']; 
$region=$row['region'];
$dorm=$row['dorm'];
$content=$row['content'];
$time=$row['time'];
$status=$row['status'];
$explain=$row['explain'];
$person=$row['person'];
$department=$row['department'];
$uptime=$row['uptime'];
$building=$row['building'];
$reviewtime=$row['reviewtime'];
$review=$row['review'];
$file=$row['file'];
?> 
  <!-- Page -->
<div data-role="page" id="page1" data-ajax="false" data-tap-toggle="false">


    <div data-theme="a" data-role="header">  
        <h3 id="header">
          报修状态
        </h3> 
    </div>
    <div data-role="content">         
<ul data-role="listview" data-inset="true" data-ajax="false"> 
<li data-role="list-divider" data-ajax="false"> 申报 <span style="float:right"><?php echo $time;?></span</li> 
	<li> 
		<p>报修人：<?php echo $author;?></p> 		
		<p>单元：<?php echo $region;?></p> 
		<p>楼栋：<?php echo $building;?></p> 
		<p>房间：<?php echo $dorm;?></p> 
		<p>报修内容：<?php echo $content;?></p> 
	</li>	
<li data-role="list-divider" data-ajax="false"> 受理 <span style="float:right"><?php echo $uptime;?></span</li> 	
	<li> 
		<p>受理人：<?php echo $person;?></p> 
		<p>处理说明：<?php echo $explain;?></p> 
		<p>状态：<?php echo $status;?></p> 
	</li> 
		
<?php if(!empty($review)){echo '<li data-role="list-divider" data-ajax="false"> 评价 <span style="float:right">'.$reviewtime.'</span></li><li> <p>用户评价：'.$review.'</p> </li>'  ;}?>		
</ul> 
<?php if(!empty($file)){echo ' <center><a href="#popupPhotoLandscape" data-rel="popup" data-position-to="window"  data-theme="c" data-role="button" data-icon="search" data-inline="true" data-ajax="true">查看图片</a></center><div data-role="popup" id="popupPhotoLandscape" class="photopopup" data-overlay-theme="a" data-corners="false" data-tolerance="30,15"> <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right"> Close</a> <img src="upload/'.$file.'" > </div>  ' ;}?> 	
    </div>
<div data-role="navbar" data-position="fixed" data-iconpos="top" data-theme="a" data-tap-toggle="false" >
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
</div>   