<?php
session_start();

if(isset($_SESSION['logged_as_staff']) && ($_SESSION['logged_as_staff'] ==true)){
require 'functions/connection.php';
$title = 'Upload a file';

$content = '
<h2>Upload a file</h2>
<li><a href="deletefile.php">Delete a file</a></li>
<article>
	<form class="form" action="uploadfile.php" method="POST" enctype="multipart/form-data">
		<label>Title:</label>
		<input type="text" name="title" />

		<label>Description:</label>
		<textarea name="description"></textarea>
		<label>Module:</label>
			<select name="module">
			<option value="" disabled selected>Please Select</option>';

			$staff = $_SESSION['staff_id'];

			$results = $pdo->prepare('SELECT * FROM modules WHERE staff_id="' . $staff . '"');
					$results->execute();

			foreach ($results as $row) {
				$content = $content . '
					<option value="' . $row['module_id'] .'">' . $row['module_id'] . '</option>';
			}

	$content = $content . '
		</select>
		<label>Upload file:</label>
			<input type="file" value="file" name="file" />

		<input type="submit" value="Upload" name="submit" />
	</form>

</article>
';


// if(isset($_POST['submit'])){
	//$file = $_FILES['file'];
	if(isset($_POST['title'], $_POST['description'], $_POST['module'])){

		$filename = $_FILES['file']['name'];
		$fileextension = strtolower(substr($filename, strpos($filename, '.') +1));
		// $filesize = $_FILES['file']['size'];
		$filetype = $_FILES['file']['type'];

		$tmp_dir = $_FILES['file']['tmp_name']; //directory from where file is being moved
		if(isset($filename)){
			if($filename != ""){
				if($fileextension != 'exe' && $fileextension != 'bat'){

					$location = 'files/' . $_POST['module'] . '/';

					if(move_uploaded_file($tmp_dir, $location . $filename)){

						$stmt = $pdo->prepare('INSERT INTO module_contents (title, description, module_id, staff_id, file_name, file_location) VALUES(:title, :description, :module, :staff, :name, :file_location)');

						$criteria = [
							'title' => $_POST['title'],
							'description' => $_POST['description'],
							'module' => $_POST['module'],
							'staff' => $staff,
							'name' => $filename,
							'file_location' => $location . $filename
						];
						try{
							$stmt->execute($criteria);

							// echo 'File has been successfully uploaded.';
							echo '<script type="text/javascript">
							alert("The file has been added successfully");
							</script>';
						}
						catch(PDOException $e){
							if ($e->errorInfo[1] == 1062) {
			      				echo '<script type="text/javascript">
								alert("The name already exists.");
								</script>';
							} else {
							    echo '<script type="text/javascript">
								alert("Error from: ' . $e->getMessage() . '");
								</script>';
							}
						}

					}
				}
				else{
					// echo 'Error while uploading the file.';
					echo '<script type="text/javascript">
						alert("Error while uploading the file.");
						</script>';

				}
			}
			else{
				// echo 'Please select a file';
				echo '<script type="text/javascript">
						alert("Please select a file");
						</script>';
			}
		}
	}
// }

require 'layout.php';

}else
{
	header("Location: login.php");
}
?>
