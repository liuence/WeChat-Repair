<?php
if (!empty($_POST['sub'])){       
   setcookie("building", $_POST['building'],time()+3600);	
   setcookie("status1", $_POST['status'],time()+3600);
   echo "<script language=javascript>window.window.location.href='admin-table.php';</script>";
    } 
require_once("cookies.php");
require_once("../db.php"); 
$sql3 = "SELECT * FROM `building` ";
$result3 = mysql_query($sql3);
while($row3 = mysql_fetch_array($result3))
         {
        $arr3[]=$row3;
          }
$sql5= "SELECT * FROM `status` ";
$result5 = mysql_query($sql5);
while($row5 = mysql_fetch_array($result5))
         {
        $arr5[]=$row5;
          }			 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公寓管理中心微信报修系统</title>
<!-- paste this code into your webpage -->
<link href="css/table.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../css/pager.css" type="text/css" rel="stylesheet" /> 
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
</style>
</head>
<body>
<div id="container">
  <div id="content">
    <!-- all you need with Tablecloth is a regular, well formed table. No need for id's, class names... -->
  <b><?php include("header.php") ?>|欢迎您,点击此处 <a href="admin-table.php?action=logout">注销</a> 登录！ </b> 
<br><br>
<form action="" method="post" name="form" id="form" >
<select id="building" name="building">
<option value="所有楼栋">所有楼栋</option>
<?php if( is_array( $arr3 ) ): ?>
<?php foreach(  $arr3 as $item3 ): ?>  
                <option value="<?php echo $item3['building'];?>" <?php if($item3['building']==$_COOKIE["building"]){echo 'selected="selected"';}?>>
                    <?php echo $item3['building'];?>
                </option>
<?php endforeach; ?>
<?php endif; ?>				
</select>  
<select id="status" name="status">
<option value="全部">全部</option>
<?php if( is_array( $arr5 ) ): ?>
<?php foreach(  $arr5 as $item5 ): ?>  			
                <option value="<?php echo $item5['status'];?>" <?php if($item5['status']==$_COOKIE["status1"]){echo 'selected="selected"';}?>>
                    <?php echo $item5['status'];?>
                </option>
<?php endforeach; ?>
<?php endif; ?>	
</select> 
<input name="sub" type="submit" class="buttom" value="检索"/>
</form>  
    <table cellspacing="0" cellpadding="0">
      <tr>      
	            <th class="table-title">ID</th>
				<th class="table-title">单元</th>
				<th class="table-title">楼栋</th>
				<th class="table-title">房间</th>
				<th class="table-title">提交时间</th>
				<th class="table-title">报修人</th>
				<th class="table-title">联系方式</th>
				<th class="table-title">处理状态</th>
				<th class="table-title">承修人</th>
				<th class="table-title">操作</th>
				<th class="table-title">删除</th>
      </tr>
<?php
   $role=$_COOKIE["role"];
   $pagesize=20;
	if($_GET[page]){
	$pageval=$_GET[page];
	$page=($pageval-1)*$pagesize;
	$page.=',';
	}
   $sql = "SELECT * FROM `info` where region='".$role."' order by `id` desc ";
   if($_COOKIE["building"]=="所有楼栋"&&$_COOKIE["status1"]=="全部"){
   $sql = "SELECT * FROM `info` where region='".$role."' order by `id` desc "; 
   }
   if($_COOKIE["building"]=="所有楼栋"&&$_COOKIE["status1"]!=="全部"&&$_COOKIE["status1"]!="")
   {
   $sql = "SELECT * FROM `info` where status='".$_COOKIE["status1"]."'&& region='".$role."' order by `id` desc "; 
   }
   if($_COOKIE["building"]!=="所有楼栋"&&$_COOKIE["building"]!=""&&$_COOKIE["status1"]=="全部")
   {
   $sql = "SELECT * FROM `info` where building='".$_COOKIE["building"]."'&& region='".$role."' order by `id` desc "; 
   }
   if($_COOKIE["building"]!=="所有楼栋"&&$_COOKIE["building"]!=""&&$_COOKIE["status1"]!=="全部")
   {
   $sql = "SELECT * FROM `info` where building='".$_COOKIE["building"]."' && status='".$_COOKIE["status1"]."'&& region='".$role."' order by `id` desc "; 
   }
  $sql2 = $sql." limit $page $pagesize"; 
   $result2 = mysql_query($sql2);
   while($row2 = mysql_fetch_array($result2))
         {
        $arr2[]=$row2;
          }	
?>
<?php if( is_array( $arr2 ) ): ?>
<?php foreach(  $arr2 as $item ): ?>  
            <tr>
              <td><?php echo $item['id'];?></td>
              <td><?php echo $item['region'];?></td>
			   <td><?php echo $item['building'];?></td>
              <td><?php echo $item['dorm'];?></td>
              <td><?php echo $item['time'];?></td>
              <td><?php echo $item['author'];?></td>
			  <td><?php echo $item['tel'];?></td>
			  <td><?php echo $item['status'];?></td>
			  <td><?php echo $item['worker'];?></td>
    		 <td><a href="edit-info.php?id=<?php echo $item['id'];?>">操作</a></td>
    		 <td><a href="del-info.php?id=<?php echo $item['id'];?>">删除</a></td>
           </tr>
 <?php endforeach; ?>
	<?php endif; ?>
    </table>
      
<?php     
require_once("../db.php"); 
$url=$_SERVER["REQUEST_URI"];
$url=parse_url($url);
$url=$url[path];
$result = mysql_query($sql);
   while($row = mysql_fetch_array($result))
         {
        $arr[]=$row;
          }	
$num = count($arr);

include "pager.class.php";    
$CurrentPage=isset($_GET['page'])?$_GET['page']:1;    
$myPage=new pager($num,intval($CurrentPage),$pagesize=20);     
$pageStr= $myPage->GetPagerContent();    
echo $pageStr;           
?>       
<div align="right">
    <input name="sub" type="submit" class="buttom"  onClick="location.href='csv-info.php'" value="导出表单"/>
      </div>
<?php include("footer.php") ?>

</body>
</html>
