<?php 
include('header_md5.php');
include("session/DBConnection.php");

?>


<title>Welcome To DesiTalk</title>
<link rel="stylesheet" href="./DTStyles/stickyheader.css" />
<link rel="stylesheet" href="js/prettyphoto/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<link type='text/css' href='./css1/basic.css' rel='stylesheet' media='screen' />
	<link rel="stylesheet" type="text/css" href="./css/style.css" />
	<link rel="stylesheet" type="text/css" href="./css/ppic.css" />	
<!-- Metadescription and MetaKeyWords are used for SEO -->
<meta content="description" name="Social networking" />
<meta content="KeyWords" name="desitalk,login,sign up,chat,message,photos,groups,friends,email" />
</head>
<script type="text/javascript" src="./DTJScript/jquery-1.9.1.js"></script>
<script type="text/javascript" src="./DTJScript/stickyheader.js"></script>

<script type="text/javascript" src="./Jscript/jquery.js"></script>
<script type="text/javascript" src="./Jscript/jquery.watermarkinput.js"></script>

</head>
<body>


  <div id="demo_wrapper">
    <div id="logo">
       <h2>DesiTalk</h2>
       
    </div>
    <div id="stickyribbon">
    	  
			
			<div class="grid_9">
              <ul class="sf-menu">
                <li> <a class="current" href="home.php">Home</a> </li>
         
                      
                      <li><a class="current" href="info.php">Profile</a></li>
                      <li><a href="photos.php">My Photos</a></li>
                
                
                <li> <a href="friends.php">Friends
                  <?php
	$user = $_SESSION['log']['username'];
$result = mysql_query("SELECT * FROM friends WHERE friend = '" . $user ."' and status = 'requesting'");
	
	$numberOfRows = MYSQL_NUMROWS($result);	 
				if ($numberOfRows > 0 )
				  echo '<font size="2" color="red">' . $numberOfRows .'</font>' ;
				else
    			 echo " ";	
				?>
                </a> </li>
                <li> <a href="mail.php">EMails
                  <?php
$user = $_SESSION['log']['username'];
$status = 'unread';
$result = mysql_query("SELECT * FROM messages WHERE recipient='" . $user."' AND status='$status'");
	
	$numberOfRows = MYSQL_NUMROWS($result);	
	if($numberOfRows > 0){
	echo '<font size="1" color="red"><b>' . $numberOfRows .'</b></font>';} 
	?>
                </a> </li>
              
              </ul>
			
            </div>
			
	  
       
   </div>
   <div id="page_content">
  
