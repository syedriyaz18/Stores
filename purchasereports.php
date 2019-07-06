<?php 
include('header.php');
$pdo = new PDO("mysql:host=localhost;dbname=nims_store;charset=utf8", "root", "root");
?>

<link rel="stylesheet" type="text/css" media="all" href="./datepicker/jsDatePick_ltr.min.css" />
         <script type="text/javascript" src="./datepicker/jquery.1.4.2.js"></script>
		<script type="text/javascript" src="./datepicker/jsDatePick.jquery.min.1.3.js"></script>
		<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField1",
			dateFormat:"%Y-%M-%d",
			limitToToday:true
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		
		new JsDatePick({
			useMode:2,
			target:"inputField2",
			dateFormat:"%d-%M-%Y",
			limitToToday:true
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		
	};
</script>


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
    .blue{ background: #0000ff; }
	.pink{ background: #FFC0CB; }
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
            if($(this).attr("value")=="blue"){
                $(".box").hide();
                $(".blue").show();
            }
			if($(this).attr("value")=="pink"){
                $(".box").hide();
                $(".pink").show();
            }
        });
    });
</script>

<link rel="stylesheet" type="text/css" media="all" href="./Styles/table.css" />
<div id="page_content">
<div class="row-fluid">
    <div class="span12">
	<div class="alert alert-success"><center>Purchased Items Reports</center></div>
	<form class="form-horizontal" action="" method="post" >

	<center>
	<div class="control-group">
        <label class="control-label" >Supplier Wise<input type="radio" name="selecttype" value="red"></label>
		 <label class="control-label">ItemWise<input type="radio" name="selecttype" value="white"></label>
        <label class="control-label">DateWise<input type="radio" name="selecttype" value="green"></label>
        <label class="control-label">RV Wise<input type="radio" name="selecttype" value="pink"></label>
		<label class="control-label">Complete Report<input type="radio" name="selecttype" value="blue"></label>
    </div>
	
    <div class="red box">        
		<label><font color="white">Supplier Name</font></label>
        <select id="supplier_id"name="supplier_id">
            <option value="">Select one</option>
             <?php
               $st = $pdo->prepare("SELECT supplier_id,supplier_name FROM supplier_tbl order by supplier_name");
               $st->execute();
               $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows as $row) {
                   ?><option value="<?php echo $row ['supplier_id']; ?>"><?php echo $row ['supplier_name']; ?></option><?php
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
    <div class="green box"><label>Received Date</label>
					From <input type="text" id="inputField1" name="rcvcdate1"  /> To <input type="text" id="inputField2" name="rcvcdate2"  />
	</div>
		<div class="pink box">
		<label class="control-label">Received Voucher No</label>
					<div class="controls">
						RC/<input id="rcvcno" name="rcvcno" type="text" onclick="copyText2()" >/NIMS
					</div>
		
		</div>
	<div class="blue box"></div>
	<div class="alert alert-success"><center><button type="submit" name="viewdata" class="btn">Submit</button></center></div>
	</center>
	<?PHP



?>
<div style="background: #286397;">
<center>
<?php
foreach (range('A', 'Z') as $i)
{
 //echo '<a href="purchasereports.php?alphabet='.$i.'">'.$i.'</a> | ';
 
}
?>
</center
</div>
<?php
if(isset($_POST['viewdata'])){
$selected_radio = $_POST['selecttype'];
print $selected_radio;
if ($selected_radio == 'red') {
$supplier_id=$_POST['supplier_id'];
$alphabet	=	$_GET['alphabet'];
if($alphabet)
{
	$query	=	"SELECT * FROM purchase_tbl WHERE itemreceived LIKE '".$alphabet."%' and suppliername='".$supplier_name."'  ORDER BY itemreceived";
}
else
{
	$query	=	"SELECT p.item_id,p.noofitems,p.billno,p.billdate,p.rcvcno,p.rcdate,s.supplier_name,i.item_name,u.unit_name FROM purchase_tbl p join  supplier_tbl s on p.supplier_id=s.supplier_id join item_tbl i on p.item_id=i.item_id join unit_tbl u on p.unit_id=u.unit_id where p.supplier_id='".$supplier_id."'  ORDER BY i.item_name";
}
$res	=	mysql_query($query);
}
if ($selected_radio == 'white') {
$item_id=$_POST['item_id'];
$alphabet	=	$_GET['alphabet'];
if($alphabet)
{
	$query	=	"SELECT * FROM purchase_tbl WHERE itemreceived LIKE '".$alphabet."%' and itemreceived='".$item_name."'  ORDER BY itemreceived";
}
else
{
	$query	=	"SELECT p.item_id,p.noofitems,p.billno,p.billdate,p.rcvcno,p.rcdate,s.supplier_name,i.item_name,u.unit_name FROM purchase_tbl p join  supplier_tbl s on p.supplier_id=s.supplier_id join item_tbl i on p.item_id=i.item_id join unit_tbl u on p.unit_id=u.unit_id where p.item_id='".$item_id."'  ORDER BY i.item_name";
}
$res	=	mysql_query($query);
}
else if ($selected_radio == 'green') {
$rcdate1=$_POST['rcvcdate1'];
$rcdate2=$_POST['rcvcdate2'];
$alphabet	=	$_GET['alphabet'];
if($alphabet)
{
	$query	=	"SELECT * FROM purchase_tbl WHERE itemreceived LIKE '".$alphabet."%' and rcdate=STR_TO_DATE('".$rcdate."', '%d-%M-%Y') ORDER BY itemreceived";
}
else
{
	$query	=	"SELECT p.item_id,p.noofitems,p.billno,p.billdate,p.rcvcno,p.rcdate,s.supplier_name,i.item_name,u.unit_name FROM purchase_tbl p join  supplier_tbl s on p.supplier_id=s.supplier_id join item_tbl i on p.item_id=i.item_id join unit_tbl u on p.unit_id=u.unit_id where p.rcdate>='".$rcdate1."' and p.rcdate<='".$rcdate2."' ORDER BY p.rcdate";
}
$res	=	mysql_query($query);

}
else if($selected_radio == 'pink'){
$rcvcno=$_POST['rcvcno'];
	$alphabet	=	$_GET['alphabet'];
if($alphabet)
{
	$query	=	"SELECT s.supplier_name,i.item_name,u.unit_name,p.noofitems,p.billno,p.billdate,p.rcvcno,p.rcdate FROM supplier_tbl s,item_tbl i,unit_tbl u,purchase_tbl p where i.item_id=p.item_id and i.item_name LIKE '".$alphabet."%' ORDER BY itemreceived";
}
else
{
	$query	=	"SELECT p.item_id,p.noofitems,p.billno,p.billdate,p.rcvcno,p.rcdate,s.supplier_name,i.item_name,u.unit_name FROM purchase_tbl p join  supplier_tbl s on p.supplier_id=s.supplier_id join item_tbl i on p.item_id=i.item_id join unit_tbl u on p.unit_id=u.unit_id where p.rcvcno='"."RV/".$rcvcno."/NIMS"."' ORDER BY p.rcvcno";
}
$res	=	mysql_query($query);
}
else if($selected_radio == 'blue'){

	$alphabet	=	$_GET['alphabet'];
if($alphabet)
{
	$query	=	"SELECT s.supplier_name,i.item_name,u.unit_name,p.noofitems,p.billno,p.billdate,p.rcvcno,p.rcdate FROM supplier_tbl s,item_tbl i,unit_tbl u,purchase_tbl p where i.item_id=p.item_id and i.item_name LIKE '".$alphabet."%' ORDER BY itemreceived";
}
else
{
	$query	=	"SELECT p.item_id,p.noofitems,p.billno,p.billdate,p.rcvcno,p.rcdate,s.supplier_name,i.item_name,u.unit_name FROM purchase_tbl p join  supplier_tbl s on p.supplier_id=s.supplier_id join item_tbl i on p.item_id=i.item_id join unit_tbl u on p.unit_id=u.unit_id ORDER BY i.item_name";
}
$res	=	mysql_query($query);
}

?>

<table class="imagetable" align="center">
<tr>
	<th>S.No</th><th>Item Id</th><th>Supplier Name</th><th>Item Name</th><th>Unit Name</th><th>Quantity</th><th>Bill No</th><th>Bill Date</th><th>RC No</th><th>RC Date</th>
</tr>
<?php  
if(mysql_num_rows($res)>0)
{   
$i=0;
while($row=mysql_fetch_array($res))
{
?>
<tr>
	<td><?php echo (++$i) ?></td><td><?php echo $row['item_id'];?></td><td><?php echo $row['supplier_name'];?></td><td><?php echo $row['item_name'];?></td><td><?php echo $row['unit_name'];?></td><td><?php echo $row['noofitems'];?></td><td><?php echo $row['billno'];?></td><td><?php echo $row['billdate'];?></td><td><?php echo $row['rcvcno'];?></td><td><?php echo $row['rcdate'];?></td>
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

	
</div>

</form>
<hr />
<?php 
include('footer.php');
?>
</body>


       
</html>