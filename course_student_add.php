<?php
include "header.php";
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/course_file_upload.css">
<body>

  <div class="row">
    <!--select student-->
    <div class="column">
      <h1>Import Students</h1>
      <div class="choosefile">
        <!--drop down list-->
        <form action="includes/course_student_add.inc.php" method="post" enctype="multipart/form-data">

<?php if (condition): ?>
          <div class="alert">
            <span class="closebtn">&times;</span>
            <strong>ERROR:</strong> Fill in all inputs.
          </div>
<?php endif; ?>
<br>
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
          <label>Select Student File:</label>
          <input type="file" name="fileToUpload" id="fileToUpload"><br>
          <label>Enter Student First Name:<input type="text" name="studentfname"></label><br>
          <label>Enter Student Last Name:<input type="text" name="studentlname"></label><br>
          <input type="submit" value="Import Student" name="student-import"><br>
        </form>
      </div>
    </div>

    <!--select image-->
    <div class="column">
      <h1>Import Courses</h1>
      <div class="choosefile">
        <!--drop down list-->
        <form action="includes/course_student_add.inc.php" method="post" enctype="multipart/form-data">
          Select CSV to Upload:
          <input type="file" name="fileToUpload" id="fileToUpload"><br>
          <label>Enter Course Name:<input type="text" name="coursename"></label><br>
          <label>Enter Course Term:<input type="text" name="termnum"></label><br>
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
