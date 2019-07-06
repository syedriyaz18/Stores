<?php 
include('header.php');
?>


<div id="page_content">

<div class="row-fluid">
    <div class="span6">
	<div class="alert alert-success">Add Department's Data</div>
     <form class="span4" action="" method="post">
     
  <fieldset>
   

   <label>Block Name <span class="required">*</span></label>
    <input type="text" name="blkname" placeholder="Block Name">
     <label>Department Name<span class="required">*</span></label>
	 <input type="text" name="deptname" id="deptname" placeholder="Department Name">
     <label>Room Name<span class="required">*</span></label>
     <input type="text" name="roomname" placeholder="Room Name">
     <label>Room No<span class="required">*</span></label>
     <input type="text" name="rno" class="input-small" placeholder="Room No">
    <br/>
   

         <?php
if(isset($_POST['insertdept'])){
$conn=mysql_connect('localhost','root','');
mysql_select_db("nims_store",$conn);

$blkname=$_POST['blkname'];
$deptname=$_POST['deptname'];
$roomname=$_POST['roomname'];
$rno=$_POST['rno'];


if(empty($blkname) || empty($deptname) || empty($roomname) || empty($rno) ){
	echo "<label class='err'>All fields are required</label>";
	}


		else{
$insert="Insert into nims_store.dept_tbl(block_name,dept_name,room_name,room_no)
 values('".$blkname."','".$deptname."','".$roomname."','".$rno."')";

$rs=mysql_query($insert) or die(mysql_error());

?>
<script>alert('Data Entry Saved!');</script>
<?php }
}
 ?>
<br/>
   <div class="alert alert-success">
<button type="submit" name="insertdept" class="btn">Submit</button></div>
<a href="deptdata2.php" class="btn btn-primary">View Data</a>

  </fieldset>
</form>

   
   <?php 
   function save(){
	
	
	}
   ?>






</div>
</div>
 
<script>
			 $('#deptname').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url : './auto/autoajax.php',
		      			dataType: "json",
						data: {
						   name_startsWith: request.term,
						   type: 'dept'
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
					$('#deptname').html(ui.item.value);
				},
		      	select: function( event, ui ) {
					$('#deptname').html(ui.item.value);
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