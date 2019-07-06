<?php
#Include the connect.php file
include('dbcon.php');

// get data and store in a json array
$query = "SELECT * FROM supplier_tbl";

 
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $Suppliers[] = array(
        'supplier_name' => $row['supplier_name'],
        
      );
}
 
echo json_encode($Suppliers);
?>