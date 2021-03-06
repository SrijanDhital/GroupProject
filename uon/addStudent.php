<?php

session_start();

if(isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true){

$title = 'Add Student';

//Connection to database
require 'functions/connection.php';


$content = '
	<h2>Add a Student</h2>
	<li><a href="deletestudent.php">Delete a student</a></li>
	
	<article>

		<form class="form" action="addStudent.php" method="post">
		
			<label>Firstname:</label>
				<input type="text" name="firstname" required />
			<label>Lastname:</label>
				<input type="text" name="lastname" required />
			<label>E-mail address:</label>
				<input type="text" placeholder="user@exampe.com" name="email" required />
			<label>Year:</label>
			<select name="year">
				<option value="" disabled selected>Select Year</option>
				<option value="L4">Level 4</option>
				<option value="L5">Level 5</option>
				<option value="L6">Level 6</option>
			</select>
			<label>Password:</label>
				<input type="password" placeholder="**********" name="password" required />
			<label>Confirm Password:</label>
				<input type="password" placeholder="**********" name="password2" required />

			<input type="submit" value="Add" name="submit" />
		</form>
	</article>
			';

if (isset($_POST['firstname'], $_POST ['lastname'], $_POST['email'], $_POST['year'], $_POST['password'], $_POST['password2'])) {

  	//Check to see if passwords match - IF not user account will not be created.
  	if ($_POST['password'] == $_POST['password2']) {


		//prepare statement to insert user information into users table
		$stmt = $pdo->prepare('INSERT INTO students (firstname, lastname, email, year, password)
															VALUES ( :firstname, :lastname, :email, :year, :password)');

		$criteria = [
			'firstname'=> $_POST['firstname'],
			'lastname'=>	$_POST['lastname'],
			'email'=> $_POST['email'],
			'year' => $_POST['year'],
			'password'=> $_POST['password']
		];

		unset($_POST['submit']);

		try{
		$stmt -> execute($criteria);

		echo '<script type="text/javascript">
		alert("Student ' . $_POST['email'] . ' has been successfully added");
		</script>';
  		// echo "Student " . $_POST['email'] . " has been successfully added";

  		} catch (PDOException $e) {
			   if ($e->errorInfo[1] == 1062) {
			      echo '<script type="text/javascript">
					alert("The email already exists.");
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
	header("Location: login.php");
}
?>