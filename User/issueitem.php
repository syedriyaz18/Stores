<?php 
include('header.php');

// First of all, don't make use of mysql_* functions, those are old
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

<script type="text/javascript">
 
function copyText() {
    src1 = document.getElementById("noofunits");
	src2 = document.getElementById("unitquantity");
    dest = document.getElementById("noofitems");
    dest.value = src1.value*src2.value;
}

function copyText2() {
    srci1 = document.getElementById("quantity");
	srci2 = document.getElementById("noofitems");
	desti = document.getElementById("hiddentotal");
	
		
		desti.value = parseInt(srci1.value)-parseInt(srci2.value);
		
	
   
}




</script>
		
 <script type="text/javascript">
        $(function() { // This code will be executed when DOM is ready
            $('#item_name').change(function() { // When the value for the Employee_ID element change, this will be triggered
                var $self1 = $(this); // We create an jQuery object with the select inside
                $.post("getstockdata.php", { item_name : $self1.val()}, function(json) {
                    if (json && json.status) {
                        $('#quantity').val(json.quantity);
                        
                    }
                })
            });
        
            $('#unit_name').change(function() { // When the value for the Employee_ID element change, this will be triggered
                var $self2 = $(this); // We create an jQuery object with the select inside
                $.post("getunitquantity.php", { unit_name : $self2.val()}, function(json) {
                    if (json && json.status) {
                        $('#unitquantity').val(json.unitquantity);
                        
                    }
                })
            });
        })
    </script>
<div id="page_content">

<div class="row-fluid">
    <div class="span12">
	<div class="alert alert-success"><center>Issue Items Here</center></div>
     <form class="form-horizontal" action="" method="post" >
       <fieldset>
			<div class="control-group">
			<label class="control-label">Department Name</label>
                    <div class="controls">
					
                       <select id="dept_name"name="dept_name">
                            <option value="">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT * FROM dept_tbl");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['dept_name']; ?>"><?php echo $row ['dept_name']; ?></option><?php
                            }
                        ?>
                        </select>
						
                    </div>
                </div>

				<div class="control-group">
                    <label class="control-label">Item Received</label>
                    <div class="controls">
                         <select id="item_name" name="item_name">
                            <option value="">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT item_name FROM item_tbl");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['item_name']; ?>"><?php echo $row ['item_name']; ?></option><?php
                            }
                        ?>
                        </select>
						<div class="controls">
						<label class="control-label">Stock</label>
						<input id="quantity" name="quantity" type="text" class="input-small" readonly>
                    </div></div>
					
                </div>
				
         
           <div class="control-group">
                    <label class="control-label">Accounting/Unit</label>
                    <div class="controls">
                         <select id="unit_name" name="unit_name">
                            <option value="">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT unit_name FROM unit_tbl");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['unit_name']; ?>"><?php echo $row ['unit_name']; ?></option><?php
                            }
                        ?>
                        </select>
						
						<div class="controls">
						<label class="control-label">Unit Value</label>
						<input id="unitquantity" name="unitquantity" type="text" class="input-small" readonly>
                    </div></div>
			</div>
			<div class="control-group">
					<label class="control-label">No Of Units</label>
					<div class="controls">
						<input id="noofunits" name="noofunits" type="text" onKeyPress="copyText()">Press Tab
						<div class="controls">
						<label class="control-label">No Of Items</label>
						<input id="noofitems" name="noofitems" type="text" class="input-small" onKeyPress="copyText2()" readonly>
						<input  id="hiddentotal" name="hiddentotal" type="text" class="input-small" readonly>
                    </div>
					</div>
			</div>
			<div class="control-group">
					<label class="control-label">Issue Indent No</label>
					<div class="controls">
						<input id="issueindentno" name="issueindentno" type="text" onclick="copyText()" >
					</div>
					
			</div>
			<div class="control-group">
					<label class="control-label">Issue Voucher No</label>
					<div class="controls">
						IV/<input id="ivno" name="ivno" type="text" onclick="copyText2()" >/NIMS
					</div>
					<div class="controls">
					<label class="control-label">Issue Date</label>
					<div class="controls">
					<input type="text" id="inputField1" name="ivdate"  />
					 </div></div>
			</div>
     
    <br/>
   

         <?php
if(isset($_POST['insertdata'])){
$conn=mysql_connect('localhost','root','');
mysql_select_db("nims_store",$conn);

$dept_name=$_POST['dept_name'];
$item_name=$_POST['item_name'];
$quantity=$_POST['quantity'];
$unit_name=$_POST['unit_name'];
$unitquantity=$_POST['unitquantity'];
$noofunits=$_POST['noofunits'];
$noofitems=$_POST['noofitems'];
$issueindentno=$_POST['issueindentno'];
//$billdate=$_POST['issuedate'];
$ivno=$_POST['ivno'];
$ivdate=$_POST['ivdate'];
$hiddentotal=$_POST['hiddentotal'];
Print "<b>Quantity:</b> $quantity"; 
Print "<b>No OF Items:</b> $hiddentotal"; 
if(empty($noofitems) || empty($issueindentno) || empty($ivno) || empty($ivdate)){

	echo "<label class='err'>All fields are required</label>";
	}
	else{
	if($quantity>0)
	{
$insert1="Insert into nims_store.issue_tbl(issuedto,itemissued,unitname,unitsissued,noofitems,indentno,voucherno,issueddate)
 values('".$dept_name."','".$item_name."','".$unit_name."','".$noofunits."','".$noofitems."','".$issueindentno."','".$ivno."',STR_TO_DATE('".$ivdate."', '%d-%M-%Y'))";

$rs=mysql_query($insert1) or die(mysql_error());

$update1="update nims_store.stocks_tbl set quantity='".$hiddentotal."' where item_name='".$item_name."'";

$rs3=mysql_query($update1) or die(mysql_error());

$message = "Items Issued Successfully";
echo "<script type='text/javascript'>alert('$message');</script>";
}
else{
$message = "Sorry! No Stock Items to Issue";
echo "<script type='text/javascript'>alert('$message');</script>";
}
}
}

 ?>
<br/> <div class="alert alert-success"><center>   <button type="submit" name="insertdata" class="btn">Submit</button></center></div>

  </fieldset>
</form>

   
   <?php 
   function save(){
	
	
	}
   ?>
</div>
</div>
<hr />
<?php 
include('footer.php');
?>
</div>
</body>

       
</html>