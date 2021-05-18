<?php

try {

$server = 'localhost';
$user = 'root';
$password = '';
$db = 'uon';

if ($pdo = new PDO("mysql:host=$server;dbname=$db",$user,$password)) {
	
	// echo "Connected!!";

}else{

	echo "Sorry Somting went wrong!!";

}
	
} catch (Exception $e) {

	echo "Error on".$e->getMessage();
	
}


?>