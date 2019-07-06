<?php 
include('header.php');
$pdo = new PDO("mysql:host=localhost;dbname=nims_store;charset=utf8", "root", "root");
?>
<link rel="stylesheet" type="text/css" media="all" href="./Styles/table.css" />
 <script type="text/javascript">
        $(function() { // This code will be executed when DOM is ready
            $('#item_id').change(function() { // When the value for the Employee_ID element change, this will be triggered
                var $self1 = $(this); // We create an jQuery object with the select inside
                $.post("getstockdata.php", { item_id : $self1.val()}, function(json) {
                    if (json && json.status) {
                        $('#quantity').val(json.quantity);
                        
                    }
                })
            });
		 })	
</script>	
<div id="page_content">
<div class="row-fluid">
    <div class="span12">
	<div class="alert alert-success"><center>Item History</center></div>
	<div> <form class="form-horizontal" action="" method="post" >
	
	<div>
                    <label class="control-label">Item Name</label>
                  
                         <select id="item_id" name="item_id">
                            <option value="">Select one</option>
							 <option value="9885985500">ALL</option>
                            <?php
                            $st = $pdo->prepare("SELECT item_id,item_name FROM item_tbl order by item_name");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['item_id']; ?>"><?php echo $row ['item_id']; echo"----"; echo $row ['item_name']; ?></option><?php
                            }
                        ?>
                        </select>
						</div>
						<div>
						<label class="control-label">Stock</label>
						<input id="quantity" name="quantity" type="text" class="input-small" readonly>
                    </div>
						<div class="alert alert-success"><center><button type="submit" name="viewdata" class="btn">Submit</button></center></div>
					</form>
                </div>
	
	
<div style="background: #286397;">
<center>

