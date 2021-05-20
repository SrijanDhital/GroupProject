<?php
session_start();

require 'functions/connection.php';

$module = $_GET['module'];
$title = 'Module Contents';

$content = '
<h2>Files of ' . $module . '</h2>
<article>';

$stmt = $pdo->prepare('SELECT *FROM module_contents WHERE module_id="' . $module . '"');
$stmt->execute();

foreach ($stmt as $row) {
	$content = $content . '<section><h3>' . $row['title'] . '</h3>
	<p>' . $row['description'] . '</p>
	<li><a href="download.php?name=' . $row['file_location'] . '" >Download</a></li></section>';

}

$content = $content . '</article>';

require 'layout.php';
?>