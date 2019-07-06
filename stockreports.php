<?php 
include('header.php');
$pdo = new PDO("mysql:host=localhost;dbname=nims_store;charset=utf8", "root", "root");
?>
<link rel="stylesheet" type="text/css" media="all" href="./Styles/table.css" />
<div id="page_content">
<div class="row-fluid">
    <div class="span12">
	<div class="alert alert-success"><center>Current Stock Items</center></div>
	
	
<div style="background: #286397;">
<center>
<?php
foreach (range('A', 'Z') as $i)
{
 echo '<a href="stockreports.php?alphabet='.$i.'">'.$i.'</a> | ';
 
}
?>
</center
</div>
<?php
	$alphabet	=	$_GET['alphabet'];
if($alphabet)
{
	$query	=	"SELECT distinct(s.stocks_id),i.item_name,s.quantity FROM stocks_tbl s,item_tbl i WHERE s.item_id=i.item_id and i.item_name LIKE '". $alphabet."%' ORDER BY i.item_name";
}
else
{
	$query	=	"SELECT s.item_id,s.stocks_id,i.item_name,s.quantity FROM stocks_tbl s,item_tbl i WHERE s.item_id=i.item_id ORDER BY i.item_name";
}
$res	=	mysql_query($query);
?>

<table class="imagetable" align="center">
<tr>
	<th>S.No</th><th>Item Id</th><th>Item Name</th><th>Quantity</th>
</tr>
<?php  
if(mysql_num_rows($res)>0)
{   
$i=0;
while($row=mysql_fetch_array($res))
{
?>
<tr>
	<td><?php echo (++$i) ?></td><td><?php echo $row['item_id'];?></td><td><?php echo $row['item_name'];?></td><td><?php echo $row['quantity'];?></td>
</tr>
 
<?php 
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

<hr />
<?php 
include('footer.php');
?>
</body>


       
</html>