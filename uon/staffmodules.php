<?php
session_start();

if(isset($_SESSION['logged_as_staff']) && ($_SESSION['logged_as_staff'] ==true)){
require 'functions/connection.php';


$title = 'My Modules';

$content = '<h2>My Modules</h2><article>';

	$staff = $_SESSION['staff_id'];

	$results = $pdo->prepare('SELECT *FROM modules WHERE staff_id ="' . $staff . '"');

	$results->execute();

	$modules = $results->rowCount();

	if($modules > 0){
		$content = $content . '<ul>';
		foreach($results as $row)
		{
			$content = $content . '<li><a href = "modulecontents.php?module=' . $row['module_id'] . '">=> ' . $row['module_id'] . ' - ' . $row['module_name'] . '</a></li><br>';
		}
		$content = $content . '</ul></article>';
	}
	else{
		$content = $content . '<h3>Sorry, no content to display.</h3>';
	}

	require 'layout.php';

}
else{
	header("Location: login.php");
}
?>