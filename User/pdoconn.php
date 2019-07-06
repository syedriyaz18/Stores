<?php
	// configuration
	$dbtype     = "sqlite";
	$dbhost     = "localhost";
	$dbname     = "nimsstore";
	$dbuser     = "root";
	$dbpass     = "";
	 
	// database connection
	$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
?> 