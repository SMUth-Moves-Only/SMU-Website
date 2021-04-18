<?php
include "header.php";
if (!isset($_SESSION['student_id'])) {
  header("Location: ./?error=notloggedin");
  exit();
}
?>


<!--Dropdown menus for course title and course ID. Populate both dropdown menus from student's available courses-->
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Student Portal</title>

  <link rel="stylesheet" href="css/studentportal.css">


</head>

<body>

  <div>

    <h1>Student Portal</h1>
    <br>
    <?php
    if (isset($_SESSION['fName']) && isset($_SESSION['lName']) && isset($_SESSION["professor_id"])) {
      echo '<h2 style="text-align: center" name="welcome">Welcome ' . $_SESSION['fName'] . " " . $_SESSION['lName'] . '</h2>';
    }
    ?>
    <br>
  </div>

  <div class="courseInfo">

    <h2 style="float: left">Course Information</h2><br><br><br><br>

    <!--course title-->
    <form action="" method="post" name="welcome">
      <label>Course Title </label>
      <select id="CourseSelect">
        <?php
        if (isset($_SESSION['courses'])) {
          for ($i = 0; $i < count($_SESSION['courses']); $i++) {
            echo '<option>' . $_SESSION['courses'][$i] . '</option>';
          }
        } else {
          echo '<option value="" disabled selected hidden>No Courses Available</option>';
        }
        ?>
      </select>
    </form>
    </label></p>

    <!--course id-->
    <form action="" method="post" name="welcome2">
      <label>Course ID </label>
      <select id="CourseID">
        <?php
        if (isset($_SESSION['courses'])) {
          for ($i = 0; $i < count($_SESSION['courses']); $i++) {
            echo '<option>' . $_SESSION['courses'][$i] . '</option>';
          }
        } else {
          echo '<option value="" disabled selected hidden>No Course ID Available</option>';
        }
        ?>
      </select>
    </form>
    </label></p>



    <div class="buttons">
      <button onclick="window.location='coursedetails.php';">Submit</button>
    </div>

  </div>

</body>

</html>
