<?php
include "header.php";
?>




<form action="includes/student_to_group.inc.php" method="post">
    <label>Course Name:</label>
    <select name="GroupSelect">
        <?php
        if (isset($_SESSION['course_info'])) {
            for ($i = 0; $i < count($_SESSION['team_info']); $i++) {
                echo '<option value="' . $_SESSION['team_info'][$i][0] . '">' . $_SESSION['team_info'][$i][0] . ' ' . $_SESSION['team_info'][$i][1] . '</option>';
            }
        } else {
            echo '<option value="" disabled selected hidden>No Courses Available</option>';
        }
        ?>
    </select><br>

    <label>Student List:</label>
    <select name="StudentSelect">
        <?php
        if (isset($_SESSION['course_info'])) {
            for ($i = 0; $i < count($_SESSION['student_list']); $i++) {
                echo '<option value="' . $_SESSION['student_list'][$i][0] . '">' . $_SESSION['student_list'][$i][0] . ' ' . $_SESSION['student_list'][$i][1]  . ' ' . $_SESSION['student_list'][$i][2]. '</option>';
            }
        } else {
            echo '<option value="" disabled selected hidden>No Courses Available</option>';
        }
        ?>
    </select><br>
    <button type="submit" name="create-group"> Submit </button>
</form>