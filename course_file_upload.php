<?php
include "header.php";
?>



<!DOCTYPE html>
<html>

    <link rel="stylesheet" href="css/course_file_upload.css">

<body>

<!--    <form action="includes/professor_course_add.inc.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Import Course" name="course-import">
    </form>
-->

    <form action="includes/professor_student_add.inc.php" method="post" enctype="multipart/form-data">
        <label>Course Title </label>
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
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Import Student" name="student-import">
    </form>




</body>

</html>


<?php
include "footer.php";
?>
