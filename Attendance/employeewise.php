
<?php 
include('header.php');
$pdo = new PDO("mysql:host=localhost;dbname=nims_store;charset=utf8", "root", "root");
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
<table>
<tr>
<td>Employee Name</td>
                   <td>
                         <select id="emp_id" name="emp_id">
                            <option value="">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT emp_name,emp_id,d_id,dept_id FROM nims_emp_ids where emp_status=1 order by dept_id ");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['emp_id'],$row ['d_id'],$row['dept_id']; ?>"><?php echo $row ['emp_id']; echo"----";  echo $row ['emp_name'];  ?></option><?php
                            }
                        ?>
                        </select>
</td>
</tr>	
<br/>
<tr><td>Date From</td>
<td><input type="text" id="inputField1" name="regdate1"  /></td>
<td>To Date</td>
<td><input type="text" id="inputField2" name="regdate2"  /></td>

<tr><td colspan="5"> <div class="alert alert-success"><center><button type="submit" name="viewdata" class="btn">View</button></center></div>
</td></tr>
</table>
<?php
if(isset($_POST['viewdata'])){
$regdate1=$_POST['regdate1'];	
$regdate2=$_POST['regdate2'];
$start = new DateTime($regdate1);
$end = new DateTime($regdate2);
$days = $start->diff($end, true)->days;
$sundays = intval($days / 7) + ($start->format('N') + $days % 7 >= 7);

$emp_id=$_POST['emp_id'];
$dept_id = substr($emp_id,-1);
$d_id = substr($emp_id,4,2);
$emp_id = substr($emp_id,0,4);

echo $d_id;echo"////";
echo $emp_id;echo"////";
echo $dept_id;

	$query0 = "SELECT a.emp_name,d.dept_name from nims_emp_ids a join emp_dept d on a.dept_id=d.dept_id where a.emp_id='".$emp_id."' and a.d_id='".$d_id."' ";
	$res0	=	mysql_query($query0);
	
	if($dept_id == 1 or $dept_id == 2)
	{
		$query	= "SELECT b.reg_date, (CASE WHEN  MIN( b.reg_time ) <= '13:15:00' THEN MIN( b.reg_time ) ELSE '--' END)  AS intime,(CASE WHEN MAX( b.reg_time )>='15:00:00' THEN MAX( b.reg_time ) ELSE '--' END) AS outtime, TIMEDIFF( MAX( b.reg_time ) , MIN( b.reg_time ) ) AS hours, (CASE WHEN TIMEDIFF( MAX( b.reg_time ) , MIN( b.reg_time ) ) <= '06:00:00' THEN '0.5' ELSE '1' END) as attendance FROM nims_emp_ids a JOIN nims_attendance b ON a.emp_id = b.emp_id WHERE b.reg_date >='".$regdate1."' and b.reg_date <= '".$regdate2."' and a.emp_id = '".$emp_id."' and b.t_id='".$d_id."' group by b.reg_date";
		$res	=	mysql_query($query);
	}
	else
	{
		$query	= "SELECT b.reg_date, (CASE WHEN  MIN( b.reg_time ) <= '13:15:00' THEN MIN( b.reg_time ) ELSE '--' END)  AS intime,(CASE WHEN MAX( b.reg_time )>='15:00:00' THEN MAX( b.reg_time ) ELSE '--' END) AS outtime, TIMEDIFF( MAX( b.reg_time ) , MIN( b.reg_time ) ) AS hours, (CASE WHEN TIMEDIFF( MAX( b.reg_time ) , MIN( b.reg_time ) ) <= '08:00:00' THEN '0.5' ELSE '1' END) as attendance FROM nims_emp_ids a JOIN nims_attendance b ON a.emp_id = b.emp_id WHERE b.reg_date >='".$regdate1."' and b.reg_date <= '".$regdate2."' and a.emp_id = '".$emp_id."' and b.t_id='".$d_id."' group by b.reg_date";
		$res	=	mysql_query($query);
	}
	
	$queryleaves = "select * from nims_emp_leaves where emp_id = '".$emp_id."' and d_id='".$d_id."'";
		$resleaves	=	mysql_query($queryleaves);
		if(mysql_num_rows($resleaves)>0)
		{
			$noofdays=1;
			
		}
		else
		{
			$noofdays=0;
		}
		
		
?>
<table class="imagetable" align="center">
<tr>
	<th>Employee Name</th><th>Thumb ID</th><th>Department Name</th>
</tr>
<?php  
if(mysql_num_rows($res0)>0)
{  
while($row0=mysql_fetch_array($res0))
{
?>
<tr>
	<td><?php echo $row0['emp_name'];?></td><td><?php echo $emp_id;?></td><td><?php echo $row0['dept_name'];?></td>
</tr>
<?php
}
}
?>
<table class="imagetable" align="center">
<tr>
	<th>S.No</th><th>Punch. Date</th><th>In Time</th><th>Out Time</th><th>Hours</th><th>Attendance</th>
</tr>

<?php  
if(mysql_num_rows($res)>0)
{   
$i=0;
$sum=0;
while($row=mysql_fetch_array($res))
{
?>
<tr>
	<td><?php echo (++$i) ?></td><td><?php echo $row['reg_date'];?></td><td><?php echo $row['intime'];?></td><td><?php echo $row['outtime'];?></td><td><?php echo $row['hours'];?></td><td><?php echo $row['attendance'];?></td>
</tr>
 
<?php 
$sum = $sum + $row['attendance'];
}
$totalpaydays = $sum + $sundays + $noofdays;
?>
<tr>
<td colspan="5" align="center">Total Working Days Attended</td><td><?php echo $sum;?></td>
</tr>
<tr>
<td colspan="5" align="center">Total WeekOFFS (Sundays)</td><td><?php echo $sundays;?></td>
</tr>
<tr>
<td colspan="5" align="center">Casual Leaves (<span class="required">*</span> if applied online)</td><td><?php echo $noofdays;?></td>
</tr>
<tr>
<td colspan="5" align="center">Total Days to be Paid</td><td><?php echo $totalpaydays;?></td>
</tr>
<?php
}
else
{
?>
<center><h3 style="color:#F00;">We Have No Results for Selected Date "<?php echo $regdate1;?>" and "<?php echo $regdate2;?>" for "<?php echo $emp_id;?>"</h3></center>
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