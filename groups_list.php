<?php
include "header.php";
if (!isset($_SESSION['professor_id'])) {
    header("Location: ./?error=notloggedin");
    exit();
  }
?>

<link rel="stylesheet" href="css/groups_list.css">

<h1>Select Group</h1>



<div class="courseInfo">

<form action="includes/student_to_group.inc.php" method="post">
    <!--course name-->
    <label>Group Name:</label>
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

    <!--student list-->
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

    <!--submit button-->
    <button onclick="window.location='group_list_success.php';" type="submit" name="create-group"> Submit </button>

</form>
</div>
