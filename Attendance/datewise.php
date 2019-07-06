
<?php 
include('header.php');

?>


<link rel="stylesheet" type="text/css" media="all" href="./datepicker/jsDatePick_ltr.min.css" />
         <script type="text/javascript" src="./datepicker/jquery.1.4.2.js"></script>
		<script type="text/javascript" src="./datepicker/jsDatePick.jquery.min.1.3.js"></script>
		<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField1",
			dateFormat:"%Y-%m-%d",
			limitToToday:true
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		
		new JsDatePick({
			useMode:2,
			target:"inputField2",
			dateFormat:"%Y-%m-%d",
			limitToToday:true
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		
	};
</script>
<link rel="stylesheet" type="text/css" media="all" href="./Styles/table.css" />
<script src=".//bootstrap.min.js"></script>
<div id="page_content">

<div class="row-fluid">
    <div class="span12">
	<div class="alert alert-success"><center>Attendance In/Out Reports</center></div>
	<form class="form-horizontal" action="" method="post" >


<label class="control-label">Select Date</label>
<input type="text" id="inputField1" name="regdate1"  />
<div class="alert alert-success"><center><button type="submit" name="viewdata" class="btn">View</button></center></div>

<?php
if(isset($_POST['viewdata'])){
$regdate1=$_POST['regdate1'];	
//$regdate2=$_POST['regdate2'];
	$query	= "SELECT a.emp_name, d.dept_name, b.reg_date, MIN( b.reg_time ) AS intime, MAX( b.reg_time ) AS outtime,TIMEDIFF( MAX( b.reg_time ) , MIN( b.reg_time ) ) AS Attendance FROM nims_user_ids a JOIN nims_attendance b ON a.emp_id = b.emp_id JOIN emp_dept d ON a.dept_id = d.dept_id WHERE b.reg_date ='".$regdate1."' AND a.status =1 GROUP BY a.emp_id order by a.dept_id";
	$res	=	mysql_query($query);	
?>

<table class="imagetable" align="center">
<tr>
	<th>S.No</th><th>Employee Name</th><th>Department Name</th><th>Reg. Date</th><th>In Time</th><th>Out Time</th><th>Attendance</th>
</tr>
<?php  
if(mysql_num_rows($res)>0)
{   
$i=0;
while($row=mysql_fetch_array($res))
{
?>
<tr>
	<td><?php echo (++$i) ?></td><td><?php echo $row['emp_name'];?></td><td><?php echo $row['dept_name'];?></td><td><?php echo $row['reg_date'];?></td><td><?php echo $row['intime'];?></td><td><?php echo $row['outtime'];?></td><td><?php echo $row['Attendance'];?></td>
</tr>
 
<?php 
}
}
else
{
?>
<center><h3 style="color:#F00;">We Have No Results for Selected Date "<?php echo $regdate1;?>" and "<?php echo $regdate2;?>" </h3></center>
<?php 
}
}
?>


</table>



</div>
</div>
</div>
</form>
</body>
<hr />
<?php 
include('footer.php');
?>
       
</html>