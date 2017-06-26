<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />   
<?php  
if ($_SERVER['REQUEST_METHOD'] == 'POST')  
{  
	function isMobile(){  
		$useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';  
		$useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';  	  
		function CheckSubstrs($substrs,$text){  
			foreach($substrs as $substr)  
				if(false!==strpos($text,$substr)){  
					return true;  
				}  
				return false;  
		}
		$mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
		$mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');  
			  
		$found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||  
				  CheckSubstrs($mobile_token_list,$useragent);  
			  
		if ($found_mobile){  
			return true;  
		}else{  
			return false;  
		}  
	}
	if (isMobile())
		$person= '微信报修系统(手机端)';
	else
		$person= '微信报修系统(电脑端)';
    require_once("../db.php");
	$id=$_GET["id"]; 
    $status=$_POST['status'];
	$explain=$_POST['explain'];
	$uptime=date("Y-m-d H:i:s"); 	
	$sql="UPDATE `info` set `explain`='".$explain."',`status`='".$status."' ,`uptime`='".$uptime."',`person`='".$person."' where id='".$id."'";   
	$result = mysql_query($sql);
	$sql1 = "SELECT * FROM `info`  where id='".$id."'";
	$result1= mysql_query($sql1);
	$row1 = mysql_fetch_array($result1);
	$time=$row1['time'];
	$author=$row1['author'];
	$openid1=$row1['openid'];
	require_once('../weixin.class.php');
    $weixin = new class_weixin();
    $template=array(
           'touser'=>$openid1,
           'template_id'=>"6qFQqYkNssj5gqJ0cZ-l-0E_6Q9xSPfEPqyFqeqYqDs",
           'url'=>"http://houqin.xiaojinke.com/review-page.php?id=".$id."&openid=".$openid1,
		   'topcolor'=>"#0000FF",
		   'data'=>array(
                   'first'=>array(
                       'value'=>urldecode($author."同学，您预约的微信报修服务【".$status."】。\n"),
                       'color'=>"#173177",
                   ),
                   'keyword1'=>array(
                       'value'=>urldecode($time),
                       'color'=>"#173177",
                   ),
                   'keyword2'=>array(
                       'value'=>urldecode("微信报修"),
                       'color'=>"#173177",
                   ),
                   'keyword3'=>array(
                       'value'=>urldecode($status),
                       'color'=>"#173177",
                   ),
                   'remark'=>array(
                       'value'=>urldecode("\n".$explain),
                       'color'=>"#173177",
                   )
                    )
			);	
$weixin->send(urldecode(json_encode($template)));	
	
	
	echo "<script language=javascript>alert('提交成功');window.window.location.href='page.php?id=$id&openid=$openid';</script>";
	
	
}  
?> 