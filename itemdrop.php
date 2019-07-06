<?php
#Include the connect.php file
include('dbcon.php');

// get data and store in a json array
$query = "SELECT * FROM item_tbl";

 
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $Items[] = array(
        'item_name' => $row['item_name'],
        
      );
}
 
echo json_encode($Items);
?>