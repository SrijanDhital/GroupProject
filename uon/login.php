
<?php
	session_start();	

	require 'functions/connection.php';

	$loginform = '
	<h2>Login to Northampton News</h2>
	<article>
	<form class="form" action="login.php" method="post">
		<label>Username:</label>
				<input type="text" name="username" placeholder="Username or email" required />
		<label>Password:</label>
			<input type="password" name="password" placeholder="**********" required />
		<input type="submit" value="Login" name="submit" />
	</form>
	</article>
	';

	if (isset($_POST['submit'])) {
		if (isset($_POST['username'], $_POST['password'])) {

			$stmt = $pdo-> prepare('SELECT *FROM students;');
			$result = $stmt->execute();

			while($student = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				if($student['email'] == $_POST['username'] && $student['password'] == $_POST['password']){

					$_SESSION['year'] = $student['year'];
					$_SESSION['logged_as_student'] = true;
					$_SESSION['logged_as_staff'] = false;


					header("Location: index.php");

						echo '<script type="text/javascript">
						alert("Logged in as ' . $_POST['username'] . '.");
						</script>';
				}
				else{
					echo '<script type="text/javascript">
						alert("The username or password is incorrect");
						</script>';
				}
			}


			$stmt = $pdo-> prepare('SELECT *FROM staffs;');
			$result = $stmt->execute();

			while($staff = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				if($staff['username'] == $_POST['username'] && $staff['password'] == $_POST['password']){

					$_SESSION['staff_id'] = $staff['staff_id'];
					$_SESSION['logged_as_staff']  = true;
					$_SESSION['logged_as_student'] = false;
					
					header("Location: index.php");

					echo '<script type="text/javascript">
						alert("Logged in as ' . $_POST['username'] . '.");
						</script>';
					// echo 'Successfully logged in as a Staff';
				}
				else{
					echo '<script type="text/javascript">
						alert("The username or password is incorrect");
						</script>';
				}
			}

			$stmt = $pdo-> prepare('SELECT *FROM admins;');
			$result = $stmt->execute();

			while($admin = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				if($admin['username'] == $_POST['username'] && $admin['password'] == $_POST['password']){

					$_SESSION['username'] = $admin['username'];
					$_SESSION['logged_as_admin'] = true;
					$_SESSION['logged_as_staff']  = false;
					$_SESSION['logged_as_student'] = false;
					
					header("Location: index.php");

					echo '<script type="text/javascript">
						alert("Logged in as ' . $_POST['username'] . '.");
						</script>';
					// echo 'Successfully logged in as a Staff';
				}
				else{
					echo '<script type="text/javascript">
						alert("The username or password is incorrect");
						</script>';
				}
			}
			
		}
	}

	// require 'layout.php';
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>Northampton News - Login</title>
</head>
<body>
	<div class="login">
		<?php echo $loginform; ?>
	</div>
</body>
</html>