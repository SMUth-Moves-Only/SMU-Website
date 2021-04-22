<?php
include "header.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <link rel="stylesheet" href="css/group_data.css">
  <meta charset="utf-8">
  <title>groupdata</title>
</head>

<body>

  <?php

  require 'includes/dbh.inc.php';

  if (isset($_POST['course-submit'])) {

    $courseID = $_POST['SelectCourse'];

    $sql = "SELECT * FROM student_group WHERE prof_course_id = ?;";

    $stmt = mysqli_stmt_init($conn);

    //helps keep database safe
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      //close the sqli connection to save resources
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
      header("Location: ../index.php?error=sqlerror");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "i", $courseID);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      //save the criterion as session variables for output on page
      $i = 0;
      echo "You will be scheduling evaluations for the following groups:"."<br>";
      while ($row = $result->fetch_assoc()) {
        $_SESSION['group_schedule'][$i] = $row["id"];
        echo "<p>" . $row["id"] . "</p><br>"; /////////THIS IS WHERE YOU PUT HTML AND CSS
        $i++;
      }
      //close the sqli connection to save resources
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
    }
  }

  ?>


<form action="includes/schedule_peer_eval.inc.php" method="post">
  <div class="data">
    <label>Start:</label>
    <input type="date" id="calendar" name="startdateselect">
    <label>End:</label>
    <input type="date" id="calendar" name="enddateselect">
    <br>
    <button type="submit" name="eval-schedule"> SUBMIT </button>
  </div>
</form>
</body>

</html>