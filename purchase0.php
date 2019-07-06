<?php 
include('header.php');

// First of all, don't make use of mysql_* functions, those are old
$pdo = new PDO("mysql:host=localhost;dbname=nims_store;charset=utf8", "root", "desitalkdb@shahtech_786");
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
	<div class="alert alert-success"><center>Purchase/Received Items</center></div>
     <form class="form-horizontal" action="" method="post" >
       <fieldset>
			<div class="control-group">
			<label class="control-label">Supplier Name</label>
                    <div class="controls">
					
                       <select id="supplier_name"name="supplier_name">
                            <option value="">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT * FROM supplier_tbl");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['supplier_name']; ?>"><?php echo $row ['supplier_name']; ?></option><?php
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
                            $st = $pdo->prepare("SELECT item_name FROM stocks_tbl");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['item_name']; ?>"><?php echo $row ['item_name']; ?></option><?php
                            }
                        ?>
                        </select>
						<div class="controls">
						<label class="control-label">Stock</label>
						<input id="quantity" name="quantity" type="text" class="input-small" disabled>
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
						<input id="unitquantity" name="unitquantity" type="text" class="input-small" disabled>
                    </div></div>
			</div>
			<div class="control-group">
					<label class="control-label">No Of Units</label>
					<div class="controls">
						<input id="noofunits" name="noofunits" type="text" onKeyPress="copyText()" >
						<div class="controls">
						<label class="control-label">No Of Items</label>
						<input id="noofitems" name="noofitems" type="text" class="input-small" readonly>
                    </div>
					</div>
			</div>
			<div class="control-group">
					<label class="control-label">Bill No</label>
					<div class="controls">
						<input id="billno" name="billno" type="text" >
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
						RC/<input id="rcvcno" name="rcvcno" type="text" >/NIMS
					</div>
					<div class="controls">
					<label class="control-label">Received Date</label>
					<div class="controls">
					<input type="text" id="inputField2" name="rcvcdate"/>
					 </div></div>
			</div>
     
    <br/>
   

         <?php
if(isset($_POST['insertdata'])){
include"pdoconn.php";

$supplier_name=$_POST['supplier_name'];
$item_name=htmlspecialchars($_POST['item_name'], ENT_NOQUOTES);

$quantity=$_POST['quantity'];
$unit_name=$_POST['unit_name'];
$unitquantity=$_POST['unitquantity'];
$noofunits=$_POST['noofunits'];
$noofitems=$_POST['noofitems'];
$billno=$_POST['billno'];
$billdate=$_POST['billdate'];
$rcvcno=$_POST['rcvcno'];
$rcdate=$_POST['rcvcdate'];
if(empty($noofitems) || empty($billno) || empty($billdate) || empty($rcvcno) || empty($rcdate)){

	echo "<label class='err'>All fields are required</label>";
	}



		else{
$insert1="Insert into nims_store.purchase_tbl(suppliername,itemreceived,unitname,unitsreceived,noofitems,billno,billdate,rcvcno,rcdate)
 values(:suppliername,:itemreceived,:unitname,:unitsreceived,:noofitems,:billno,:billdate,:rcvcno,:rcdate)";
 $stmt = $dbh->prepare($insert1);
 $stmt->bindParam(':suppliername', $_POST['supplier_name'], PDO::PARAM_STR);
 $stmt->bindParam(':itemreceived', &item_name, PDO::PARAM_STR);
 $stmt->bindParam(':unitname', $_POST['unit_name'], PDO::PARAM_STR);
 $stmt->bindParam(':unitsreceived', $_POST['noofunits'], PDO::PARAM_STR);
 $stmt->bindParam(':noofitems', $_POST['noofitems'], PDO::PARAM_STR);
 $stmt->bindParam(':billno', $_POST['billno'], PDO::PARAM_STR);
 $stmt->bindParam(':billdate', STR_TO_DATE($_POST['billdate']), PDO::PARAM_STR);
 $stmt->bindParam(':rcvcno', $_POST['rcvcno'], PDO::PARAM_STR);
 $stmt->bindParam(':rcdate', STR_TO_DATE($_POST['rcvcdate']), PDO::PARAM_STR);
 $stmt->execute(); 

$rs=mysql_query($insert1) or die(mysql_error());
echo"$item_name";
?>
<script>alert('Data Entry Saved!');</script>
<?php }
}
 ?>
<br/>    <button type="submit" name="insertdata" class="btn">Submit</button>

  </fieldset>
</form>

   
   <?php 
   function save(){
	
	
	}
   ?>
</div>
</div>

</div>
</body>
<hr />
<div style="background: #286397;">
          <p>Shah Technologies <small>&copy;&nbsp; All rights reserved. | <a href="copyright.php">Copyright</a> | <a href="terms.php">Terms and Conditions</a> | <a href="privacy.php">Privacy Policy</a> | <a class="current" href="about.php">About Us</a></small></p>
       </div>
       
</html>