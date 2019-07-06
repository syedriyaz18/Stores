<?php 
include('header.php');
$pdo = new PDO("mysql:host=localhost;dbname=nims_store;charset=utf8", "root", "root");
?>



<style type="text/css">
    .box{
        padding: 10px;
        display: none;
        margin-top: 20px;
        border: 1px solid #000;
    }
    .red{ background: #ff0000; }
	.white{ background: #d6d6d6; }
    .green{ background: #00ff00; }
	.pink{ background: #FFC0CB; }
    .blue{ background: #0000ff; }
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            if($(this).attr("value")=="red"){
                $(".box").hide();
                $(".red").show();
            }
			if($(this).attr("value")=="white"){
                $(".box").hide();
                $(".white").show();
            }
            if($(this).attr("value")=="green"){
                $(".box").hide();
                $(".green").show();
            }
			if($(this).attr("value")=="pink"){
                $(".box").hide();
                $(".pink").show();
            }
            if($(this).attr("value")=="blue"){
                $(".box").hide();
                $(".blue").show();
            }
        });
    });
</script>
<link rel="stylesheet" type="text/css" media="all" href="./Styles/table.css" />
<div id="page_content">
<div class="row-fluid">
    <div class="span12">
	<div class="alert alert-success"><center>Room Items Reports</center></div>
	<form class="form-horizontal" action="" method="post" >

	<center>
	<div class="control-group">
        <label class="control-label" >RoomWise<input type="radio" name="selecttype" value="red"></label>
		<label class="control-label">ItemWise<input type="radio" name="selecttype" value="white"></label>
        <label class="control-label">Complete Report<input type="radio" name="selecttype" value="blue"></label>
		
    </div>
	
    <div class="red box">        
		<label>Room No</label>
                        <select id="dept_id"name="dept_id">
                            <option value="">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT dept_id,room_no FROM dept_tbl order by dept_name");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['dept_id']; ?>"><?php echo $row ['room_no']; ?></option><?php
                            }
                        ?>
                        </select>
	</div>
	<div class="white box">
	 <label>ItemName</label>
                  
                         <select id="item_id" name="item_id">
                            <option value="">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT item_id,item_name FROM item_tbl order by item_name");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['item_id']; ?>"><?php echo $row ['item_name']; ?></option><?php
                            }
                        ?>
                        </select>
	</div>
   				
	
	<div class="blue box"></div>
	<div class="alert alert-success"><center><button type="submit" name="viewdata" class="btn">Submit</button></center></div>
	</center>

	
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
$selected_radio = $_POST['selecttype'];
print $selected_radio;
if ($selected_radio == 'red') {
$dept_id=$_POST['dept_id'];
$alphabet	=	$_GET['alphabet'];
if($alphabet)
{
	$query	=	"SELECT * FROM issue_tbl WHERE itemissued LIKE '".$alphabet."%' and issuedto='".$dept_name."'  ORDER BY itemissued";
}
else
{
	$query	=	"SELECT ist.noofitems,d.room_no,i.item_name FROM roomsdata_tbl ist join dept_tbl d on ist.room_id=d.dept_id join item_tbl i on ist.item_id=i.item_id where ist.room_id='".$dept_id."'  ORDER BY i.item_name";
}
$res	=	mysql_query($query);
}
if ($selected_radio == 'white') {
$item_id=$_POST['item_id'];
$alphabet	=	$_GET['alphabet'];
if($alphabet)
{
	$query	=	"SELECT * FROM issue_tbl WHERE itemissued LIKE '".$alphabet."%' and itemissued='".$item_name."'  ORDER BY itemissued";
}
else
{
	$query	=	"SELECT ist.noofitems,d.room_no,i.item_name FROM roomsdata_tbl ist join dept_tbl d on ist.room_id=d.dept_id join item_tbl i on ist.item_id=i.item_id where ist.item_id='".$item_id."'  ORDER BY i.item_name";
}
$res	=	mysql_query($query);
}

else if($selected_radio == 'blue'){

	$alphabet	=	$_GET['alphabet'];
if($alphabet)
{
	$query	=	"SELECT * FROM issue_tbl WHERE itemissued LIKE '".$alphabet."%' ORDER BY itemissued";
}
else
{
	$query	=	"SELECT ist.noofitems,d.room_no,i.item_name FROM roomsdata_tbl ist join dept_tbl d on ist.room_id=d.dept_id join item_tbl i on ist.item_id=i.item_id ORDER BY i.item_name";;
}
$res	=	mysql_query($query);
}


?>

<table class="imagetable" align="center">
<tr>
	<th>S.No</th><th>Room No</th><th>Item Name</th><th>Quantity</th>
</tr>
<?php  
if(mysql_num_rows($res)>0)
{
$i=0;   
while($row=mysql_fetch_array($res))
{
?>
<tr>
	<td><?php echo (++$i) ?></td><td><?php echo $row['room_no'];?></td><td><?php echo $row['item_name'];?></td><td><?php echo $row['noofitems'];?></td>
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
}
?>
</table>
</form>
	
</div>

<hr />
<?php 
include('footer.php');
?>
</body>


       
</html>