<?php 
include('header.php');
?>
<body>
<br><br>

 
	<div class="container">
	    <div class="row-fluid">
    <div class="span6">
	<div class="alert alert-success">Login</div>
	   <form class="form-horizontal" method="POST">
    <div class="control-group">
    <label class="control-label" for="inputEmail">Username<span class="required"></span></label>
    <div class="controls">
    <input type="text" id="inputEmail" name="username" placeholder="Username" required>
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">Password<span class="required"></span></label>
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
	
	$login=mysql_query("select * from user_tbl where user_name='$username' and user_password='$password'")or die(mysql_error());
	$count=mysql_num_rows($login);
	$info = mysql_fetch_array( $login );
	 
	if ($count > 0 && $info['role']==1 ){
	//Print "<b>Name:</b> ".$info['role'] . " "; 
	header('location:../home.php');
	}else{ ?>
	<div class="alert alert-error">Error login! Please check your username or password</div>
	<?php
	}}
	?>
	
    </div>
	
    </form>
	</div>
	
	
	
	
	
	
	
	
	
    <div class="span6">
		<div class="alert alert-success">Register User</div>
	<form class="form-horizontal" method="POST">
    <div class="control-group">
    <label class="control-label" for="inputEmail">Username<span class="required"></span></label>
	
    <div class="controls">
    <input type="text" id="inputEmail" name="run" placeholder="Username" required>
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">Password<span class="required"></span></label>
    <div class="controls">
    <input type="text" id="inputPassword" name="rp" placeholder="Password" required>
    </div>
    </div>
	<div class="control-group">
    <label class="control-label" for="inputPassword">Role<span class="required"></span></label>
    <div class="controls">
    
	<select name="rp1" placeholder="Role" required>
  <option value="1">Admin</option>
  <option value="4">Admin User</option>
  <option value="2">Master User</option>
  <option value="3">User</option>
 
</select> 
    </div>
    </div>
    <div class="control-group">
    <div class="controls">
    <button type="submit" name="register" class="btn btn-info">Save</button>
    </div>
    </div>
    </form>
	
	    <table class="table table-bordered">
    	<div class="alert alert-success">Data from Database</div>
    <thead>
    <tr>
    <th>Username</th>
    <th>Password</th>
    </tr>
    </thead>
    <tbody>
	<?php 
	$query=mysql_query("select * from user_tbl")or die(mysql_error());
	while($row=mysql_fetch_array($query)){
	
	?>
    <tr>
    <td><?php echo $row['user_name']; ?></td>
    <td><?php echo $row['user_password']; ?></td>

    </tr>
	<?php } ?>
    </tbody>
    </table>
	
	</div>
    </div>
	</div>
	
	
	<?php
	if (isset($_POST['register'])){
	$run=$_POST['run'];
	$rp=md5($_POST['rp']);
	$rp1=$_POST['rp1'];
	mysql_query("insert into user_tbl (user_name,user_password,role) values('$run','$rp','$rp1')")or die(mysql_error());
	header('location:index.php');
	
	}
	?>

</body>
</html>