<?php 
include('header.php');
$pdo = new PDO("mysql:host=localhost;dbname=nims_store;charset=utf8", "root", "");
?>
<link rel="stylesheet" type="text/css" media="all" href="./datepicker/jsDatePick_ltr.min.css" />
         <script type="text/javascript" src="./datepicker/jquery.1.4.2.js"></script>
		<script type="text/javascript" src="./datepicker/jsDatePick.jquery.min.1.3.js"></script>
		<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField1",
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
	<div class="alert alert-success"><center>Issued Items Reports</center></div>
	<form class="form-horizontal" action="" method="post" >

	<center>
	<div class="control-group">
        <label class="control-label" >Department Wise<input type="radio" name="selecttype" value="red"></label>
		<label class="control-label">ItemWise<input type="radio" name="selecttype" value="white"></label>
        <label class="control-label">DateWise<input type="radio" name="selecttype" value="green"></label>
		 <label class="control-label">IV Wise<input type="radio" name="selecttype" value="pink"></label>
        <label class="control-label">Complete Report<input type="radio" name="selecttype" value="blue"></label>
		
    </div>
	
    <div class="red box">        
		<label>Department Name</label>
                        <select id="dept_id"name="dept_id">
                            <option value="">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT dept_id,dept_name FROM dept_tbl order by dept_name");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['dept_id']; ?>"><?php echo $row ['dept_name']; ?></option><?php
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
    <div class="green box"><label>Issue Date</label>
					
					<input type="text" id="inputField1" name="ivdate"  />
	</div>				
	<div class="pink box">
		<label class="control-label">Issued Voucher No</label>
					<div class="controls">
						IV/<input id="ivno" name="ivno" type="text" onclick="copyText2()" >/NIMS
					</div>
		
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
	$query	=	"SELECT ist.unitsissued,ist.noofitems,ist.indentno,ist.voucherno,ist.issueddate,d.dept_name,i.item_name,u.unit_name FROM issue_tbl ist join dept_tbl d on ist.dept_id=d.dept_id join item_tbl i on ist.item_id=i.item_id join unit_tbl u on ist.unit_id=u.unit_id where ist.dept_id='".$dept_id."'  ORDER BY i.item_name";
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
	$query	=	"SELECT ist.unitsissued,ist.noofitems,ist.indentno,ist.voucherno,ist.issueddate,d.dept_name,i.item_name,u.unit_name FROM issue_tbl ist join dept_tbl d on ist.dept_id=d.dept_id join item_tbl i on ist.item_id=i.item_id join unit_tbl u on ist.unit_id=u.unit_id where ist.item_id='".$item_id."'  ORDER BY i.item_name";
}
$res	=	mysql_query($query);
}
else if ($selected_radio == 'green') {
$ivdate=$_POST['ivdate'];
$alphabet	=	$_GET['alphabet'];
if($alphabet)
{
	$query	=	"SELECT * FROM issue_tbl WHERE itemissued LIKE '".$alphabet."%' and issueddate=STR_TO_DATE('".$ivdate."', '%d-%M-%Y') ORDER BY itemissued";
}
else
{
	$query	=	"SELECT ist.unitsissued,ist.noofitems,ist.indentno,ist.voucherno,ist.issueddate,d.dept_name,i.item_name,u.unit_name FROM issue_tbl ist join dept_tbl d on ist.dept_id=d.dept_id join item_tbl i on ist.item_id=i.item_id join unit_tbl u on ist.unit_id=u.unit_id where ist.issueddate=STR_TO_DATE('".$ivdate."', '%d-%M-%Y')ORDER BY i.item_name";
}
$res	=	mysql_query($query);

}
else if($selected_radio == 'pink'){
$ivno=$_POST['ivno'];
	$alphabet	=	$_GET['alphabet'];
if($alphabet)
{
	$query	=	"SELECT s.supplier_name,i.item_name,u.unit_name,p.noofitems,p.billno,p.billdate,p.rcvcno,p.rcdate FROM supplier_tbl s,item_tbl i,unit_tbl u,purchase_tbl p where i.item_id=p.item_id and i.item_name LIKE '".$alphabet."%' ORDER BY itemreceived";
}
else
{
	$query	=	"SELECT ist.unitsissued,ist.noofitems,ist.indentno,ist.voucherno,ist.issueddate,d.dept_name,i.item_name,u.unit_name FROM issue_tbl ist join dept_tbl d on ist.dept_id=d.dept_id join item_tbl i on ist.item_id=i.item_id join unit_tbl u on ist.unit_id=u.unit_id where ist.voucherno='"."IV/".$ivno."/NIMS"."' ORDER BY i.item_name";
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
	$query	=	"SELECT ist.unitsissued,ist.noofitems,ist.indentno,ist.voucherno,ist.issueddate,d.dept_name,i.item_name,u.unit_name FROM issue_tbl ist join dept_tbl d on ist.dept_id=d.dept_id join item_tbl i on ist.item_id=i.item_id join unit_tbl u on ist.unit_id=u.unit_id ORDER BY i.item_name";;
}
$res	=	mysql_query($query);
}


?>

<table class="imagetable" align="center">
<tr>
	<th>S.No</th><th>Department Name</th><th>Item Name</th><th>Unit</th><th>Quantity</th><th>Indent No</th><th>Voucher No</th><th>Issued Date</th>
</tr>
<?php  
if(mysql_num_rows($res)>0)
{
$i=0;   
while($row=mysql_fetch_array($res))
{
?>
<tr>
	<td><?php echo (++$i) ?></td><td><?php echo $row['dept_name'];?></td><td><?php echo $row['item_name'];?></td><td><?php echo $row['unit_name'];?></td><td><?php echo $row['noofitems'];?></td><td><?php echo $row['indentno'];?></td><td><?php echo $row['voucherno'];?></td><td><?php echo $row['issueddate'];?></td>
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