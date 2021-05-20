<?php
		session_start();

		require 'functions/connection.php';

		$title = 'UoN-Home';


		if(isset($_SESSION['logged_as_admin']) && ($_SESSION['logged_as_admin'] = true))
		{
			$content = '<h2>Welcome to Your UoN Page.</h2>

			<section>
			<h3>As an Admin You are able to:</h3>
			<p>=> Add or Delete Admin\' Accounts<br>
			=> Add or Delete Staff\'s Accounts<br>
			=> Add or Delete Student\'s Accounts<br>
			=> Add or Delete Modules.</p></section>
			';
		}
		
		else if((isset($_SESSION['logged_as_staff']) && ($_SESSION['logged_as_staff'] == true))){
			$content = '<h2>Welcome to your UoN staff page.</h2>';
			$staff = $_SESSION['staff_id'];
			$query = $pdo->prepare('SELECT *FROM announcements WHERE staff_id="' . $staff . '" ORDER BY posted_date DESC');
			$query->execute();
			
			if($announcement = $query->fetch(PDO::FETCH_ASSOC)){
				$content = $content . '<section><h3 style=color:#007061>' . $announcement['topic'] . '</h3>
				<h5>' . $announcement['module_id'] . ' (' . $announcement['posted_date'] . ')
				<p>' . $announcement['description'] . '</p></section>';
			}
			else{
				$content = $content . '<h3>No Announcements Yet</h3>';
			}
			
			
		}
		else if(isset($_SESSION['logged_as_student']) && ($_SESSION['logged_as_student'] == true)){
			$content = '<h2>Welcome to your UoN Student page.</h2>';
			$year = $_SESSION['year'];
			$query = $pdo->prepare('SELECT *FROM announcements WHERE year="' . $year . '" ORDER BY posted_date DESC');
			$query->execute();
			
			if($announcement = $query->fetch(PDO::FETCH_ASSOC)){
				$content = $content . '<section><h3 style=color:#007061>' . $announcement['topic'] . '</h3>
				' . $announcement['module_id'] . ' (' . $announcement['posted_date'] . ')
				<p>' . $announcement['description'] . '</p></section>';
			}
			else{
				$content = $content . '<h3>No Announcements Yet</h3>';
			}
		}
		else {

			header("Location: login.php");
		}

		require 'layout.php';
?>