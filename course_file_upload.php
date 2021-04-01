<?php
include "header.php";
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/course_file_upload.css">
<body>

  <h1>Import Students</h1>
  <textarea name="textbox" rows="7" cols="30"></textarea> <br>
<br>

<!--select course drop down-->
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

<br>

<!--file directions-->
  <div class="fileinfo">
    <p>Student file should be in .csv format.</p>
    <p>File should have rows in order: id, first_name, <br>
    last_name, major, email_address, <br>
    student_password</p>
  </div>
<br>




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


  <div class="choosefile">

    <!--select file button-->
          <label>Select Student File:</label>
          <input type="file" name="fileToUpload" id="fileToUpload"> <br><br>

    <form action="includes/professor_course_add.inc.php" method="post" enctype="multipart/form-data">
        Select Image to Upload:
        <input type="file" name="fileToUpload" id="fileToUpload">

      <div class="importcourse">
        <input type="submit" value="Import Course" name="course-import"> <br><br>
      </div>
    </form>
  </div>

<!--
        <input type="submit" value="Import Student" name="student-import">
-->

</body>
</html>
<?php
include "footer.php";
?>