<?php
foreach (range('A', 'Z') as $i)
{
 //echo '<a href="stockreports.php?alphabet='.$i.'">'.$i.'</a> | ';
 
}
?>
</center
</div>
<?php
if(isset($_POST['viewdata'])){
$item_id=$_POST['item_id'];
$quantity=$_POST['quantity'];
	$alphabet	=	$_GET['alphabet'];
if($item_id == "9885985500")
{
	
	 $st2 = $pdo->prepare("SELECT item_id FROM item_tbl order by item_name");
     $st2->execute();
     $rows2 = $st2->fetchAll(PDO::FETCH_ASSOC);
     foreach ($rows2 as $row2) {
			$item_id=$row2 ['item_id'];
			$query	=	"SELECT item_id,item_name FROM nims_store.item_tbl where item_id='".$item_id."' ";
			$query1="SELECT  RVIVNo,Date,SupplierDepartmentName,BillIndentNo,QuantityR,QuantityI,TransferNo,Balance FROM (SELECT p.rcvcno RVIVNo,p.billdate Date,s.supplier_name SupplierDepartmentName,p.billno BillIndentNo,p.noofitems QuantityR,null QuantityI,null TransferNo,null Balance FROM purchase_tbl p join supplier_tbl s on p.supplier_id=s.supplier_id where p.item_id='".$item_id."' UNION ALL SELECT ist.voucherno RVIVNo,ist.issueddate Date, d.room_no SupplierDepartmentName,ist.indentno BillIndentNo,null QuantityR,ist.noofitems QuantityI,ist.transfer_no TransferNo,null Balance FROM issue_tbl ist join dept_tbl d on ist.dept_id=d.dept_id where ist.item_id='".$item_id."') T  ORDER BY Date ASC";
			$query2="select sum(noofitems) as sumR from purchase_tbl where item_id='".$item_id."'";
			$query3="select sum(noofitems) as sumI from issue_tbl where item_id='".$item_id."'";
			$res	=	mysql_query($query);
			$res1	=	mysql_query($query1);
			$res2	=	mysql_query($query2);
			$res3	=	mysql_query($query3);
			if(mysql_num_rows($res)>0)
{   
while($row=mysql_fetch_array($res))
{
?>
<br/>
<table align="center" cellpadding="5">
<tr>
	<th bgcolor="#5D7B9D"><font color="#fff">ItemId</th><th bgcolor="#5D7B9D"><font color="#fff">Item Name</th><th bgcolor="#5D7B9D"><font color="#fff">In-Stock</th>
</tr>
<tr>
	<td ><font color="#fff"><?php echo $row['item_id'];?></td><td ><font color="#fff"><?php echo $row['item_name'];?></td><td><font color="#fff"><?php echo $quantity;?></td>
</tr>
</table>
<br/>
 
  <?php 

}
}
?>
<table class="imagetable" align="center">
<tr>
	<th>S.No</th><th>RVNo IVNo</th><th>Date</th><th>SupplierName DepartmentName</th><th>BillNo IndentNo</th><th>QuantityReceived</th><th>QuantityIssued</th><th>Transfer No</th><th>Balance</th>
</tr>

<?php  
if(mysql_num_rows($res1)>0)
{   
$i=0;
while($row1=mysql_fetch_array($res1))
{

?>
<tr>
	<td><?php echo (++$i) ?></td><td><?php echo $row1['RVIVNo'];?></td><td><?php echo $row1['Date'];?></td><td><?php echo $row1['SupplierDepartmentName'];?></td><td><?php echo $row1['BillIndentNo'];?></td><td><?php echo $row1['QuantityR'];?></td><td><?php echo $row1['QuantityI'];?></td><td><?php echo $row1['TransferNo'];?></td><td><?php echo $row1['Balance'];?></td>
</tr>
 
<?php 

}
$row2=mysql_fetch_array($res2);
$row3=mysql_fetch_array($res3)
?>
<tfoot>
    <tr>
	
	<td colspan="5" align="right">Sum</td>
      <td><?php echo $row2['sumR']; ?></td><td><?php echo $row3['sumI']; ?></td>
    </tr>
  </tfoot>
  <?php
}	
	

?>
</table>
<?php	
	
	
	
	
	
	
	
	
	}

}
else
{
	$query	=	"SELECT item_id,item_name FROM nims_store.item_tbl where item_id='".$item_id."' ";
	$query1="SELECT  RVIVNo,Date,SupplierDepartmentName,BillIndentNo,QuantityR,QuantityI,TransferNo,Balance FROM (SELECT p.rcvcno RVIVNo,p.billdate Date,s.supplier_name SupplierDepartmentName,p.billno BillIndentNo,p.noofitems QuantityR,null QuantityI,null TransferNo,null Balance FROM purchase_tbl p join supplier_tbl s on p.supplier_id=s.supplier_id where p.item_id='".$item_id."' UNION ALL SELECT ist.voucherno RVIVNo,ist.issueddate Date, d.room_no SupplierDepartmentName,ist.indentno BillIndentNo,null QuantityR,ist.noofitems QuantityI,ist.transfer_no TransferNo,null Balance FROM issue_tbl ist join dept_tbl d on ist.dept_id=d.dept_id where ist.item_id='".$item_id."') T  ORDER BY Date ASC";
	$query2="select sum(noofitems) as sumR from purchase_tbl where item_id='".$item_id."'";
	$query3="select sum(noofitems) as sumI from issue_tbl where item_id='".$item_id."'";
$res	=	mysql_query($query);
$res1	=	mysql_query($query1);
$res2	=	mysql_query($query2);
$res3	=	mysql_query($query3);
}
?>

<?php  
if(mysql_num_rows($res)>0)
{   
while($row=mysql_fetch_array($res))
{
?>
<br/>
<table align="center" cellpadding="5">
<tr>
	<th bgcolor="#5D7B9D"><font color="#fff">ItemId</th><th bgcolor="#5D7B9D"><font color="#fff">Item Name</th><th bgcolor="#5D7B9D"><font color="#fff">In-Stock</th>
</tr>
<tr>
	<td ><font color="#fff"><?php echo $row['item_id'];?></td><td ><font color="#fff"><?php echo $row['item_name'];?></td><td><font color="#fff"><?php echo $quantity;?></td>
</tr>
</table>
<br/>
 
  <?php 

}
}
?>
<table class="imagetable" align="center">
<tr>
	<th>S.No</th><th>RVNo IVNo</th><th>Date</th><th>SupplierName DepartmentName</th><th>BillNo IndentNo</th><th>QuantityReceived</th><th>QuantityIssued</th><th>Transfer No</th><th>Balance</th>
</tr>

<?php  
if(mysql_num_rows($res1)>0)
{   
$i=0;
while($row=mysql_fetch_array($res1))
{

?>
<tr>
	<td><?php echo (++$i) ?></td><td><?php echo $row['RVIVNo'];?></td><td><?php echo $row['Date'];?></td><td><?php echo $row['SupplierDepartmentName'];?></td><td><?php echo $row['BillIndentNo'];?></td><td><?php echo $row['QuantityR'];?></td><td><?php echo $row['QuantityI'];?></td><td><?php echo $row['TransferNo'];?></td><td><?php echo $row['Balance'];?></td>
</tr>
 
<?php 

}
$row2=mysql_fetch_array($res2);
$row3=mysql_fetch_array($res3)
?>
<tfoot>
    <tr>
	
	<td colspan="5" align="right">Sum</td>
      <td><?php echo $row2['sumR']; ?></td><td><?php echo $row3['sumI']; ?></td>
    </tr>
  </tfoot>
  <?php
}
else
{
?>
<center><h3 style="color:#F00;">We Have No Results for Alphabet starting with "<?php echo $_REQUEST['alphabet'];?>"</h3></center>
<?php 
}
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