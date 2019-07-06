<?php
	// configuration
	$dbtype     = "sqlite";
	$dbhost     = "localhost";
	$dbname     = "nimsstore";
	$dbuser     = "root";
	$dbpass     = "root";
	 
	// database connection
	$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
?> 