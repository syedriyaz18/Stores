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
		new JsDatePick({
					useMode:2,
					target:"inputField2",
					dateFormat:"%d-%M-%Y",
					limitToToday:true
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
			
		desti.value = parseInt(srci1.value)+parseInt(srci2.value);
		
	
   
}




</script>
		
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
        
            $('#unit_id').change(function() { // When the value for the Employee_ID element change, this will be triggered
                var $self2 = $(this); // We create an jQuery object with the select inside
                $.post("getunitquantity.php", { unit_id : $self2.val()}, function(json) {
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
	<div class="alert alert-success"><center>Purchase/Received Items</center></div>
     <form class="form-horizontal" action="" method="post" >
       <fieldset>
			<div class="control-group">
			<label class="control-label">Supplier Name</label>
                    <div class="controls">
					
                       <select id="supplier_id"name="supplier_id" style="width: auto;">
                            <option value="<?php echo isset($_POST['supplier_id']) ? $_POST['supplier_id'] : '' ?>">Select one</option>
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
                </div>

				<div class="control-group">
                    <label class="control-label">Item Received</label>
                    <div class="controls">
                         <select id="item_id" name="item_id" style="width: auto;">
                            <option value="<?php echo isset($_POST['item_id']) ? $_POST['item_id'] : '' ?>">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT item_id,item_name FROM item_tbl order by item_name");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['item_id']; ?>"><?php echo $row ['item_name']; ?></option><?php
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
                         <select id="unit_id" name="unit_id">
                            <option value="">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT unit_id,unit_name FROM unit_tbl");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['unit_id']; ?>"><?php echo $row ['unit_name']; ?></option><?php
                            }
                        ?>
                        </select>
						
						<div class="controls" >
						<label class="control-label" >Unit Value</label>
						<input id="unitquantity" name="unitquantity" type="text" class="input-small" readonly>
                    </div></div>
			</div>
			<div class="control-group">
					<label class="control-label">No Of Units</label>
					<div class="controls">
						<input  id="noofunits" name="noofunits" type="text" onKeyPress="copyText()">Press Tab
						<div class="controls">
						<label class="control-label" >No Of Items</label>
						<input id="noofitems" name="noofitems" type="text" class="input-small" onKeyPress="copyText2()" readonly>
						<input id="hiddentotal" name="hiddentotal" type="text" class="input-small" readonly>
                    </div>
					</div>
			</div>
			<div class="control-group">
					<label class="control-label">Bill No</label>
					<div class="controls">
						<input id="billno" name="billno" type="text" onclick="copyText()" >
					</div>
					<div class="controls">
					<label class="control-label">Bill Date</label>
					<div class="controls">
					<input type="text" id="inputField1" name="billdate"/>
					 </div></div>
			</div>
			<div class="control-group">
					<label class="control-label">Received Voucher No</label>
					<div class="controls">
						RC/<input id="rcvcno" name="rcvcno" type="text" onclick="copyText2()" >/NIMS
					</div>
					<div class="controls">
					<label class="control-label">Received Date</label>
					<div class="controls">
					<input type="text" id="inputField2" name="rcvcdate"  />
					 </div></div>
			</div>
     
  
   

         <?php
if(isset($_POST['insertdata'])){
$conn=mysql_connect('localhost','root','');
mysql_select_db("nims_store",$conn);

$supplier_id=$_POST['supplier_id'];
$item_id=$_POST['item_id'];
$quantity=$_POST['quantity'];
$unit_id=$_POST['unit_id'];
$unitquantity=$_POST['unitquantity'];
$noofunits=$_POST['noofunits'];
$noofitems=$_POST['noofitems'];
$billno=$_POST['billno'];
$billdate=$_POST['billdate'];
$rcvcno=$_POST['rcvcno'];
$rcdate=$_POST['rcvcdate'];
$hiddentotal=$_POST['hiddentotal'];
$user=$_SESSION['login'];
Print "<b>Quantity:</b> $quantity"; 
Print "<b>No OF Items:</b> $hiddentotal"; 
if(empty($noofitems) || empty($billno) || empty($billdate) || empty($rcvcno) || empty($rcdate)){

	echo "<label class='err'>All fields are required</label>";
	}
	else{
	
$insert1="Insert into nims_store.purchase_tbl(supplier_id,item_id,unit_id,unitsreceived,noofitems,billno,billdate,rcvcno,rcdate,user)
 values('".$supplier_id."','".$item_id."','".$unit_id."','".$noofunits."','".$noofitems."','".$billno."',STR_TO_DATE('".$billdate."', '%d-%M-%Y'),'"."RV/".$rcvcno."/NIMS"."',STR_TO_DATE('".$rcdate."', '%d-%M-%Y'),'".$user."')";

$rs=mysql_query($insert1) or die(mysql_error());
		
if (!empty($quantity)){

$update1="update nims_store.stocks_tbl set quantity='".$hiddentotal."' where item_id='".$item_id."'";

$rs3=mysql_query($update1) or die(mysql_error());

}

else {

$t1=$quantity+$noofitems;
Print "<b>Total:</b> $t1"; 
$insert2="Insert into nims_store.stocks_tbl(item_id,unit_id,unitsissued,quantity)
 values('".$item_id."','".$unit_id."','".$noofunits."','".$noofitems."')";

$rs2=mysql_query($insert2) or die(mysql_error());

}
}
?>
<script>alert('Data Entry Saved!');</script>
<?php }

 ?></br>
  <div class="alert alert-success"><center><button type="submit" name="insertdata" class="btn">Submit</button></center></div>

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