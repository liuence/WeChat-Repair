<?php
require_once("cookies.php"); 
require_once("../db.php");
$role=$_COOKIE["role"];
$sql = "SELECT * FROM `info` where region like '%$role%' order by id asc";
$result = mysql_query($sql);
   while($row = mysql_fetch_array($result))
         {
        $arr[]=$row;
          }	
$max=count($arr);
for($i=1;$i<$max;$i++)
{
    
    
    $arr2[] = date('m-d',strtotime($arr[$i]['time']));
}
for($m=1;$m<$max;$m++)
{
    
    
    $arr3[] = $arr[$m]['region'];
}
$result2=array_count_values($arr3);
$nanyuan=$result2['南苑'];
$xinyuan=$result2['欣苑'];
$xiyuan=$result2['西苑'];
$qinyuan=$result2['沁苑'];
$dongyuan=$result2['东苑'];

$result=array_count_values($arr2);
$keys=array_keys($result);
$key=array_slice($keys,-30,30);
$values=array_values($result);
$value=array_slice($values,-30,30);
$datay = json_encode($value); 
$datax = json_encode($key);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公寓管理中心微信报修系统</title>
<!-- paste this code into your webpage -->
<link href="css/table.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/table.js"></script>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/highstock.js"></script>
<script type="text/javascript" src="js/exporting.js"></script>
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
<script>
 $(function() {
	$('#container1').highcharts({
		
		title: {
			text: <?php echo "'".$role."每日报修情况统计'" ?>
		},
		credits: {
			text: ''
		},
		
		xAxis: {
			categories: <?php echo $datax ?>,
			min:1
		},
		yAxis: {
			
			title: {
				text: '每日新增报修量'
			}
		},
		
		tooltip: {
			crosshairs: [{
				width: 1,
				color: 'Gray'
			}, {
				width: 1,
				color: 'gray'
			}]
		},
		
		series: [{
        name: '报修数',
        data: <?php echo $datay ?>
    }],
		scrollbar: {
			enabled: true/*,
			barBackgroundColor: 'gray',
			barBorderRadius: 7,
			barBorderWidth: 0,
			buttonBackgroundColor: 'gray',
			buttonBorderWidth: 0,
			buttonArrowColor: 'yellow',
			buttonBorderRadius: 7,
			rifleColor: 'yellow',
			trackBackgroundColor: 'white',
			trackBorderWidth: 1,
			trackBorderColor: 'silver',
			trackBorderRadius: 7
			*/
		}

	});
});				
  </script>  
</head>
<body>
<div id="container">
  <div id="content">

    <!-- all you need with Tablecloth is a regular, well formed table. No need for id's, class names... -->
     <b> <?php include("header.php") ?>|欢迎您,点击此处 <a href="admin-index.php?action=logout">注销</a> 登录！</b>
	 </br>
	 </br>
	 <center> <div id="container1" style="height:360px"></div></center>
	<br>
	<?php include("footer.php") ?>
    </div>
    </div>
</body>
</html>