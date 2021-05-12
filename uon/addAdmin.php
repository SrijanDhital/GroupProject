<?php

session_start();

if(isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin']==true){


	$title = 'Add Admin';

	//Connection to database
	require 'functions/connection.php';


	$content = '
		<h2>Add an Admin</h2>
		
		<article>

			<form class="form" action="addAdmin.php" method="post">
			
				<label>Firstname:</label>
					<input type="text" name="firstname" required />
				<label>Lastname:</label>
					<input type="text" name="lastname" required />
				<label>E-mail address:</label>
					<input type="text" placeholder="user@exampe.com" name="email" required />
				<label>Username:</label>
					<input type="text" placeholder="EdwardJobs" name="username" required />
				<label>Password:</label>
					<input type="password" placeholder="**********" name="password" required />
				<label>Confirm Password:</label>
					<input type="password" placeholder="**********" name="password2" required />

				<input type="submit" value="Submit" name="submit" />
			</form>
		</article>
				';

	if (isset($_POST['firstname'], $_POST ['lastname'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['password2'])) {

	  	//Check to see if passwords match - IF not user account will not be created.
	  	if ($_POST['password'] == $_POST['password2']) {


			//prepare statement to insert user information into users table
			$stmt = $pdo->prepare('INSERT INTO admins (firstname, lastname, email, username, password)
																VALUES ( :firstname, :lastname, :email, :username, :password)');

			$criteria = [
				'firstname'=> $_POST['firstname'],
				'lastname'=>	$_POST['lastname'],
				'email'=> $_POST['email'],
				'username' => $_POST['username'],
				'password'=> $_POST['password']
			];

			unset($_POST['submit']);
			$stmt -> execute($criteria);

			echo '<script type="text/javascript">
			alert("Admin ' . $_POST['username'] . ' has been successfully added");
			</script>';
	  		// echo "Admin " . $_POST['username'] . " has been successfully added";

	  	}
	  	else{
	  		echo '<script type="text/javascript">
			alert("The passwords did not match. Please try again!");
			</script>';
	  	}
	  				

	} //End of submit IF

	require 'layout.php';
}
else{

	// echo '<script type="text/javascript">
	// 		alert("Please login as an admin first");
	// 		</script>';
			header("Location: login.php");
}

?>