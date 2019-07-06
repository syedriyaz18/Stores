<?php
/*
Site : http:www.smarttutorials.net
Author :muni
*/
require_once 'auto/config.php';

if($_GET['type'] == 'dept'){
	$result = mysql_query("SELECT dept_name FROM dept_tbl where dept_name LIKE '".strtoupper($_GET['name_startsWith'])."%'");	
	$data = array();
	while ($row = mysql_fetch_array($result)) {
		array_push($data, $row['dept_name']);	
	}	
	echo json_encode($data);
}

if($_GET['type'] == 'supplier'){
	$row_num = $_GET['row_num'];
	$result = mysql_query("SELECT supplier_name FROM supplier_tbl where supplier_name LIKE '".strtoupper($_GET['name_startsWith'])."%'");	
	$data = array();
	while ($row = mysql_fetch_array($result)) {
		
		array_push($data, $row['supplier_name']);	
	}	
	echo json_encode($data);
}

if($_GET['type'] == 'item'){
	$row_num = $_GET['row_num'];
	$result = mysql_query("SELECT item_name FROM item_tbl where item_name LIKE '".$_GET['name_startsWith']."%'");	
	$data = array();
	while ($row = mysql_fetch_array($result)) {
		
		array_push($data, $row['item_name']);	
	}	
	echo json_encode($data);
}

if($_GET['type'] == 'country_no'){
	$row_num = $_GET['row_num'];
	$result = mysql_query("SELECT name, numcode, phonecode, iso3 FROM country where numcode LIKE '".$_GET['name_startsWith']."%'");	
	$data = array();
	while ($row = mysql_fetch_array($result)) {
		$name = $row['name'].'|'.$row['numcode'].'|'.$row['phonecode'].'|'.$row['iso3'].'|'.$row_num;
		array_push($data, $name);	
	}	
	echo json_encode($data);
}
if($_GET['type'] == 'country_code'){
	$row_num = $_GET['row_num'];
	$result = mysql_query("SELECT name, numcode, phonecode, iso3 FROM country where iso3 LIKE '".$_GET['name_startsWith']."%'");	
	$data = array();
	while ($row = mysql_fetch_array($result)) {
		$name = $row['name'].'|'.$row['numcode'].'|'.$row['phonecode'].'|'.$row['iso3'].'|'.$row_num;
		array_push($data, $name);	
	}	
	echo json_encode($data);
}

if($_GET['type'] == 'fruit'){
	$result = mysql_query("SELECT DISTINCT fruit FROM names where LOWER(fruit) LIKE '".strtoupper($_GET['name_startsWith'])."%' AND fruit !='' order by TRIM(fruit) ASC");	
	$data = array();
	while ($row = mysql_fetch_array($result)) {
		$name = $row['fruit'];
		array_push($data, $name);	
	}	
	echo json_encode($data);
}

if($_GET['type'] == 'baby'){
	$result = mysql_query("SELECT DISTINCT human FROM names where LOWER(human) LIKE '".strtoupper($_GET['name_startsWith'])."%' AND human !='' order by human ASC");	
	$data = array();
	while ($row = mysql_fetch_array($result)) {
		$name = $row['human'];
		array_push($data, $name);	
	}	
	echo json_encode($data);
}
?>