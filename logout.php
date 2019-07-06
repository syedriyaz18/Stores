<?php 
include('headerlogout.php');
$_SESSION['login']="";
session_destroy();


?>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
 <div class="container">
	    <div class="row-fluid">
    <div class="span6">
	<div class="alert alert-success">Successfully Logged Out</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>


<?php 
include('footerlogout.php');
?>