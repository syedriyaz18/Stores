<?php 
ob_start();
include('headerindex.php');
$randomnumber1=date("dmyHMSYMDhms");

?>
<link href="./Styles/login.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="./Styles/stickyheader.css" />

<br/>
<br/>
 <div class="container">
 
 
 
 
   <div class="login">
      <h4>Login to HMS</h4>
      <form method="post">
        <p><input type="text" name="username" value="" placeholder="Username or Email"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p class="remember_me">
          <label>
            <input type="checkbox" name="remember_me" id="remember_me">
            Remember me on this computer
          </label>
        </p>
        <p class="submit"> <button type="submit" name="login" class="btn btn-success">Login</button></p>
		
      </form>
    </div>
	  
	
	<?php
	if (isset($_POST['login'])){
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	
	$login=mysql_query("select * from user_tbl where user_name='$username' and user_password='$password'")or die(mysql_error());
	$count=mysql_num_rows($login);
	$info = mysql_fetch_array( $login );
	if ($count > 0 && $info['role']==2 ){
	session_start();
	$_SESSION['login'] = $username;
	
	$_SESSION['time']     = time();
	header('location:home.php?valran='.$randomnumber1);
	}
	else if($count > 0 && $info['role']==3 ){
	session_start();
	$_SESSION['login'] = $username;
	
	$_SESSION['time']     = time();
	header('location:home.php?valran='.$randomnumber1);
	}
	else if($count > 0 && $info['role']==4 ){
	session_start();
	$_SESSION['login'] = $username;
	
	$_SESSION['time']     = time();
	header('location:sms/home.php?valran='.$randomnumber1);
	}
	else if($count > 0 && $info['role']==5 ){
	session_start();
	$_SESSION['login'] = $username;
	
	$_SESSION['time']     = time();
	header('location:Attendance/home.php?valran='.$randomnumber1);
	}
	
	else{ ?>
	<div class="alert alert-error">Error login! Please check your username or password</div>
	<?php
	}}
	?>
	
   
</body>
<hr />
<?php 
include('footerlogin.php');
?>
       
</html>
