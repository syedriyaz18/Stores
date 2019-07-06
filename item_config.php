<?php
session_start();
$table = $_SESSION['tbl'];

?>
<?php

/*
		Author: Iwebux
		Description: configure db connection
		Copyright: iwebux.com
*/

define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','root');
define('DBNAME','nims_store');

$conn = mysql_connect(DBHOST,DBUSER,DBPASS);
	
mysql_select_db(DBNAME,$conn);

/*Check for data from the browser*/

if(isset($_POST['rownum']))
{
	update_data($_POST['field'],$_POST['value'],$_POST['rownum']);
}

/*Retrieve records from db*/
function get_data()
{
	$table=$_SESSION['tbl'];
	
	$sql = "select * from $table";
	
	$rs = mysql_query($sql);
	
	return $rs;
}
/*Update records in db*/
function update_data($field, $data, $rownum)
{

	$table=$_SESSION['tbl'];
	$sql = "update $table set ".$field." = '".$data."' where item_id = ".$rownum;
	echo"update ".$table." set ".$field." = '".$data."' where item_id = ".$rownum;
	mysql_query($sql) or die("Couldn't connect to db");
	
	
}


?>