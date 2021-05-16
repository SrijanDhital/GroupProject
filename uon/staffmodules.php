<?php
session_start();

require 'functions/connection.php';


$title = 'My Modules';
	$staff = $_SESSION['staff_id'];

	$stmt = $pdo->prepare('SELECT *FROM modules WHERE staff_id = "' . $staff . '"');

	$rows = $stmt->execute();

	$modules = $stmt->fetchAll();

	if(count($modules) > 0){

		foreach ($modules as $module)
		{
			$content = '<li><a href = "staffmodules?module=' . $module['module_id'] . '.php">' . $module['module_id'] . '-' . $module['module_name'] . '</a></li><br>';
		}
	}
	else{
		$content = 'Sorry, no content to display.';
	}

	require 'layout.php';
?>