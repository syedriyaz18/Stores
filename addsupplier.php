<?php 


include('header.php');
?>
<div id="page_content">
<div class="row-fluid">
    <div class="span6">
	<div class="alert alert-success">Add Supplier's Data</div>
     <form class="span4" action="" method="post">
     
  <fieldset>
   

   <label>Supplier Name <span class="required">*</span></label>
    <input type="text" name="suppliername" id="suppliername" placeholder="Supplier Name">
     <label>Suuplier Address<span class="required">*</span></label>
     <textarea class="FormElement" name="address" id="address" cols="40" rows="4" placeholder="Address"></textarea>
     <label>Supplier Mobile<span class="required">*</span></label>
     <input type="text" name="mobile" placeholder="Mobile No">
     
    <br/>
   

         <?php
if(isset($_POST['insertdata'])){
$conn=mysql_connect('localhost','root','');
mysql_select_db("nims_store",$conn);

$suppliername=$_POST['suppliername'];
$text = trim($_POST['address']);
$text = nl2br($text);
//$deptname=$_POST['address'];
$mobile=$_POST['mobile'];



if(empty($suppliername) || empty($text) || empty($mobile) ){
	echo "<label class='err'>All fields are required</label>";
	}



		else{
$insert="Insert into nims_store.supplier_tbl(supplier_name,supplier_address,supplier_mobile)
 values('".$suppliername."','".$text."','".$mobile."')";

$rs=mysql_query($insert) or die(mysql_error());

?>
<script>alert('Data Entry Saved!');</script>
<?php }
}
 ?>
<br/> <div class="alert alert-success">   <button type="submit" name="insertdata" class="btn">Submit</button></div>
<a href="suppdata.php" class="btn btn-primary">View Data</a>
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
			 $('#suppliername').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url : './auto/autoajax.php',
		      			dataType: "json",
						data: {
						   name_startsWith: request.term,
						   type: 'supplier'
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
					$('#suppliername').html(ui.item.value);
				},
		      	select: function( event, ui ) {
					$('#suppliername').html(ui.item.value);
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