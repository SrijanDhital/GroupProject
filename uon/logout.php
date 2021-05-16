<?php
	$title = 'Logged out';
	session_start();

	//logs out of either admin or user
	unset($_SESSION['logged_as_staff']);
	unset($_SESSION['logged_as_student']);
	unset($_SESSION['logged_as_admin']);
	echo 'You are now logged out';

	echo 'You are now logged out';
	header("Location:login.php");

	require 'layout.php';
?>