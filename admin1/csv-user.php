<?php

header("Content-type:application/vnd.ms-excel");

header("Content-Disposition:filename=member.xls");

?>

<table cellspacing="0" cellpadding="0">
      <tr>      
	            <th class="table-title">ID</th>
				<th class="table-title">����</th>
				<th class="table-title">��ϵ��ʽ</th>
				<th class="table-title">Է��</th>
				<th class="table-title">¥��</th>
				<th class="table-title">����</th>
				<th class="table-title">ע��ʱ��</th>
      </tr>
 <?php
   $role=$_COOKIE["role"];
   require_once("../db.php"); 
   $sql = "SELECT * FROM `user` where region like '%$role%' order by `id` desc ";
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
              <td><?php echo $item['name'];?></td>
              <td><?php echo $item['tel'];?></td>
              <td><?php echo $item['region'];?></td>
			  <td><?php echo $item['building'];?></td>
              <td><?php echo $item['dorm'];?></td>
              <td><?php echo $item['regtime'];?></td>
           </tr>
 <?php endforeach; ?>
	<?php endif; ?>
    </table>