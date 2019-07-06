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


<div id="page_content">
<div class="row-fluid">
    <div class="span9">
	<div class="alert alert-success">Add Employee's Data</div>
     <form class="span4" action="" method="post">
     

  <table>
  <tr>
  <td>
  <label>EmployeeName<span class="required">*</span>:</label></td>
    <td><input type="text" name="empname" id="empname" placeholder="Employee Name" style="width: 200px;">
  </td>
  <td>
  <label>EmployeeID<span class="required">*</span>:</label></td>
    <td><input type="text" name="empid" id="empid" placeholder="Employee ID" style="width: 200px;">
  </td>
  </tr>
  <tr>
   <td>
  <label>Designation<span class="required">*</span>:</label></td>
    <td><input type="text" name="designation" id="designation" placeholder="Designation" style="width: 200px;">
  </td>
 <td>Department:</td>
                   <td>
                         <select id="dept_id" name="dept_id">
                            <option value="">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT dept_name,dept_id FROM emp_dept where dept_status=1 order by dept_id ");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['dept_id']; ?>"><?php echo $row ['dept_name'];  ?></option><?php
                            }
                        ?>
                        </select>
</td>
  </tr>
  <tr><td>BirthDate:</td>
<td><input type="text" id="inputField1" name="dob" placeholder="Date of Birth" /></td>
<td>JoiningDate:</td>
<td><input type="text" id="inputField2" name="doj" placeholder="Date of Joining" /></td>
</tr>
<tr>
  <td>
  <label>EmployeeMobileNo:<span class="required">*</span>:</label></td>
    <td><input type="text" name="mobileno" id="mobileno" placeholder="Employee Mobile No" style="width: 200px;">
  </td>
  <td>
  <label>EmployeeEmialID:<span class="required">*</span>:</label></td>
    <td><input type="text" name="emailid" id="emailid" placeholder="Employee Emil ID" style="width: 200px;">
  </td>
  </tr>
</table>
   
	
     
     
    <br/>
   

         <?php
if(isset($_POST['insertdata'])){
$conn=mysql_connect('localhost','root','root');
mysql_select_db("nims_store",$conn);

$empname=$_POST['empname'];
//$text = trim($_POST['address']);
//$text = nl2br($text);
$empid=$_POST['empid'];
$designation=$_POST['designation'];
$deptid=$_POST['deptid'];
$dob=$_POST['dob'];
$doj=$_POST['doj'];
$mobileno=$_POST['mobileno'];
$emailid=$_POST['emailid'];
$dept_id=$_POST['dept_id'];


if(empty($empname) ){
	echo "<label class='err'>All fields are required</label>";
	}



		else{
if($dept_id == 1 or $dept_id == 2)
	{
		
	$insert="Insert into nims_store.nims_emp_ids(emp_id,emp_name,emp_designation,emp_dob,emp_doj,emp_mobile,emp_emil,d_id,dept_id,emp_status)
	values('".$empid."','".$empname."','".$designation."','".$dob."','".$doj."','".$mobileno."','".$emailid."',51,'".$dept_id."',1)";

	$rs=mysql_query($insert) or die(mysql_error());
	}
	else
	{
		$insert="Insert into nims_store.nims_emp_ids(emp_id,emp_name,emp_designation,emp_dob,emp_doj,emp_mobile,emp_emil,d_id,dept_id,emp_status)
	values('".$empid."','".$empname."','".$designation."','".$dob."','".$doj."','".$mobileno."','".$emailid."',54,'".$dept_id."',1)";

	$rs=mysql_query($insert) or die(mysql_error());
	}

?>
<script>alert('Data Entry Saved!');</script>
<?php }
}
 ?>
<br/>    
<div class="alert alert-success"><button type="submit" name="insertdata" class="btn">Submit</button></div>
<a href="empdata.php" class="btn btn-primary">View Data</a>

</form>

   
   <?php 
   function save(){
	
	
	}
   ?>
</div>
</div>

</div>
<script>
			 $('#itemname').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url : './auto/autoajax.php',
		      			dataType: "json",
						data: {
						   name_startsWith: request.term,
						   type: 'item'
						},
						 success: function( data ) {
							 response( $.map( data, function( item ) {
								return {
									label: item,
									value: item
								}
							}));
						}
		      		});
		      	},
		      	autoFocus: true,
		      	selectFirst: true,
		      	minLength: 0,
		      	focus : function( event, ui ) {
					$('#itemname').html(ui.item.value);
				},
		      	select: function( event, ui ) {
					$('#itemname').html(ui.item.value);
				},
				open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				}		      	
		      });
		</script>
</body>
<hr />
<?php 
include('footer.php');
?>
       
</html>