<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
ob_start();

$localhost = true;

if($localhost){
	$servername = "localhost";
	$username = "root";
	$password = "Krishan@1998";
	$dbname = "zoylo";
}
else{
	$servername = "localhost";
	$username = "starzwci_zoylo1";
	$password = "2.CUb}[E+Im;";
	$dbname = "starzwci_zoylo1";
	
}


// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}



?>