<?php
	session_start();

	if(isset($_SESSION['logged_as_staff']) && ($_SESSION['logged_as_staff'] ==true)){

	require 'functions/connection.php';

	$title = 'Announcements';

	$staff = $_SESSION['staff_id'];

	$content = '<ul>
	<li><a href="postannouncement.php">New Announcement</a></li></ul>
	<h2>Announcements:</h2>
	<div class="announcement">
	';

	$query = $pdo->prepare('SELECT *FROM announcements WHERE staff_id = "' . $staff . '"');
	$query->execute();
	$anns = $query->rowCount();

	if($anns > 0){
		while($announcement = $query -> fetch(PDO::FETCH_ASSOC)){

			$content = $content . '<section><h3 style=color:#007061>' . $announcement['topic'] . '</h3>
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