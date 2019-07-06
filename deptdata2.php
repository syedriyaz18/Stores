

<?php 
session_start();
$_SESSION['tbl'] = dept_tbl;
$_SESSION['url'] = deptdata2;
include('header.php');

?>

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
											        url:"dept_config.php?",
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
<script>
function isKeyPressed(event)
{
if (event.ctrlKey==1)
  {
  alert("The CTRL key was pressed!");
  }
else
  {
  alert("The CTRL key was NOT pressed!");
  }
}

</script>

</head>

<body>
<div id="page_content">
<div class="row-fluid">
    <div class="span12">
<div class="alert alert-success"><center>Department's Data (Press Enter to Save Edited Data)</center></div>
<div style="background: #286397;">
<center>
<?php
foreach (range('A', 'Z') as $i)
{
 echo '<a href="deptdata2.php?alphabet='.$i.'">'.$i.'</a> | ';
 
}
?>
</center
</div>
<table class="imagetable" align="center"> 

<tr class="heading" bgcolor="#ccc">
	<th>SNo</th>
    <th>Block Name</th>
    <th>Department Name</th>
    <th>Room Name</th>
	<th>Room No</th>
	<th>Delete</th>
</tr>


<?php

    //include('config.php');
	
	//$result = get_data();
	$alphabet	=	$_GET['alphabet'];
if($alphabet)
{
	$query	=	"SELECT * FROM dept_tbl WHERE dept_name LIKE '".$alphabet."%' ORDER BY dept_name";
}
else
{
	$query	=	"SELECT * FROM dept_tbl ORDER BY dept_name";
}
$result	=	mysql_query($query);
if(mysql_num_rows($result)>0)
{   
$i=0;
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
		
		?>
		<td><?php echo (++$i) ?></td>
		<?php echo
		'<td style="display:none;">'.$rows["dept_id"].'</td>
    	<td class="edit block_name '.$rows["dept_id"].'">'.$rows["block_name"].'</td>
        <td class="edit dept_name '.$rows["dept_id"].'">'.$rows["dept_name"].'</td>
        <td class="edit room_name '.$rows["dept_id"].'">'.$rows["room_name"].'</td>
		 <td class="edit room_no '.$rows["dept_id"].'">'.$rows["room_no"].'</td>
		 <td><a href="##deletedata.php?rownum='.$rows['dept_id'].'"onClick="javascript:return confirm(\'Are you sure you want to delete '.$rows["dept_name"].' from record?\')">x</a></td>
        </tr>';
	}
	}
	else
{
?>
<center><h3 style="color:#F00;">We Have No Results for Alphabet starting with "<?php echo $_REQUEST['alphabet'];?>"</h3></center>
<?php 
}
?>



</table>

</div>


</body>
<hr />
<?php 
include('footer.php');
?>
       
</html>
