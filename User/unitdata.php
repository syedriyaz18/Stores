

<?php 
session_start();
$_SESSION['tbl'] = unit_tbl;
$_SESSION['url'] = unitdata;
include('header.php');

?>
<link rel="stylesheet" type="text/css" href="./Styles/style.css" />
<script src="./JScript/jquery.js" type="text/javascript"></script>

<script>

	$(document).ready(function(){
									
									
									
		$('td.edit').dblclick(function(){
							 
							   			
							            $('.ajax').html($('.ajax input').val());
							            $('.ajax').removeClass('ajax');
										
										$(this).addClass('ajax');
								  		$(this).html('<input id="editbox" size="'+$(this).text().length+'" type="text" value="' + $(this).text() + '">');
										
										$('#editbox').focus();
								        
								  }
						 
						 
						 
						 
						 );
					  
		$('td.edit').keydown(function(event){
									  
									  
									 arr = $(this).attr('class').split( " " );
									 
									 
									 if(event.which == 13)
									 { 
								  		
								  		$.ajax({    type: "POST",
											        url:"config.php?",
													data: "value="+$('.ajax input').val()+"&rownum="+arr[2]+"&field="+arr[1],
													success: function(data){
														 $('.ajax').html($('.ajax input').val());
							                             $('.ajax').removeClass('ajax');
													}});
									 }
								  
								  }
						 
						 
						 
						 
						 );
		
		
		$('#editbox').live('blur',function(){

									 $('.ajax').html($('.ajax input').val());
							         $('.ajax').removeClass('ajax');
									});
									
		
	
	});


</script>


</head>

<body>
<div id="page_content">

<div class="alert alert-success"><center>Unit's Data  (Press Enter to Save Edited Data)</center></div>
<div style="background: #286397;">
<center>
<?php
foreach (range('A', 'Z') as $i)
{
 echo '<a href="unitdata.php?alphabet='.$i.'">'.$i.'</a> | ';
 
}
?>
</center
</div>
<table cellpadding="10"> 

<tr class="heading" bgcolor="#ccc">
	<th>SNo</th>
    <th>Unit Name</th>
    <th>Quantity</th>
    
	<th>Delete</th>
</tr>


<?php

    //include('config.php');
	
	//$result = get_data();
	$alphabet	=	$_GET['alphabet'];
if($alphabet)
{
	$query	=	"SELECT * FROM unit_tbl WHERE unit_name LIKE '".$alphabet."%' ORDER BY unit_name";
}
else
{
	$query	=	"SELECT * FROM unit_tbl ORDER BY unit_name";
}
$result	=	mysql_query($query);
	while($rows = mysql_fetch_array($result))
	{
		if($alt == 1)
		{
		   echo '<tr class="alt">';
		   $alt = 0;
		}
		else
		{
		   echo '<tr>';
		   $alt = 1;
		}
		
		echo 
		'<td>'.$rows["sno"].'</td>
    	<td class="edit unit_name '.$rows["sno"].'">'.$rows["unit_name"].'</td>
        <td class="edit quantity '.$rows["sno"].'">'.$rows["quantity"].'</td>
       
		 <td><a href="deletedata.php?rownum='.$rows['sno'].'">x</a></td>
        </tr>';
	}
?>


</table>

</div>


</body>
<hr />
<div style="background: #286397;">
          <p>Shah Technologies <small>&copy;&nbsp; All rights reserved. | <a href="copyright.php">Copyright</a> | <a href="terms.php">Terms and Conditions</a> | <a href="privacy.php">Privacy Policy</a> | <a class="current" href="about.php">About Us</a></small></p>
       </div>
       
</html>
