<?php
require_once("cookies.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公寓管理中心微信报修系统</title>
<!-- paste this code into your webpage -->
<link href="css/table.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/table.js"></script>
<!-- end -->
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
   
</head>
<body>
    
<?php
require_once("../db.php");
$id=$_GET["id"]; 
$sql1 = "SELECT * FROM `info`  where id='".$id."'";
$result1= mysql_query($sql1);
$row1 = mysql_fetch_array($result1);
$author=$row1['author']; 
$region=$row1['region'];
$dorm=$row1['dorm'];
$tel=$row1['tel'];
$building=$row1['building'];
$time=$row1['time'];
$openid=$row1['openid'];
$content=$row1['content'];
$status=$row1['status'];
$explain=$row1['explain'];
$person=$row1['person'];
$review=$row1['review'];
$file=$row1['file'];
$department=$row1['department'];
$sql2 = "SELECT * FROM `region` ";
$result2 = mysql_query($sql2);
$sql4 = "SELECT * FROM `push`  where role='".$region."'&&building='".$building."'";
$result4= mysql_query($sql4);
$row4 = mysql_fetch_array($result4);
$worker=$row4['worker'];
while($row2 = mysql_fetch_array($result2))
         {
        $arr2[]=$row2;
          }	
		  
$sql3 = "SELECT * FROM `status` ";
$result3 = mysql_query($sql3);
while($row3 = mysql_fetch_array($result3))
         {
        $arr3[]=$row3;
          }	
$sql5 = "SELECT * FROM `worker` where role='".$region."'&&name='".$worker."'";
$result5= mysql_query($sql5);
$row5 = mysql_fetch_array($result5);
$wtel=$row5['tel'];			  
?> 	
<div id="container">
  <div id="content">
  <b><?php include("header.php") ?>|欢迎您,点击此处 <a href="edit-info.php?action=logout">注销</a> 登录！ </b>  
    <form action="" method="post" enctype="multipart/form-data" name="form" id="form" onsubmit="CheckPost();">
  <fieldset>
  <legend>报修信息管理</legend>
       
  <dl id="name" class="title">
   <dt>单元</dt>
      <dd><select id="region" name="region">
<?php if( is_array( $arr2 ) ): ?>
<?php foreach(  $arr2 as $item2 ): ?>  			
                <option value="<?php echo $item2['region'];?>" <?php if($item2['region']==$region){echo 'selected="selected"';}?>>
                    <?php echo $item2['region'];?>
                </option>
<?php endforeach; ?>
<?php endif; ?>				
            </select>	</dd>
</dl>
  
   <dl id="building" class="title">
   <dt>楼栋</dt>
   <dd><input name="building" value="<?php echo $building;?>" type="text" /></dd>
</dl>
  
   <dl id="dorm" class="title">
   <dt>房间</dt>
   <dd><input name="dorm" value="<?php echo $dorm;?>" type="text" /></dd>
</dl>
         
   <dl id="con" class="title">
   <dt>报修内容</dt>
   <dd><textarea name="content" cols=40 rows=4>
<?php echo $content;?>
</textarea></dd>
</dl>  
        <dl id="myfile" class="title">
   <dt>报修图片</dt>
    <p>
<?php if(!empty($file)){echo '<a href="../upload/'.$file.'">点击查看报修图</a>'  ;}else{echo"暂无";}?>			
</dl>   
    <dl id="time" class="title">
   <dt>提交时间</dt>
   <dd><input name="time" value="<?php echo $time;?>" type="text" /></dd>
        
</dl>
    <dl id="author" class="title">
   <dt>报修人</dt>
   <dd><input name="author" value="<?php echo $author;?>" type="text" /></dd>
</dl>  
      
      
   <dl id="tel" class="title">
   <dt>联系方式</dt>
   <dd><input name="tel" value="<?php echo $tel;?>" type="text" /></dd>
</dl> 

   <dl id="review" class="title">
   <dt>用户评价</dt>
   <dd><input name="review" value="<?php echo $review;?>" type="text" /></dd>
</dl>
 
    <dl id="person" class="title">
   <dt>受理人</dt>
   <dd><input name="person" value="<?php echo $person;?>" type="text" /></dd>
</dl>   
    <dl id="status1" class="title">
   <dt>处理状态</dt>
   <dd><select id="status" name="status" onchange="tryit()">
<?php if( is_array( $arr3 ) ): ?>
<?php foreach(  $arr3 as $item3 ): ?>  			
<option value="<?php echo $item3['status'];?>" <?php if($item3['status']==$status){echo 'selected="selected"';}?>>
<?php echo $item3['status'];?>
</option>
<?php endforeach; ?>
<?php endif; ?>				
            </select></dd>
</dl>
        
   <dl id="explain1" class="title">
   <dt>处理说明</dt>
   <dd><textarea id="explain" name="explain" cols=40 rows=4>
<?php echo $explain;?>
</textarea></dd>
</dl>   
        
<div id="send">
  <p>
    <input name="sub" type="submit" class="buttom"  value="提交表单"/>
  </p>
  </div>
  </fieldset>   
  </form>
 


</body>
</html>
    
    
<?php 
require_once("../db.php"); 
if (!empty($_POST['sub'])){
$region=$_POST['region']; 
$building=$_POST['building'];
$content=$_POST['content'];
$dorm=$_POST['dorm'];    
$time=$_POST['time'];
$status=$_POST['status'];    
$tel=$_POST['tel'];  
$author=$_POST['author']; 
$explain=$_POST['explain'];
$person=$_POST['person']; 
$review=$_POST['review']; 
$uptime=date("Y-m-d H:i:s");  
$sql="UPDATE `info` set `region`='".$region."',`review`='".$review."', `content`='".$content."' ,`building`='".$building."' , `dorm`='".$dorm."',  `time`='".$time."',`status`='".$status."',`tel`='".$tel."',`author`='".$author."',`explain`='".$explain."' ,`uptime`='".$uptime."',`person`='".$person."' where id='".$id."'";
$result = mysql_query($sql);

echo "<script language=javascript>alert('提交成功');window.history.back(-1);</script>";

require_once('../weixin.class.php');
$weixin = new class_weixin();
$template=array(
           'touser'=>$openid,
           'template_id'=>"6qFQqYkNssj5gqJ0cZ-l-0E_6Q9xSPfEPqyFqeqYqDs",
           'url'=>"http://houqin.xiaojinke.com/review-page.php?id=".$id."&openid=".$openid,
		   'topcolor'=>"#FF0000",
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
var_dump($weixin->send(urldecode(json_encode($template))));	
    
}

?>
<script type="text/javascript">
var messages = new Array(); 
messages[0] = "后勤报修平台已受理";			//这里写入每个选项对应的说明文字
messages[1] = <?php echo "'承修人：".$worker."，联系电话：".$wtel."，请保持手机畅通。'"; ?>;
messages[2] = "你的报修已维修完成，感谢你对51家庭帮的支持，期待你对本次维修进行评价。";	   
messages[3] = "空调维修在质保期内，请拨打厂家维修电话13507203572";
messages[4] = "房间热水系统属专项维修，请拨打厂家维修电话";
messages[5] = "网络电话维修属专项维修，请拨打中国电信服务热线10000，或者拨打通讯中心电话6393333";
messages[6] = "洗衣机属专项维修，请拨打厂家维修电话13972038604";
messages[7] = "";
messages[8] = "";
messages[9] = "";
messages[10] = "";
//根据需要，这里应该随着选项的改变而增减项目
function tryit() {	
var messageindex = document.form.status.selectedIndex;	//取得当前下拉菜单选定项目的序号
msg = messages[messageindex];					//根据序号取得当前选项的说明
document.form.explain.value = msg			//将说明写进文框
}
</script>