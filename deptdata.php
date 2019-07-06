<?php 
include('header.php');
?>

<script src="./JScript/bootstrap.min.js"></script>
<div id="page_content">

	
	
    <div class="right">
   <table class="table table-striped table-bordered span5" width="90%">
 <thead>
 <th>ID</th>
 <th>Block Name</th>
 <th>Department Name</th>
 <th>Room Name</th>
 <th>Room No</th>
 
 </thead>
   <?php 
   $conn=mysql_connect('localhost','root','root');
mysql_select_db("nims_store",$conn);

$query1 = "select * from dept_tbl";
$get=mysql_query($query1);
while($row=mysql_fetch_array($get)){
   ?>
 <tr>
 <td><?php echo $row['sno'] ?></td>
 <td><?php echo $row['block_name'] ?></td>
 <td><?php echo $row['dept_name'] ?></td>
 <td><?php echo $row['room_name'] ?></td>
 <td><?php echo $row['room_no'] ?></td>
 
 </tr>
   <?php }?>
   <tr>
   <td colspan="7"><a href="adddepartment.php" class="btn btn-primary">Add Entry</a></td>
   </tr>
</table>
    
</div>
</div>
    </body>
	<hr />
<?php 
include('footer.php');
?>
       
</html>
