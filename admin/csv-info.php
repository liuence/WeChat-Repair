<?php

header("Content-type:application/vnd.ms-excel");

header("Content-Disposition:filename=info.xls");

?>

<table cellspacing="0" cellpadding="0">
      <tr>      
	            <th class="table-title">ID</th>
				<th class="table-title">苑区</th>
				<th class="table-title">楼栋</th>
				<th class="table-title">寝室</th>
				<th class="table-title">报修内容</th>
				<th class="table-title">提交时间</th>
				<th class="table-title">报修人</th>
				<th class="table-title">联系方式</th>
				<th class="table-title">处理状态</th>
				<th class="table-title">受理人</th>
				<th class="table-title">处理意见</th>
				<th class="table-title">用户评价</th>
				<th class="table-title">承修人</th>
				
      </tr>
 <?php
   require_once("../db.php"); 
   $sql = "SELECT * FROM `info` order by `id` desc ";
   if($_COOKIE["region"]=="所有苑区"&&$_COOKIE["status"]=="全部"){
   $sql = "SELECT * FROM `info` order by `id` desc "; 
   }
   if($_COOKIE["region"]=="所有苑区"&&$_COOKIE["status"]!=="全部"&&$_COOKIE["status"]!="")
   {
   $sql = "SELECT * FROM `info` where status='".$_COOKIE["status"]."' order by `id` desc "; 
   }
   if($_COOKIE["region"]!=="所有苑区"&&$_COOKIE["region"]!=""&&$_COOKIE["status"]=="全部")
   {
   $sql = "SELECT * FROM `info` where region='".$_COOKIE["region"]."' order by `id` desc "; 
   }
   if($_COOKIE["region"]!=="所有苑区"&&$_COOKIE["region"]!=""&&$_COOKIE["status"]!=="全部")
   {
   $sql = "SELECT * FROM `info` where region='".$_COOKIE["region"]."' && status='".$_COOKIE["status"]."' order by `id` desc "; 
   }
   $result = mysql_query($sql);
   while($row = mysql_fetch_array($result))
         {
        $arr[]=$row;
          }	
 ?>
<?php if( is_array( $arr ) ): ?>
<?php foreach(  $arr as $item ): ?>  
            <tr>
              <td><?php echo $item['id'];?></td>
              <td><?php echo $item['region'];?></td>
			  <td><?php echo $item['building'];?></td>
              <td><?php echo $item['dorm'];?></td>
              <td><?php echo $item['content'];?></td>
              <td><?php echo $item['time'];?></td>
              <td><?php echo $item['author'];?></td>
			  <td><?php echo $item['tel'];?></td>
              <td><?php echo $item['status'];?></td>
			  <td><?php echo $item['person'];?></td>
              <td><?php echo $item['explain'];?></td>
			  <td><?php echo $item['review'];?></td>
			  <td><?php echo $item['worker'];?></td>
           </tr>
 <?php endforeach; ?>
	<?php endif; ?>
    </table>