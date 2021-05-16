<?php
	$year = $_SESSION['year'];
	$sId = $_SESSION['staff_id'];

	require 'functions/connection.php';

	$stmt = $pdo-> prepare('SELECT topic, description, students.year, staffs.username as sName, modules.module_id as mId, modules.module_name FROM modules, announcements, students, staffs WHERE staffs.staff_id=announcements.staff_id AND staffs.staff_id=modules.staff_id AND modules.year=students.year AND students.year=announcements.year ORDER BY announcements.announcement_id DESC');

	$rows = $stmt->execute();
	$announcements = $rows -> fetch_assoc();

	foreach ($announcements as $announcement) {
		echo '<h2>' . $announcement['sName'] . '</h2>';
		echo '<h2>' . $announcement['mId'] . '-' . $announcement['module_name'] . '</h2>';

		echo '<h3>' . $announcement['topic'] . '</h3>';
		echo '<p>' . $announcement['description'] . '</p>';
		echo '<center>------------------------------------------------------------------</center>';
	}
?>