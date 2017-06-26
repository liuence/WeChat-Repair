<head>
    <title>微信在线报修</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css" /> 
	<link rel="stylesheet" href="/css/style.css" /> 
	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"> </script> 
	<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"> </script> 
</head>
<?php
require_once("db.php");
$openid=$_GET["openid"]; 
$sql = "SELECT * FROM `user` where openid='".$openid."'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
         {
        $arr[]=$row;
          }
		  
if (!isset($arr)){
	
	
echo "<script language=javascript>alert('请使用微信登录!');window.window.location.href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0bb1e5f3113fdeb3&redirect_uri=http://houqin.xiaojinke.com/wx.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';</script>";	
 	
}	  
?> 
 
<?php
    $pagesize=5;
	if($_GET[page]){
	$pageval=$_GET[page];
	$page=($pageval-1)*$pagesize;
	$page.=',';
	}
    require_once("db.php");
	$openid=$_GET["openid"];
    $sql2 = "SELECT * FROM `info` where openid='".$openid."' order by `id` desc limit $page $pagesize ";
    $result2 = mysql_query($sql2);
	while($row2 = mysql_fetch_array($result2))
         {
        $arr2[]=$row2;
          }	
?> 

 <!-- My -->
<div data-role="page" id="page1">
<div data-theme="a" data-role="header" data-tap-toggle="false">
<a href="home.php?openid=<?php echo $_GET["openid"];?>" data-role="button" data-inline="true" data-icon="home" data-iconpos="notext"> Default panel</a>   
        <h3 id="header">
          我的报修
        </h3>
<a href="#rightpanel" data-role="button" data-inline="true" data-icon="gear" data-iconpos="notext" data-ajax="false"> Default panel</a> 			
    </div>
    <div data-role="content">         
<ul data-role="listview" data-theme="d" data-divider-theme="d" data-ajax="false"> 
<?php if( is_array( $arr2 ) ): ?> 
<?php foreach(  $arr2 as $item ): ?>
<?php
switch ($item['status'])
{
case "已受理":
  $color="#CC3299";
  break;
case "已派工":
  $color="#66B3FF";
  break;
case "已维修待评价":
  $color="#8e44ad";
  break;
case "专项维修":
  $color="#6A6AFF";
  break; 
case "假期维修":
  $color="#2F4F4F";
  break;   
case "已评价":
  $color="#01B468";
  break;
  case "已驳回":
  $color="#ffa500";  
  break;
default:
 $color="#CC3299";
}
?>
<li> 
<a href="review-page.php?id=<?php echo $item['id'];?>&openid=<?php echo $_GET["openid"];?>" data-ajax="false" > 
	<h3><?php echo $item['content'];?></h3> 
	<p> 时间：<?php echo $item['time'];?> <span style="float:right">报修人：<?php echo $item['author'];?></span></p> 
	<p class="ui-li-aside"> <strong> <font color="<?php echo $color;?>"><?php echo $item['status'];?></font></strong></p> 
</a> 
</li>
<?php endforeach; ?>
<?php endif; ?>	 
</ul>
<br>
<?php     

$url=$_SERVER["REQUEST_URI"];
$url=parse_url($url);
$url=$url[path];

require_once("db.php");
$openid=$_GET["openid"];
$sql3 = "SELECT * FROM `info` where openid='".$openid."' order by `id` desc ";
$result3 = mysql_query($sql3);
while($row3 = mysql_fetch_array($result3))
         {
        $arr3[]=$row3;
          }	
$num = count($arr3);


if($num > $pagesize){
 if($pageval<=1)$pageval=1;
echo "共 $num 条".
		" <a href=$url?page=".($pageval-1)."&openid=".$_GET["openid"]." data-role=button data-inline=true data-rel=dialog data-icon=arrow-l data-ajax=false>上一页</a> <a href=$url?page=".($pageval+1)."&openid=".$_GET["openid"]." data-role=button data-inline=true data-rel=dialog data-iconpos=right data-position=right data-icon=arrow-r data-ajax=false>下一页</a>";
}      
      
?>
       
    </div>	
<?php
require_once("db.php");
$openid=$_GET["openid"]; 
$sql1 = "SELECT * FROM `user`  where openid='".$openid."'";
$result1= mysql_query($sql1);
$row1 = mysql_fetch_array($result1);
$name=$row1['name']; 
$pic=$row1['pic'];
$region=$row1['region'];
$dorm=$row1['dorm'];
$building=$row1['building'];                         
$tel=$row1['tel'];
?>
    		<!-- rightpanel  --> 
		<div data-role="panel" id="rightpanel" data-theme="b" data-position="right" > 
				
			<div class="panel-content"> 
				<center><img class="profile-image" src="<?php echo $pic;?>" height="100" width="100"  alt="Avatar" / ></center>   
				<center><p><font size="5"><?php echo $name;?></font></p></center>  

            <hr>
             <p>苑区：<?php echo $region;?></p>
			 <p>楼栋：<?php echo $building;?></p>
			 <p>寝室：<?php echo $dorm;?></p>
             <p>手机：<?php echo $tel;?></p> 
			</div> <!-- /content wrapper for padding --> 
                 <center> <a href="profile.php?openid=<?php echo $_GET["openid"];?>" data-ajax="false" data-theme="c" data-role="button" data-inline="true" data-icon="edit"> 编辑资料</a> </center>    				
		</div> <!-- /rightpanel -->      
<div data-role="footer" data-position="fixed" data-tap-toggle="false" data-tap-toggle="false">    
<div data-role="navbar" data-iconpos="top" data-theme="a">
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
</div>   