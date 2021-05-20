<?php
session_start();

if(isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true){

	require 'functions/connection.php';

	$title = 'Delete Admin';

	$content = '
    <h2>Delete Admin Account</h2>
    <form class="form" action="deleteadmin.php" method="post">
    <label>Admin to delete:</label>
      <select name="username">
      <option value="" disabled selected>Please Select</option>';


        $results = $pdo->prepare('SELECT * FROM admins');
        $results->execute();

        foreach ($results as $row)
        {
          $content = $content. '
          <option value="'. $row['username'].'">'. $row['username'].'</option>';
        }

    $content = $content.'
      </select>
        <input type="submit" value="Delete" name="submit" />
    </form>
    ';

    //If delete button is pressed delete Admin username
    if (isset($_POST['username']))
    {
      $username=$_POST['username'];

      $stmt = $pdo->prepare('DELETE FROM admins WHERE username= :username');
      $stmt->bindParam(":username", $username);

    	try{
    		$stmt->execute();

    		echo '<script type="text/javascript">
			alert("Admin ' . $username . ' has been successfully deleted");
			</script>';

  		}
  		catch(PDOException $e){
  			echo '<script type="text/javascript">
					alert("Error from: ' . $e->getMessage() . '");
					</script>';
  		}


    }

    require 'layout.php';
}
else{
	header("Location: login.php");
}
?>