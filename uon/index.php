<?php
		session_start();

		$title = 'UoN-Home';


		if((isset($_SESSION['logged_as_student']) && ($_SESSION['logged_as_student'] == true)) || (isset($_SESSION['logged_as_staff']) && ($_SESSION['logged_as_staff'] == true)) || (isset($_SESSION['logged_as_admin']) && ($_SESSION['logged_as_admin'] = true)))
					{
						$content = '<h2>Welcome to Your UoN Page.</h2>';
					}
					else {

						header("Location: login.php");
					}

		require 'layout.php';
?>