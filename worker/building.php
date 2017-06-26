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
<?php
	$building=$_GET["building"]; 
	$worker=$_COOKIE["name"];
    $pagesize=6;
	if($_GET[page]){
	$pageval=$_GET[page];
	$page=($pageval-1)*$pagesize;
	$page.=',';
	}
    require_once("../db.php");  
    $sql = "SELECT * FROM `info`  where building='".$building."' && worker='".$worker."' order by `id` desc limit $page $pagesize";
    $result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
         {
        $arr[]=$row;
          }	
    	
?>   
<div data-role="page" id="page1" data-ajax="false" data-fullscreen="false">


    <div data-theme="a" data-role="header" data-position='fixed' data-tap-toggle="false">
        <a href="home.php" data-role="button" data-inline="true" data-icon="home" data-ajax="false" data-iconpos="notext"> Default panel</a>  
        <h3 id="header">
          <?php echo $building."栋";?>
        </h3>
       <a href="" data-role="button" data-rel="back" data-inline="true" data-icon="arrow-l" data-iconpos="notext" data-ajax="false" > Default panel</a>  
    </div>
    <div data-role="content" data-ajax="false">         
<ul data-role="listview" data-split-icon="gear" data-theme="d"  data-ajax="false"> 
<?php if( is_array( $arr ) ): ?>
<?php foreach(  $arr as $item ): ?> 
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
<a href="page.php?id=<?php echo $item['id'];?>&openid=<?php echo $_GET["openid"];?>" data-ajax="false" > 
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

$sql1 = "SELECT * FROM `info` where building='".$building."' && worker='".$worker."' order by `id` desc ";
$result1 = mysql_query($sql1);
while($row1 = mysql_fetch_array($result1))
         {
        $arr1[]=$row1;
          }	
$num = count($arr1);


if($num > $pagesize){
 if($pageval<=1)$pageval=1;
echo "共 $num 条".
		" <a href=$url?page=".($pageval-1)."&openid=".$_GET["openid"]."&building=".$_GET["building"]." data-role=button data-inline=true data-rel=dialog data-icon=arrow-l data-ajax=false>上一页</a> <a href=$url?page=".($pageval+1)."&openid=".$_GET["openid"]."&building=".$_GET["building"]." data-role=button data-inline=true data-rel=dialog data-iconpos=right data-position=right data-icon=arrow-r data-ajax=false>下一页</a>";
}      
      
?>
    </div>   
<div data-role="navbar" data-position="fixed" data-iconpos="top" data-theme="a" data-tap-toggle="false" >
        <ul>
            <li>
                <a href="home.php?openid=<?php echo $_GET["openid"];?>" data-ajax="false" data-transition="none" data-theme="a" data-icon="home">
                    报修广场
                </a>
            </li>
        </ul>
</div>
<?php	  
$sql2 = "SELECT * FROM `push` where worker like '%$worker%' order by `id` asc";
$result2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($result2))
         {
        $arr2[]=$row2;
          }	
?> 	
<div data-role="panel" id="rightpanel" data-theme="b"  data-position="right">  				
<div class="panel-content"> 
<ul data-role="listview" data-inset="true">
<?php if( is_array( $arr2 ) ): ?>
<?php foreach(  $arr2 as $item2 ): ?>  
<li><a href="building.php?building=<?php echo $item2['building'];?>" data-ajax="false"><?php echo $item2['building'];?></a></li>
<?php endforeach; ?>
<?php endif; ?>		
</ul>
</div> <!-- /content wrapper for padding -->  				
</div> <!-- /leftpanel -->  
</div>  