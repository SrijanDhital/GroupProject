<!DOCTYPE html>
<html>
	<head>
		<!-- linking the css file -->
		<link rel="stylesheet" type="text/css" href="styles.css">

		<title><?php
		 echo $title; ?></title> <!-- title variable used to set page title -->
	</head>
	<body>
		<header>
			<section>
				<h1>UoN</h1>
			</section>
			
		</header>
		<nav>
			<ul>
				<!-- navigation items at the top -->
				<li><a href="index.php">Home</a></li>
				<li><a href="downloads.php">Downloads
				</a></li>
				<li><a href="#">Categories</a></li>
				<li><a href="about.php">About us</a></li>

				
			</ul>
		</nav>

		<img src="images/randombanner.php">
		<main>

			<!-- side bar navigation -->
			<nav>
				<ul>

					<?php

					//sidebar items to show when student is logged in
					if(isset($_SESSION['logged_as_student']) && ($_SESSION['logged_as_student'] == true))
					{

						echo '<li><a href="index.php">Home</a></li>
						<li><a href="studentmodules.php">My modules</a></li>
						<li><a href="announcement.php">Announcements</a></li>
						<li><a href="logout.php">Logout</a></li>';
					}

					else if(isset($_SESSION['logged_as_staff']) && ($_SESSION['logged_as_staff'] ==true))
					{
						echo '<li><a href="index.php">Home</a></li>
						<li><a href="staffModules.php">Modules</a></li>
						<li><a href="uploadfile.php">Upload File</a></li>
						<li><a href="staffAnnouncement.php">All Announcements</a></li>
						<li><a href="logout.php">Logout</a></li>';
					}
					//sidebar items to show when admin is logged in
					else if(isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true){
						echo '
						<li><a href="index.php">Admin Page</a><li>
						<li><a href="addStudent.php">Add a student</a></li>
					    <li><a href="addStaff.php">Add a Staff</a></li>
					    <li><a href="addAdmin.php">Add an Admin</a></li>
					    <li><a href="addModule.php">Add a Module</a></li>
					    <li><a href="logout.php">Log Out</a></li>';
					}
					//sidebar items to show when a guest visit the website
					else{
						echo '<li><a href="login.php">User Login</a></li>';
					}

						?>
				</ul>
			</nav>

			<article>

				<!-- main items of the body -->
				<?php echo $content; ?>

			</article>
		</main>
		<footer>
			&copy; University of Northampton
		</footer>

	</body>
</html>