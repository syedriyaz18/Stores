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
	<div class="alert alert-success">Leaves application form</div>
     <form class="span4" action="" method="post">
     
  <fieldset>
   <table>
<tr>
<td>EmployeeName:</td>
                   <td>
                         <select id="emp_id" name="emp_id">
                            <option value="">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT emp_name,emp_id,d_id FROM nims_emp_ids where emp_status=1 order by dept_id ");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['emp_id'],$row ['d_id']; ?>"><?php echo $row ['emp_id']; echo"----";  echo $row ['emp_name'];  ?></option><?php
                            }
                        ?>
                        </select>
</td>
</tr>	
<tr>
<td>
   <label>No Of Days<span class="required">*</span>:</label></td>
    <td><input type="text" name="noofdays" id="noofdays" placeholder="No Of Days" style="width: 100px;"></td>
	</tr>
	<tr><td>DateFrom:</td>
<td><input type="text" id="inputField1" name="fromdate"  /></td>
<td>ToDate:</td>
<td><input type="text" id="inputField2" name="todate"  /></td>
</table>     
     
    <br/>
   

         <?php
if(isset($_POST['insertdata'])){
$conn=mysql_connect('localhost','root','root');
mysql_select_db("nims_store",$conn);

$itemname=$_POST['itemname'];
//$text = trim($_POST['address']);
//$text = nl2br($text);
$noofdays=$_POST['noofdays'];
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$emp_id=$_POST['emp_id'];

$d_id = substr($emp_id,4,2);
$emp_id = substr($emp_id,0,4);

if(empty($noofdays) ){
	echo "<label class='err'>All fields are required</label>";
	}



		else{
$insert="Insert into nims_store.nims_emp_leaves(emp_id,noofdays,fromdate,todate,d_id)
 values('".$emp_id."','".$noofdays."','".$fromdate."','".$todate."','".$d_id."')";

$rs=mysql_query($insert) or die(mysql_error());

?>
<script>alert('Data Entry Saved!');</script>
<?php }
}
 ?>
<br/>    
<div class="alert alert-success"><button type="submit" name="insertdata" class="btn">Apply</button></div>

  </fieldset>
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