<?php 
ob_start();
include('dbcon.php');
$randomnumber1=date("dmyHMSYMDhms");

?>

<link href="Styles/loginpage.css" rel='stylesheet' type='text/css' />
		
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<div class="container">
 
 <div class="login">
					<div class="head">
						<img src="images/logo.jpg" alt=""/>
						
					</div>
				<form method="post">
					<li>
						<input type="text" class="text" name="username" value="" placeholder="Username/Email" ><a href="#" class=" icon user"></a>
					</li>
					<li>
						<input type="password" name="password" value="" placeholder="Password"><a href="#" class=" icon lock"></a>
					</li>
					<div class="p-container">
								
								<input type="submit" name="login" value="SIGN IN" >
								
							<div class="clear"> </div>
					</div>
				</form>
			</div>
			<!--//End-login-form-->
		  <!-----start-copyright---->
   					<div class="copy-right">
						<p><a      href="http://shahisolutions.com">Shah iSolutions</a></p>
					</div>
				<!-----//end-copyright---->
 
 
	  
	
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
	header('location:sms/home.php?valran='.$randomnumber1);
	}
	
	else{ ?>
	<div class="err">Error login! Please check your username or password</div>
	<?php
	}}
	?>
	
   
</body>
<hr />

       
</html>
