<?php 
ob_start();
include('headerindex.php');

?>

<br/>
<br/>
 <div class="container">
	    <div class="row-fluid">
    <div class="span6">
	<div class="alert alert-success">Login</div>
	   <form class="form-horizontal" method="POST">
    <div class="control-group">
    <label class="control-label" for="inputEmail">Username<span class="required">*</span></label>
    <div class="controls">
    <input type="text" id="inputEmail" name="username" placeholder="Username" required>
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">Password<span class="required">*</span></label>
    <div class="controls">
    <input type="password" name="password" id="inputPassword" placeholder="Password" required>
    </div>
    </div>
    <div class="control-group">
    <div class="controls">
    <button type="submit" name="login" class="btn btn-success">Login</button>
    </div>
	<br>
	
	<?php
	if (isset($_POST['login'])){
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	
	$login=mysql_query("select * from user where username='$username' and password='$password'")or die(mysql_error());
	$count=mysql_num_rows($login);
	$info = mysql_fetch_array( $login );
	if ($count > 0 && $info['role']==1 ){
	session_start();
	$_SESSION['login'] = $username;
	
	$_SESSION['time']     = time();
	header('location:home.php');
	}else{ ?>
	<div class="alert alert-error">Error login! Please check your username or password</div>
	<?php
	}}
	?>
	
    </div>
    </form>
	</div>
	    
   
   
  
   </div>
 

</div>
</body>
<hr />
<?php 
include('footerlogin.php');
?>
       
</html>
