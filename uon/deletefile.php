<?php
session_start();
if(isset($_SESSION['logged_as_staff']) && ($_SESSION['logged_as_staff'] ==true)){
	require 'functions/connection.php';
	$title = 'Delete a file';

	$content = '
	<h2>Delete a File</h2>

	<article>
		<form class="form" action="deletefile.php" method="POST">
			<label>Please select a file to delete:</label>
			<select name="title">
			<option value="" disabled selected>Please Select</option>';

			$staff = $_SESSION['staff_id'];

			$results = $pdo->prepare('SELECT * FROM module_contents WHERE staff_id="' . $staff . '"');
					$results->execute();

			foreach ($results as $row) {
				$content = $content . '
					<option value="' . $row['title'] .'">' . $row['title'] . '</option>';
			}
		$content = $content . 
			'
			</select>
			<input type="submit" value="Delete" name="submit" />
		</form>
	</article>
	';

	if(isset($_POST['title'])){

			$query = $pdo->prepare('SELECT *FROM module_contents WHERE title="' . $_POST['title'] . '"');
			$query->execute();

			if($loc = $query->fetch(PDO::FETCH_ASSOC)){
			$location = $loc['file_location'];
				

			if(!unlink($location)){

				echo '<script type="text/javascript">
				alert("There was an error. Please try again!");
				</script>';
			}
			else{
				$stmt = $pdo->prepare('DELETE FROM module_contents WHERE title ="' . $_POST['title'] . '"');

				try{
					$stmt->execute();

				}
				catch(PDOException $e){
					echo '<script type="text/javascript">
					alert("Error from: ' . $e->getMessage() . '");
					</script>';
				}

				echo '<script type="text/javascript">
					alert("The file "' . $_POST['title'] . '" has been deleted successfully");
					</script>';
			}

		}
		else{
			echo 'There was an error';
		}
			
	}

	require 'layout.php';
}
else{
	header("Location: login.php");
}
?>