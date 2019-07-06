<?php 
include('header.php');
?>
<div id="page_content">
<div class="row-fluid">
    <div class="span6">
	<div class="alert alert-success">Add Items's Data</div>
     <form class="span4" action="" method="post">
     
  <fieldset>
   

   <label>Item Name <span class="required">*</span></label>
    <input type="text" name="itemname" id="itemname" placeholder="Item Name" style="width: 430px;">
     
     
    <br/>
   

         <?php
if(isset($_POST['insertdata'])){
$conn=mysql_connect('localhost','root','root');
mysql_select_db("nims_store",$conn);

$itemname=$_POST['itemname'];
//$text = trim($_POST['address']);
//$text = nl2br($text);
//$deptname=$_POST['address'];
//$quantity=$_POST['quantity'];



if(empty($itemname) ){
	echo "<label class='err'>All fields are required</label>";
	}



		else{
$insert="Insert into nims_store.item_tbl(item_name)
 values('".$itemname."')";

$rs=mysql_query($insert) or die(mysql_error());

?>
<script>alert('Data Entry Saved!');</script>
<?php }
}
 ?>
<br/>    
<div class="alert alert-success"><button type="submit" name="insertdata" class="btn">Submit</button></div>
<a href="itemdata.php" class="btn btn-primary">View Data</a>
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