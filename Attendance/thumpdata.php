
<?php 
include('header.php');

?>

        <script src=".//bootstrap.min.js"></script>
<div id="page_content">


<div class="row-fluid">
    <div class="span12">
	<div class="alert alert-success"><center>To Retrieve Attendance Data From Machines</center></div>
	<form class="form-horizontal" action="thumpdata.php" method="post" >
	<div class="alert alert-success"><center><button type="submit" name="viewdata" class="btn">Click Here</button></center></div>
	</form>
<?php
if(isset($_POST['viewdata'])){

exec('C:/Python27/ShahiSolutions/python_zklib-master/ThumpData.py');

}
?>

</div>
</div>

</body>
<hr />
<?php 
include('footer.php');
?>
       
</html>