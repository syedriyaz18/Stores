<?php 
include('header.php');

// First of all, don't make use of mysql_* functions, those are old
$pdo = new PDO("mysql:host=localhost;dbname=nims_store;charset=utf8", "root", "root");
?>
	
	
<div id="page_content">

<div class="row-fluid">
    <div class="span12">
	<div class="alert alert-success"><center>Add Room Items</center></div>
     <form class="form-horizontal" action="" method="post" >
       <fieldset>
			<div class="control-group">
			<label class="control-label" style="text-align:left;display: block;">Department Name</label>
                    <div class="controls">
					
                       <select id="dept_id"name="dept_id" style="width: auto;">
                            <option value="<?php echo isset($_POST['dept_id']) ? $_POST['dept_id'] : '' ?>">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT dept_id,room_no FROM dept_tbl order by room_no");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['dept_id']; ?>"><?php echo $row ['room_no']; ?></option><?php
                            }
                        ?>
                        </select>
						
                    </div>
                </div>

				<div class="control-group">
                    <label class="control-label" style="text-align:left;display: block;">Item To Issue</label>
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
						</div>
					
                </div>
				
         
          
			<div class="control-group">
					<label class="control-label" style="text-align:left;display: block;">No Of Items</label>
					<div class="controls">
						<input id="noofitems" name="noofitems" type="text">						
					</div>
			</div>
			
			
     <div class="alert alert-success"><center><button onclick="myFunction();return false">Add To List</button></div>
			
   <table  align="center" id="myTable" border="1"> 
	<thead>
          <tr>
            <th>Item Name</th>
			<th>No Of Items Issued</th>
			<th>Delete</th>
          </tr>
		  
      </thead><tr>

</table><br>



<script>
function myFunction() {
    var table = document.getElementById("myTable");
	var rowLength = table.rows.length;
		var x = document.getElementById("item_id").selectedIndex;
		var y = document.getElementById("item_id").options;
		var xx = document.getElementById("item_id").value;
		
		
		var noofitems = document.getElementById("noofitems").value;
		
		
		
		

    var row = table.insertRow(rowLength);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
	var cell3 = row.insertCell(2);
	var cell4 = row.insertCell(3);
	var cell5 = row.insertCell(4);
	
        var element1 = document.createElement("input");
        element1.type = "hidden";
        element1.name="item_id[]";
		element1.value=xx;
        cell1.appendChild(element1);
		
		var element2 = document.createElement("input");
        element2.type = "text";
        element2.name="item_name[]";
		element2.value=y[x].text;
        cell2.appendChild(element2);
		
		
		
		var element3 = document.createElement("input");
        element3.type = "text";
        element3.name="noofitems[]";
		element3.value=noofitems;
        cell3.appendChild(element3);
		
			 
	cell4.innerHTML = '<input id="Button" type="button" value="DeleteRow" onclick="deleteRow();"/>';
	
	
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
 foreach ($_POST['item_id'] as $key => $value) {
 
 
$dept_id=$_POST['dept_id'];
$item_id=$_POST['item_id'][$key];
$noofitems=$_POST['noofitems'][$key];

$user=$_SESSION['login'];
Print "<b>Quantity:</b> $quantity"; 
Print "<b>No OF Items:</b> $hiddentotal"; 
if(empty($noofitems) || empty($issueindentno) || empty($ivno) || empty($ivdate)){

	echo "<label class='err'>All fields are required</label>";
	}
	else{
	if($noofitems>0)
	{
$insert1="Insert into nims_store.roomsdata_tbl(room_id,item_id,quantity,)
 values('".$dept_id."','".$item_id."','".$noofitems."')";

$rs=mysql_query($insert1) or die(mysql_error());

$message = "Items Added Successfully";
echo "<script type='text/javascript'>alert('$message');</script>";
}
else{
$message = "Sorry! No Stock Items to Add";
echo "<script type='text/javascript'>alert('$message');</script>";
}
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