<?php
session_start();

if(isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true){

	require 'functions/connection.php';

	$title = 'Delete Staff';

	$content = '
    <h2>Delete Staff Account</h2>
    <form class="form" action="deleteadmin.php" method="post">
    <label>Staff to delete:</label>
      <select name="username">
      <option value="" disabled selected>Please Select</option>';


        $results = $pdo->prepare('SELECT * FROM staffs');
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

    //If delete button is pressed delete Staff username
    if (isset($_POST['username']))
    {
      $username=$_POST['username'];

      $stmt = $pdo->prepare('DELETE FROM staffs WHERE username= :username');
      $stmt->bindParam(":username", $username);

    	try{
    		$stmt->execute();

    		echo '<script type="text/javascript">
			alert("Staff ' . $username . ' has been successfully deleted");
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