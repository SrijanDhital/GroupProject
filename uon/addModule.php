<?php

session_start();

$title = 'Add Module';

//Connection to database
require 'functions/connection.php';


$content = '
	<h2>Add a Module</h2>
	
	<article>

		<form class="form" action="addModule.php" method="post">
		
			<label>Module id:</label>
				<input type="text" name="id" required />
			<label>Module Name:</label>
				<input type="text" name="name" required />

			<label>Assign Staff:</label>
			<select name="staff">
				<option value="" disabled selected>Select module</option>';

				$results = $pdo->prepare('SELECT * FROM staffs');
						$results->execute();

				foreach ($results as $row) {
					$content = $content . '
						<option value="' . $row['username'] . '">' . $row['username'].'</option>
					';
				}


	$content = $content . '
			</select>
			<label>Year:</label>
			<select name="year">
				<option value="" disabled selected>Select Year</option>
				<option value="L4">Level 4</option>
				<option value="L5">Level 5</option>
				<option value="L6">Level 6</option>
			</select>

				<input type="submit" value="Add" name="submit" />
		</form>
	</article>
			';

if (isset($_POST['id'], $_POST ['name'], $_POST['staff'], $_POST['year'])) {

	$query = $pdo->prepare('SELECT * FROM staffs WHERE username="' . $_POST['staff'] . '"');
	$result = $query->execute();
	while($staffexc = $query->fetch(PDO::FETCH_ASSOC))
	$staff = $staffexc['staff_id'];

	//prepare statement to insert user information into users table
	$stmt = $pdo->prepare('INSERT INTO modules(module_id, module_name, staff_id, year)
															VALUES ( :id, :name, :staff, :year)');

		$criteria = [
			'id'=> $_POST['id'],
			'name'=>	$_POST['name'],
			'staff'=> $staff,
			'year' => $_POST['year']
		];

		unset($_POST['submit']);
		$stmt -> execute($criteria);

		echo '<script type="text/javascript">
		alert("Module ' . $_POST['id'] . ' has been successfully added");
		</script>';
  		// echo "Student " . $_POST['email'] . " has been successfully added";
  				

  } //End of submit IF

  require 'layout.php';
?>