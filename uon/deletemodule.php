<?php
session_start();

if(isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true){

	require 'functions/connection.php';

	$title = 'Delete Module';

	$content = '
    <h2>Delete Module</h2>
    <form class="form" action="deletemodule.php" method="post">
    <label>Module to delete:</label>
      <select name="module">
      <option value="" disabled selected>Please Select</option>';


        $results = $pdo->prepare('SELECT * FROM modules');
        $results->execute();

        foreach ($results as $row)
        {
          $content = $content. '
          <option value="'. $row['module_id'].'">'. $row['module_id'].'</option>';
        }

    $content = $content.'
      </select>
        <input type="submit" value="Delete" name="submit" />
    </form>
    ';

    //If delete button is pressed delete Student module
    if (isset($_POST['module']))
    {
      $module=$_POST['module'];

      $stmt = $pdo->prepare('DELETE FROM modules WHERE module_id= :module');
      $stmt->bindParam(":module", $module);

      try{
        $stmt->execute();

        echo '<script type="text/javascript">
      alert("Module ' . $module . ' has been successfully deleted");
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