<head>
    <title>微信在线报修</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css" /> 
	<link rel="stylesheet" href="/css/style.css" /> 
	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"> </script> 
	<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"> </script> 
</head>
<!-- Form -->
<div data-role="page" id="page2">
<div data-theme="a" data-role="header">
<a href="home.php?openid=<?php echo $_GET["openid"];?>" data-role="button" data-inline="true" data-icon="home" data-iconpos="notext" data-ajax="false"> Default panel</a>   
        <h3 id="header">
           修改资料
        </h3>
<a href="" data-role="button" data-rel="back" data-inline="true" data-icon="arrow-l" data-iconpos="notext" data-ajax="false" > Default panel</a>   
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
$tel=$row1['tel'];
$building=$row1['building'];

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
     
   <div data-role="content">
<form id="myform" name="myform" action="profile-update.php?openid=<?php echo $_GET["openid"];?>" method="post"  data-ajax="false" onsubmit = "return check();">     
  	<center><img class="profile-image" src="<?php echo $pic;?>" height="100" width="100"  alt="Avatar" / ></center>    
        <div data-role="fieldcontain">
            <label for="name">
                姓名：
            </label>
            <input name="name" id="name" placeholder="" value="<?php echo $name;?>" type="text">
        </div>
		<div data-role="fieldcontain">
            <label for="tel">
                手机：
            </label>
            <input name="tel" id="tel" placeholder="" value="<?php echo $tel;?>" type="text">
        </div>                        
        <div data-role="fieldcontain">
            <label for="region">
                单元：
            </label>
            <select id="region" name="region">
<?php if( is_array( $arr2 ) ): ?>
<?php foreach(  $arr2 as $item2 ): ?>  			
                <option value="<?php echo $item2['region'];?>" <?php if($item2['region']==$row1['region']){echo 'selected="selected"';}?>>
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
                <option value="<?php echo $item3['building'];?>" <?php if($item3['building']==$row1['building']){echo 'selected="selected"';}?>>
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
            <input name="dorm" id="dorm" placeholder="" value="<?php echo $dorm;?>" type="text">
        </div>
        <input id="sub" name="sub" type="submit" value="提交">
</form>     
    </div>	
      		<div data-role="panel" id="rightpanel" data-theme="b"  data-position="right">  
				
			<div class="panel-content"> 
<input name="" id="searchinput2" placeholder="" value="" type="search">
			</div> <!-- /content wrapper for padding -->  				
		</div> <!-- /leftpanel --> 
	
<div data-role="footer" data-position="fixed" data-tap-toggle="false" data-position="fixed" data-tap-toggle="false">    
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

