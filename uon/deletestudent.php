<?php
session_start();

if(isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true){

  require 'functions/connection.php';

  $title = 'Delete Student';

  $content = '
    <h2>Delete Student Account</h2>
    <form class="form" action="deletestudent.php" method="post">
    <label>Student to delete:</label>
      <select name="email">
      <option value="" disabled selected>Please Select</option>';


        $results = $pdo->prepare('SELECT * FROM students');
        $results->execute();

        foreach ($results as $row)
        {
          $content = $content. '
          <option value="'. $row['email'].'">'. $row['email'].'</option>';
        }

    $content = $content.'
      </select>
        <input type="submit" value="Delete" name="submit" />
    </form>
    ';

    //If delete button is pressed delete Student email
    if (isset($_POST['email']))
    {
      $email=$_POST['email'];

      $stmt = $pdo->prepare('DELETE FROM students WHERE email= :email');
      $stmt->bindParam(":email", $email);

      try{
        $stmt->execute();

        echo '<script type="text/javascript">
      alert("Student ' . $email . ' has been successfully deleted");
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