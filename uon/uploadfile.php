<?php
session_start();
require 'functions/connection.php';
$title = 'Upload a file';

$content = '
<h2>Upload a file</h2>
<article>
	<form class="form" action="uploadfile.php" method="POST">
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
</article>';


if(isset($_POST['submit'])){
	if(isset($_POST['module'])){

		$filename = $_FILES['file']['name'];
		$fileextension = strtolower(substr($filename, strpos($filename, '.') + 1));
		$filesize = $_FILES['file']['size'];
		$filetype = $_FILES['file']['type'];

		$tmp_name = $_FILES['file']['tmp_name'];
		if(isset($filename)){
			if(!empty($filename)){
				if($fileextension != exe && $fileextension != bat){

					$location = 'files/' . $_POST['module'];

					if(move_uploaded_file($tmp_name, $location)){
						echo 'File has been successfully uploaded.';

					}
				}
				else{
					echo 'Error while uploading the file.';

				}
			}
			else{
				echo 'Please select a file';
			}
		}
	}
}

require 'layout.php';
?>
