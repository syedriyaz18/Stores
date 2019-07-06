<?php 
include('header.php');
?>
<div id="page_content">
<div class="row-fluid">
    <div class="span6">
	<div class="alert alert-success">Add Unit's Data</div>
     <form class="span4" action="" method="post">
     
  <fieldset>
   

   <label>Unit Name <span class="required">*</span></label>
    <input type="text" name="unitname" placeholder="Unit Name">
     <label>Quantity<span class="required">*</span></label>
      <input type="text" name="quantity" placeholder="Quantity">
     
    <br/>
   

         <?php
if(isset($_POST['insertdata'])){
$conn=mysql_connect('localhost','root','');
mysql_select_db("nims_store",$conn);

$unitname=$_POST['unitname'];
//$text = trim($_POST['address']);
//$text = nl2br($text);
//$deptname=$_POST['address'];
$quantity=$_POST['quantity'];



if(empty($unitname) || empty($quantity)  ){
	echo "<label class='err'>All fields are required</label>";
	}
elseif(!is_numeric($quantity)){
	echo "<label class='err'>MobileNo must be numeric</label>";
	}


		else{
$insert="Insert into nims_store.unit_tbl(unit_name,quantity)
 values('".$unitname."','".$quantity."')";

$rs=mysql_query($insert) or die(mysql_error());

?>
<script>alert('Data Entry Saved!');</script>
<?php }
}
 ?>
<br/>    
<div class="alert alert-success"><button type="submit" name="insertdata" class="btn">Submit</button></div>
<a href="unitdata.php" class="btn btn-primary">View Data</a>
  </fieldset>
</form>

   
   <?php 
   function save(){
	
	
	}
   ?>


</div>
</div>

</div>
</body>
<hr />
<?php 
include('footer.php');
?>
       
</html>