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
          <h1>Add Course</h1>
          <div class="choosefile">
            <!--drop down list-->
            <form action="includes/course_student_add.inc.php" method="post" enctype="multipart/form-data">



              <br>

              <label>Enter Course Name:<input type="text" name="studentfname"></label><br>
              <label>Enter Course Number:<input type="text" name="studentlname"></label><br>
              <input type="submit" value="Add Course" name="student-import"><br>
            </form>
          </div>
        </div>

        <!--select image-->
        <div class="column">
          <h1>Add Term</h1>
          <div class="choosefile">
            <!--drop down list-->
            <form action="includes/course_student_add.inc.php" method="post" enctype="multipart/form-data">


              <br>

              <label>Enter Term:<input type="text" name="coursename"></label><br>
              <label>Enter Term Year:<input type="text" name="termnum"></label><br>
              <input type="submit" value="Add Term" name="course-import">
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
