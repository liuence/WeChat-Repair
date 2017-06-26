<?php
require_once("../db.php");
$sql = "SELECT * FROM `info` ";
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
$key=array_slice($keys,-7,7);
$values=array_values($result);
$value=array_slice($values,-7,7);
$datay = json_encode($value); 
$datax = json_encode($key);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/table.js"></script>
<script type="text/javascript" src="http://vip.405shop.com/admin/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="http://vip.405shop.com/admin/js/highstock.js"></script>
<script type="text/javascript" src="http://vip.405shop.com/admin/js/exporting.js"></script>
<script>
 $(function() {
	$('#container1').highcharts({
		
		title: {
			text: '最近报修数量情况'
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
<script>  
$(function () {
    var chart;
    
    $(document).ready(function () {
    	
    	// Build the chart
        $('#container2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
			 colors:[
			    '#996699',
                '#CCCCFF',
				'#FFFFCC',
				'#CCFFFF',
				'#FFCCCC'
		
              ],
            title: {
                text: '苑区报修量统计'
            },
			credits: {
			text: ''
		    },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: '比例',
                data: [
				    ['南苑', <?php echo $nanyuan?>],
                    ['欣苑',  <?php echo $xinyuan?>],
					['西苑', <?php echo $xiyuan?>],
                    ['沁苑',  <?php echo $qinyuan?>],
					['东苑', <?php echo $dongyuan?>]
                ]
            }]
        });
    });
    
});				  
</script>   
</head>
<body>
<center> <div id="container1" style="height:360px"></div></center>
<center> <div id="container2" style="height:350px"></div></center>
</body>
</html>