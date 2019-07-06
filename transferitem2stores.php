<?php 
include('header.php');
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$todaydate = date('Y-m-d');
$currentyear=date('y');
// First of all, don't make use of mysql_* functions, those are old
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
	desti = document.getElementById("itemsrem");
	var st;
		st=parseInt(srci1.value)-parseInt(srci2.value);
		if(st<0)
		{
			alert("Excess Stock Required");
			window.location = "transferitem2stores.php";
		}
		desti.value = st;
		
	
   
}




</script>
		
 <script type="text/javascript">
	
        $(function() { // This code will be executed when DOM is ready
		
		
			$('#item_id').change(function(){
				var item_id=$("#item_id").val();
			
			
			
            $('#oldivno').change(function() { // When the value for the Employee_ID element change, this will be triggered
                var ivno1 = $("#oldivno").val(); // We create an jQuery object with the select inside
				var ivno="IV/"+ivno1+"/NIMS"
				
				alert("Hai"+ivno+item_id);
                $.post("getitemdata.php", {item_id : item_id,ivno : ivno}, function(json) {
                    if (json && json.status) {
                        $('#quantity').val(json.noofitems);
						if($('#quantity').val()==0)
						{
							alert("No Items Issued"+ivno+item_id);
							window.location = "transferitem.php";
						}	
						else
						{
							alert(ivno+item_id+"Data");
						}
                        
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
			});
        })
    </script>
	
	
	
<div id="page_content">

<div class="row-fluid">
    <div class="span12">
	<div class="alert alert-success"><center>Transfer Items To Stores</center></div>
     <form class="form-horizontal" action="" method="post" >
       <fieldset>
			<div class="control-group">
			<label class="control-label" style="text-align:left;display: block;">From Department</label>
                    <div class="controls">
					
                       <select id="dept_id"name="dept_id" style="width:50% ;">
                            <option value="<?php echo isset($_POST['dept_id']) ? $_POST['dept_id'] : '' ?>">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT dept_id,dept_name,room_name,room_no FROM dept_tbl order by room_no");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['dept_id']; ?>"><?php echo $row ['room_no'];echo '--';echo$row ['room_name'];echo '--';echo$row ['dept_name']; ?></option><?php
                            }
                        ?>
                        </select>
						
                    </div>
                </div>

				<div class="control-group">
                    <label class="control-label" style="text-align:left;display: block;">Item To Trnsfer</label>
                    <div class="controls">
                         <select id="item_id" name="item_id" style="width:50%;">
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
						</div>
					
                </div>
				
			<div class="control-group">
					<label class="control-label" style="text-align:left;display: block;">Old Issue Voucher No</label>
					<div class="controls">
						IV/<?php echo $currentyear;?>/<input id="oldivno" name="oldivno" type="text"  >/NIMS
					</div>
					<div class="controls">
						<label class="control-label">Issued Quantity</label>
						<input id="quantity" name="quantity" type="text" class="input-small" readonly>
                    </div>
			</div>		
				
			<div class="control-group">
			<label class="control-label" style="text-align:left;display: block;">To Department</label>
                    <div class="controls">
					<input id="dept_id" name="dept_id" type="text" value="Stores" class="input-small" readonly>
                       <!--<select id="dept_id"name="dept_id" style="width:50% ;">
                            <option value="<?php echo isset($_POST['dept_id']) ? $_POST['dept_id'] : '' ?>">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT dept_id,dept_name,room_name,room_no FROM dept_tbl order by room_no");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['dept_id']; ?>"><?php echo $row ['room_no'];echo '--';echo$row ['room_name'];echo '--';echo$row ['dept_name']; ?></option><?php
                            }
                        ?>
                        </select>-->
						
                    </div>
                </div>	
				
         
          <!-- <div class="control-group">
                    <label class="control-label" style="text-align:left;display: block;">Accounting/Unit</label>
                    <div class="controls">
                         <select id="unit_id" name="unit_id">
                            <option value="">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT unit_id,unit_name FROM unit_tbl order by unit_name");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['unit_id']; ?>"><?php echo $row ['unit_name']; ?></option><?php
                            }
                        ?>
                        </select>
						
						<div class="controls">
						<label class="control-label">Unit Value</label>
						<input id="unitquantity" name="unitquantity" type="text" class="input-small" readonly>
                    </div></div>
			</div>-->
			<div class="control-group">
					<label class="control-label" style="text-align:left;display: block;">No Of Items</label>
					<div class="controls">
						<input id="noofitems" name="noofitems" type="text" onKeyPress="copyText2()">Press Tab
						<div class="controls">
						<label class="control-label" >Items Rem:</label>
						<input id="itemsrem" name="itemsrem" type="text" class="input-small" readonly>
						<!--<input  id="hiddentotal" name="hiddentotal" type="text" class="input-small" readonly>-->
                    </div>
					</div>
			</div>
			<!--<div class="control-group">
					<label class="control-label" style="text-align:left;display: block;">Issue Indent No</label>
					<div class="controls">
						<input id="issueindentno" name="issueindentno" type="text" onclick="copyText()" >
					</div>
					
			</div>-->
			
				
					
			<div class="control-group">
					<label class="control-label" style="text-align:left;display: block;">Transfer Voucher No</label>
					<div class="controls">
						R/TV/<?php echo $currentyear;?>/<input id="ivno" name="ivno" type="text" onclick="copyText2()" >/NIMS
					</div>
					<div class="controls">
					<label class="control-label">Transfer Date</label>
					<div class="controls">
					<input type="text" id="inputField1" name="ivdate"  />
					 </div></div>
			</div>
     <!--<div class="alert alert-success"><center><button onclick="myFunction();return false">Add To List</button></div>
			
   <table  align="center" id="myTable" border="1"> 
	<thead>
          <tr>
            <th>Item Name</th>
			<th>Unit Name</th>
            <th>Units Issued</th>
            <th>No Of Items Issued</th>
			<th>Delete</th>
          </tr>
		  
      </thead><tr>

</table><br>-->



<script>
function myFunction() {
    var table = document.getElementById("myTable");
	var rowLength = table.rows.length;
		var x = document.getElementById("item_id").selectedIndex;
		var y = document.getElementById("item_id").options;
		var xx = document.getElementById("item_id").value;
		var x1 = document.getElementById("unit_id").selectedIndex;
		var y1 = document.getElementById("unit_id").options;
		var yy = document.getElementById("unit_id").value;
		var noofunits = document.getElementById("noofunits").value;
		var noofitems = document.getElementById("noofitems").value;
		
		var quantity = document.getElementById("quantity").value;
		var hiddentotal = document.getElementById("hiddentotal").value;
		
		

    var row = table.insertRow(rowLength);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
	var cell3 = row.insertCell(2);
	var cell4 = row.insertCell(3);
	var cell5 = row.insertCell(4);
	
        var element1 = document.createElement("input");
        element1.type = "hidden";
		element1.size=10;
        element1.name="item_id[]";
		element1.value=xx;
        cell1.appendChild(element1);
		
		var element2 = document.createElement("input");
        element2.type = "text";
        element2.name="item_name[]";
		element2.value=y[x].text;
        cell1.appendChild(element2);
		
		var element3 = document.createElement("input");
        element3.type = "hidden";
        element3.name="unit_id[]";
		element3.value=yy;
        cell2.appendChild(element3);
		
		var element4 = document.createElement("input");
        element4.type = "text";
        element4.name="unit_name[]";
		element4.value=y1[x1].text;
        cell2.appendChild(element4);
		
		var element5 = document.createElement("input");
        element5.type = "text";
        element5.name="noofunits[]";
		element5.value=noofunits;
        cell3.appendChild(element5);
		
		var element8 = document.createElement("input");
        element8.type = "hidden";
        element8.name="hiddentotal[]";
		element8.value=hiddentotal;
        cell3.appendChild(element8);
		
		var element6 = document.createElement("input");
        element6.type = "text";
        element6.name="noofitems[]";
		element6.value=noofitems;
        cell4.appendChild(element6);
		
		var element7 = document.createElement("input");
        element7.type = "hidden";
        element7.name="quantity[]";
		element7.value=quantity;
        cell4.appendChild(element7);
	 
	//cell5.innerHTML = '<input id="Button" type="button" value="DeleteRow" onclick="deleteRow();"/>';
	
	
}
</script>
<script>
function deleteRow(row)
{
   var g = document.getElementById('myTable');
var rowLength = g.rows.length;
for (var i = 0, len = rowLength; i < len; i++)
{
    
    (function(index){
        g.rows[i].onclick = function(){
             
document.getElementById("myTable").deleteRow(index);
        }    
    })(i);
    
}
}
</script>


    <br/>
   

         <?php
if(isset($_POST['insertdata'])){
$conn=mysql_connect('localhost','root','');
mysql_select_db("nims_store",$conn);
 //foreach ($_POST['item_id'] as $key => $value) {
 
 
$dept_id1=$_POST['dept_id1'];
$item_id=$_POST['item_id'];
$dept_id2=$_POST['dept_id2'];
$quantity=$_POST['quantity'];
$unit_id=$_POST['unit_id'];
$unitquantity=$_POST['unitquantity'];
//$noofunits=$_POST['noofunits'];
$noofitems=$_POST['noofitems'];
$itemsrem=$_POST['itemsrem'];

$issueindentno=$_POST['issueindentno'];
//$billdate=$_POST['issuedate'];
$oldivno=$_POST['oldivno'];
$ivno=$_POST['ivno'];
$ivdate=$_POST['ivdate'];
//$hiddentotal=$_POST['hiddentotal'][$key];
$user=$_SESSION['login'];
Print "<b>Quantity:</b> $quantity"; 
Print "<b>No OF Items:</b> $noofitems"; 
Print "<b>Items Rem:</b> $itemsrem"; 

if(empty($noofitems) || empty($ivno) || empty($ivdate) ){

	echo "<label class='err'>All fields are required</label>";
	}
	else{
	if($noofitems>0)
	{
//$insert1="Insert into nims_store.issue_tbl(dept_id,item_id,unit_id,unitsissued,noofitems,indentno,voucherno,issueddate)
 //values('".$dept_id2."','".$item_id."','".$unit_id."','".$noofunits."','".$noofitems."','".$issueindentno."','"."IV/".$ivno."/NIMS"."',STR_TO_DATE('".$ivdate."', '%d-%M-%Y'))";

//$rs=mysql_query($insert1) or die(mysql_error());

$voucherno="IV/".$oldivno."/NIMS";
print"Voucher No $voucherno";
$query	=	"SELECT transfer_no FROM nims_store.issue_tbl where item_id='".$item_id."' and voucherno='".$voucherno."'";
$res	=	mysql_query($query);
if(mysql_num_rows($res)>0)
{   
while($row=mysql_fetch_array($res))
{
$tvno1=$row['transfer_no'];
}
}

$tvno=$tvno1.",TS/".$ivno;
print "TVNO $tvno";
$update1="update nims_store.issue_tbl set noofitems='".$itemsrem."',transfer_no='".$tvno."' where item_id='".$item_id."' and voucherno='".$voucherno."'";

$rs3=mysql_query($update1) or die(mysql_error());


$query1	=	"SELECT quantity FROM nims_store.stocks_tbl where item_id='".$item_id."'";
$res1	=	mysql_query($query1);
if(mysql_num_rows($res1)>0)
{   
while($row1=mysql_fetch_array($res1))
{
$quan=$row1['quantity'];
}
}

$val777=$quan+$noofitems;
$hiddentotal=$val777;

$update2="update nims_store.stocks_tbl set quantity='".$val777."' where item_id='".$item_id."'";

$rs4=mysql_query($update2) or die(mysql_error());


$message = "Items Transferred Successfully Item Rem"+$itemsrem+"No of Items"+$noofitems+"Voucherno"+$voucherno+"Hiddentotal"+$hiddentotal+"dd"+$val777;
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