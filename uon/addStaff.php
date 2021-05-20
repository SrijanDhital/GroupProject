<?php

session_start();
if(isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true){
$title = 'Add Staff';

//Connection to database
require 'functions/connection.php';


$content = '
	<h2>Add a Staff</h2>
	<li><a href="deletestaff.php">Delete a Staff</a></li>
	
	<article>

		<form class="form" action="addStaff.php" method="post">
		
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

			<input type="submit" value="Add" name="submit" />
		</form>
	</article>
			';

if (isset($_POST['firstname'], $_POST ['lastname'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['password2'])) {

  	//Check to see if passwords match - IF not user account will not be created.
  	if ($_POST['password'] == $_POST['password2']) {



		//prepare statement to insert user information into users table
		$stmt = $pdo->prepare('INSERT INTO staffs (firstname, lastname, email, username, password)
															VALUES ( :firstname, :lastname, :email, :username, :password)');

		$criteria = [
			'firstname'=> $_POST['firstname'],
			'lastname'=>	$_POST['lastname'],
			'email'=> $_POST['email'],
			'username' => $_POST['username'],
			'password'=> $_POST['password']
		];

		unset($_POST['submit']);

		try{
		$stmt -> execute($criteria);

		echo '<script type="text/javascript">
		alert("Staff ' . $_POST['username'] . ' has been successfully added");
		</script>';
  		// echo "Staff " . $_POST['username'] . " has been successfully added";

  		} catch (PDOException $e) {
			   if ($e->errorInfo[1] == 1062) {
			      echo '<script type="text/javascript">
					alert("The email or username already exists.");
					</script>';
			   } else {
			      echo '<script type="text/javascript">
					alert("Error from: ' . $e->getMessage() . '");
					</script>';
			   }
			}

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
	// echo 'Please login as an admin first.';
	header("Location: login.php");
}
?>
