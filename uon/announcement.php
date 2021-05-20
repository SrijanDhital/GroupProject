<?php
session_start();

if(isset($_SESSION['logged_as_student']) && ($_SESSION['logged_as_student'] == true)){
	$title = 'Announcements';

	$content = '<h2>All Announcements</h2>';
	
	$year = $_SESSION['year'];
	// $sId = $_SESSION['staff_id'];

	require 'functions/connection.php';

	$query = $pdo-> prepare('SELECT *FROM announcements WHERE year = "' . $year . '"');

	$query->execute();
	$anns = $query->rowCount();

	if($anns > 0){
		while($announcement = $query -> fetch(PDO::FETCH_ASSOC)){

			

			$content = $content . '<section><h3 style=color:#007061>' . $announcement['topic'] . '</h3>
			<h5>' . $announcement['module_id'] . ' (' . $announcement['posted_date'] . ')</h5>
			<p>' . $announcement['description'] . '</p></section>';
			
		}
	}
	else{
		$content = $content . '<h3>There are no announcements yet.</h3>';
	}

	$content = $content . '</div>';

	require 'layout.php';
}
else{
	header("Location: login.php");
}
?>