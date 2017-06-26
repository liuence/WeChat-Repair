<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />   
<?php
require_once("db.php");
if (!empty($_POST['sub'])){ 
$region=$_POST['region']; 
$dorm=$_POST['dorm']; 
$building=$_POST['building'];
$content=$_POST['content'];
$status="已受理"; 
$person="微信报修系统(电脑端)"; 
$explain="后勤报修平台已受理"; 
$time= date("Y-m-d H:i:s"); 
$today=date("Y-m-d");   
$openid=$_GET["openid"]; 
$sql1 = "SELECT * FROM `user`  where openid='".$openid."'";
$result1= mysql_query($sql1);
$row1 = mysql_fetch_array($result1);
$author=$row1['name'];   
$tel=$row1['tel']; 
$sql4 = "SELECT * FROM `info`  where time like '%$today%' && author='".$author."' && content='".$content."'";
$result4= mysql_query($sql4);
while($row = mysql_fetch_array($result4))
  {
   $arr[]=$row;
  }	
if (isset($arr)){
    
echo "<script language=javascript>alert('您已经提交过相同报修内容啦！');window.window.location.href='form.php?openid=$openid';</script>";
     
    } else{
if ($_FILES["file"]["size"] > 3*1024*1024)
			{
				echo "<script language=javascript>alert('请上传小于3M的图片');window.window.location.href='form.php?openid=$openid';</script>";	
			}
			else
			{
				if (file_exists("upload/" . $_FILES["file"]["name"]))
				{
					echo "<script language=javascript>alert('该文件已经存在']);window.window.location.href='form.php?openid=$openid';</script>";	
				}
				else
				{     $filename=$_FILES["file"]["name"];
	                  $extpos = strrpos($filename,'.');//返回字符串filename中'.'号最后一次出现的数字位置
	                  $ext = substr($filename,$extpos+1);
	                  $file = time().'.'.$ext;
					move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" .$file);
				}
$sql3 = "SELECT * FROM `push`  where role='".$region."'&&building='".$building."'";
$result3= mysql_query($sql3);
$row3 = mysql_fetch_array($result3);
$openid2=$row3['openid'];
$worker=$row3['worker'];
$sql2 = "INSERT  INTO `info` ( `id` ,`region` ,`building`, `dorm` , `content`,`time`,`status`, `author`, `openid`, `tel`,`person`,`explain`,`uptime`,`file`,`worker`) VALUES ('', '$region' ,'$building' ,'$dorm' ,'$content','$time','$status','$author','$openid','$tel','$person','$explain','$time','$file','$worker') ";
$result2 = mysql_query($sql2);
$sql4 = "SELECT * FROM `info`  where time='".$time."'";
$result4= mysql_query($sql4);
$row4= mysql_fetch_array($result4);
$id=$row4['id'];
if(empty($row4['file'])){
$pic="无图";	
}else{
$pic="有图";	
}
require_once('weixin.class.php');
$weixin = new class_weixin();
$template=array(
           'touser'=>$openid,
           'template_id'=>"6qFQqYkNssj5gqJ0cZ-l-0E_6Q9xSPfEPqyFqeqYqDs",
           'url'=>"http://houqin.xiaojinke.com/review-page.php?id=".$id."&openid=".$openid,
		   'topcolor'=>"#FF0000",
		   'data'=>array(
                   'first'=>array(
                       'value'=>urldecode($author."同学，您已经成功预约微信报修服务！\n"),
                       'color'=>"#173177",
                   ),
                   'keyword1'=>array(
                       'value'=>urldecode(date("Y-m-d H:i:s")),
                       'color'=>"#173177",
                   ),
                   'keyword2'=>array(
                       'value'=>urldecode("微信报修"),
                       'color'=>"#173177",
                   ),
                   'keyword3'=>array(
                       'value'=>urldecode("已受理"),
                       'color'=>"#173177",
                   ),
                   'remark'=>array(
                       'value'=>urldecode("\n报修内容：".$content."\n是否有图：".$pic),
                       'color'=>"#173177",
                   )
                    )
			);	
$template2=array(
           'touser'=>$openid2,
           'template_id'=>"6qFQqYkNssj5gqJ0cZ-l-0E_6Q9xSPfEPqyFqeqYqDs",
           'url'=>"http://houqin.xiaojinke.com/review-page.php?id=".$id."&openid=".$openid2,
		   'topcolor'=>"#FF0000",
		   'data'=>array(
                   'first'=>array(
                       'value'=>urldecode($author."同学正在预约微信报修服务！\n"),
                       'color'=>"#173177",
                   ),
                   'keyword1'=>array(
                       'value'=>urldecode(date("Y-m-d H:i:s")),
                       'color'=>"#173177",
                   ),
                   'keyword2'=>array(
                       'value'=>urldecode("微信报修"),
                       'color'=>"#173177",
                   ),
                   'keyword3'=>array(
                       'value'=>urldecode("已受理"),
                       'color'=>"#173177",
                   ),
                   'remark'=>array(
                       'value'=>urldecode("\n苑区：".$region."\n楼栋：".$building."\n寝室：".$dorm."\n联系方式：".$tel."\n报修内容：".$content."\n是否有图：".$pic),
                       'color'=>"#173177",
                   )
                    )
			);				
$weixin->send(urldecode(json_encode($template)));
$weixin->send(urldecode(json_encode($template2)));
echo "<script language=javascript>alert('提交成功');window.window.location.href='my.php?openid=$openid';</script>";		
				
			}
			
			}
                    }		   
?>
	
