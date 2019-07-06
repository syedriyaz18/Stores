<?php
session_start();
$table = $_SESSION['tbl'];
$URL=$_SESSION['url'];
?>
<html>
<body>
<?php

include('dbcon.php');

if(isset($_GET['rownum']))
{
$id=$_GET['rownum'];
//$query0=mysql_query("select * from ".$table." where sno='$id'");

$query1=mysql_query("delete from ".$table." where item_id='$id'");
if($query1)
{
$URL=$_SESSION['url'];
header('location:'.$URL.'.php');
}
}
?>
</body>
</html>