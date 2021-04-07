<?php
include "header.php";
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/course_file_upload.css">
<body>

<!--file directions
  <div class="fileinfo">
    <p>Student file should be in .csv format.</p>
    <p>File should have rows in order: id, first_name, <br>
    last_name, major, email_address, <br>
    student_password</p>
  </div>
<br>
-->

<!--
  <form action="includes/professor_student_add.inc.php" method="post" enctype="multipart/form-data">

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
        </select><br>
        </form>
-->

<div class="row">
  <!--select student-->
  <div class="column">
    <h1>Import Students</h1>
      <div class="choosefile">
        <!--drop down list-->
        <form action="includes/professor_student_add.inc.php" method="post" enctype="multipart/form-data">
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
        </form>

        <label>Select Student File:</label>
        <input type="file" name="fileToUpload" id="fileToUpload"><br>
        <label>Enter Student Name:<input type="text" name="studentname"></label><br>
        <input type="submit" value="Import Student" name="student-import"><br>
      </div>
  </div>

  <!--select image-->
  <div class="column">
    <h1>Import Courses</h1>
      <div class="choosefile">
        <!--drop down list-->
        <form action="includes/professor_student_add.inc.php" method="post" enctype="multipart/form-data">
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
        </form>

        <form action="includes/professor_course_add.inc.php" method="post" enctype="multipart/form-data">
          Select Image to Upload:
          <input type="file" name="fileToUpload" id="fileToUpload"><br>
          <label>Enter Course Name:<input type="text" name="coursename"></label><br>
          <label>Enter Term:<input type="text" name="termnum"></label><br>
          <input type="submit" value="Import Course" name="course-import">
        </form>
      </div>
    </div>
</div>

  </body>
</html>
<?php
include "footer.php";
?>
