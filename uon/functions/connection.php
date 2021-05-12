<?php
// function connect(){
	$server = 'localhost';
	$username = 'root';
	$password = '';
	$schema = "uon"; //name of database


	//Connection being made to MySQL database.
	$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password, [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
// }

?>