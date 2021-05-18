<?php
session_start();
	
	$title = 'Announcements';

	$content = '<h2>All Announcements</h2>';
	
	$year = $_SESSION['year'];
	$sId = $_SESSION['staff_id'];

	require 'functions/connection.php';

	$stmt = $pdo-> prepare('SELECT topic, description, students.year, staffs.username as sName, modules.module_id as mId, modules.module_name FROM modules, announcements, students, staffs WHERE staffs.staff_id=announcements.staff_id AND staffs.staff_id=modules.staff_id AND modules.year=students.year AND students.year=announcements.year ORDER BY announcements.announcement_id DESC');

	$stmt->execute();
	$announcements = $stmt -> fetch(PDO::FETCH_ASSOC);

	foreach ($stmt as $announcement) {
		$content = $content . 
		'<h2>' . $announcement['sName'] . '</h2>
		<h2>' . $announcement['mId'] . '-' . $announcement['module_name'] . '</h2>

		<h3>' . $announcement['topic'] . '</h3>
		<p>' . $announcement['description'] . '</p>
		<center>------------------------------------------------------------------</center>';
	}

	require 'layout.php';
?>