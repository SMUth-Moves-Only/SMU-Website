<?php
include "header.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/course_file_upload.css">
  </head>
  <body>



      <div class="row">
        <!--select student-->
        <div class="column">
          <h1>Delete Students</h1>
          <div class="choosefile">
            <!--drop down list-->
            <form action="includes/course_student_add.inc.php" method="post" enctype="multipart/form-data">

              <select name="CourseSelect">
                <?php
                session_start();
                if (isset($_SESSION['course_info'])) {
                  for ($i = 0; $i < count($_SESSION['course_info']); $i++) {
                    echo '<option value="' . $_SESSION['course_info'][$i][0] . '">' . $_SESSION['course_info'][$i][2] . '</option>';
                  }
                } else {
                  echo '<option value="" disabled selected hidden>No Courses Available</option>';
                }
                ?>
              </select>

              <br>

              <label>Enter Student First Name:<input type="text" name="studentfname"></label><br>
              <label>Enter Student Last Name:<input type="text" name="studentlname"></label><br>
              <input type="submit" value="Delete Student" name="student-import"><br>
            </form>
          </div>
        </div>

        <!--select image-->
        <div class="column">
          <h1>Delete Instructor</h1>
          <div class="choosefile">
            <!--drop down list-->
            <form action="includes/course_student_add.inc.php" method="post" enctype="multipart/form-data">

              <select name="CourseSelect">
                <?php
                session_start();
                if (isset($_SESSION['course_info'])) {
                  for ($i = 0; $i < count($_SESSION['course_info']); $i++) {
                    echo '<option value="' . $_SESSION['course_info'][$i][0] . '">' . $_SESSION['course_info'][$i][2] . '</option>';
                  }
                } else {
                  echo '<option value="" disabled selected hidden>No Courses Available</option>';
                }
                ?>
              </select>

              <br>

              <label>Enter Instructor First Name:<input type="text" name="coursename"></label><br>
              <label>Enter Instructor Last Name:<input type="text" name="termnum"></label><br>
              <input type="submit" value="Delete Instructor" name="course-import">
            </form>
          </div>
        </div>
      </div>







<!--
    <h1>Assign Instructor</h1>
<br>
    <div class="assign">
      <label>Select CSV file:</label>
      <input type="file" name="fileToUpload" id="fileToUpload"><br>
      <button onclick="window.location='assign_instructor_success.php';" type="submit"> SUBMIT </button>
    </div>
-->

  </body>
</html>
