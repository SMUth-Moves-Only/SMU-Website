<?php
include "header.php";
?>

<!--Dropdown menus for course title and course ID. Populate both dropdown menus from student's available courses-->
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>coursedetails</title>

  <link rel="stylesheet" href="css/coursedetails.css">

</head>

<body>

  <div class="courseInfo">
    <h1>Course Details</h1>

    <p><label>Course Title
    <input type="text" name="CourseTitle">
    </label></p>

    <p><label>Course ID
    <input type="text" name="CourseID">
    </label></p>

    <p><label>Instructor
    <input type="text" name="Instructor">
    </label></p>

    <p><label>Term
    <input type="text" name="Term">
    </label></p>

    <p><label>Course Number
    <input type="text" name="Course Number">
    </label></p>


  </div>

  <div class="buttons">
  <button onclick="window.location='includes/student_login.inc.php';">Go to Peer Evaluation</button>
</div>

</body>

</html>
