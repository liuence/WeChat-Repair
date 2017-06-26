<head>
    <title>微信在线报修</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css" /> 
	<link rel="stylesheet" href="/css/style.css" /> 
	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"> </script> 
	<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"> </script> 
<script language="javascript"> 

function check() 
{         

   
if (document.myform.explain.value.length == 0) {  
alert("请输入您的处理意见!"); 
document.myform.explain.focus(); 
return false; 
}   
    
return true; 
} 

</script> 	
</head>
<?php
require_once("../db.php");
$worker=$_COOKIE["name"];
$sql = "SELECT * FROM `worker` where name like '%$worker%'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$wtel=$row['tel'];
		  
$sql2 = "SELECT * FROM `wstatus` ";
$result2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($result2))
         {
        $arr2[]=$row2;
          }	
$id=$_GET["id"];   
$sql1 = "SELECT * FROM `info` where id='".$id."'";
$result1= mysql_query($sql1);
while($row1 = mysql_fetch_array($result1))
         {
        $arr1[]=$row1;
          }	 
?> 
<!-- Form -->
<div data-role="page" id="page2">
<div data-theme="a" data-role="header">
<a href="home.php?openid=<?php echo $_GET["openid"];?>" data-role="button" data-inline="true" data-icon="home" data-iconpos="notext" data-ajax="false"> Default panel</a>   
        <h3 id="header">
           业务办理
        </h3>
<a href="" data-role="button" data-rel="back" data-inline="true" data-icon="arrow-l" data-iconpos="notext" data-ajax="false" > Default panel</a>   
    </div>
  
<script type="text/javascript">
var messages = new Array(); 
messages[0] = "后勤报修平台已受理";			//这里写入每个选项对应的说明文字
messages[1] = <?php echo "'承修人：".$worker."，联系电话：".$wtel."，请保持手机畅通。'"; ?>;
messages[2] = "你的报修已维修完成，感谢你对51家庭帮的支持，期待你对本次维修进行评价。";	   
//根据需要，这里应该随着选项的改变而增减项目
function tryit() {	
var messageindex = document.myform.status.selectedIndex;	//取得当前下拉菜单选定项目的序号
msg = messages[messageindex];					//根据序号取得当前选项的说明
document.myform.explain.value = msg			//将说明写进文框
}
</script> 
   <div data-role="content">
<form id="myform" name="myform" action="review-update.php?id=<?php echo $_GET["id"];?>&openid=<?php echo $_GET["openid"];?>" method="post"  data-ajax="false" onsubmit = "return check();">                              
        <div data-role="fieldcontain">
            <label for="status">
                受理状态：
            </label>			
            <select id="status" name="status" data-ajax="false"  onchange="tryit()">
<?php if( is_array( $arr2 ) ): ?>
<?php foreach(  $arr2 as $item2 ): ?>  			
                <option data-ajax="false" value="<?php echo $item2['status'];?>" <?php if($item2['status']==$arr1[0]['status']){echo 'selected="selected"';}?>>
                    <?php echo $item2['status'];?>
                </option>
<?php endforeach; ?>
<?php endif; ?>				
            </select>
        </div>
		<div data-role="fieldcontain">
            <label for="explain">
                处理说明：
            </label>
            <textarea name="explain" id="explain" data-ajax="false" placeholder=""><?php echo $arr1[0]['explain'];?></textarea>
        </div>
		<br>
		<br>
        <input id="sub" name="sub" type="submit" value="提交">
</form>     
    </div>	
      		<div data-role="panel" id="rightpanel" data-theme="b"  data-position="right">  
				
			<div class="panel-content"> 
<input name="" id="searchinput2" placeholder="" value="" type="search">
			</div> <!-- /content wrapper for padding -->  				
		</div> <!-- /leftpanel --> 
	

<div data-role="navbar" data-position="fixed" data-iconpos="top" data-theme="a" data-tap-toggle="false" >
        <ul>
            <li>
                <a href="home.php?openid=<?php echo $_GET["openid"];?>" data-ajax="false" data-transition="none" data-theme="a" data-icon="home">
                    报修广场
                </a>
            </li>
        </ul>
</div>

    
</div>   

