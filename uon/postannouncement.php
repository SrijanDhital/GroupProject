<?php
session_start();

if(isset($_SESSION['logged_as_staff']) && ($_SESSION['logged_as_staff'] ==true)){

require 'functions/connection.php';

$title = 'Post an Announcement';

$content = '<h2>Post an Announcement</h2>

<article>
	<form class="form" action="postannouncement.php" method="POST" enctype="multipart/form-data">

		<label>Topic:</label>
		<input type="text" name="topic" />

		<label>Description:</label>
		<textarea name="description"> </textarea> 
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
	<input type="submit" value="Announce" name="submit" />
	</form>
	</article>
	';

	if (isset($_POST['topic'], $_POST['description'], $_POST['module'])) {

	$query = $pdo->prepare('SELECT * FROM modules WHERE module_id="' . $_POST['module'] . '"');
	$result = $query->execute();
	while($yearexc = $query->fetch(PDO::FETCH_ASSOC))
	$year = $yearexc['year'];


		$stmt = $pdo->prepare('INSERT INTO announcements (topic, description, staff_id, year, posted_date) VALUES (:topic, :description, :staff_id, :year, :today)');

		$criteria = [
			'topic' => $_POST['topic'],
			'description' => $_POST['description'],
			'staff_id' => $staff,
			'year' => $year,
			'today' => date("F j,Y")
		];

		$stmt->execute($criteria);

		echo '<script type="text/javascript">
						alert("Announcement ' . $_POST['topic'] . ' has been posted successfully.");
						</script>';
	}


require 'layout.php';
}
else{
	header("Location: login.php");
}
?>