<?php

if (isset($_POST['create-group'])) {
    var_dump($_POST);
    require "dbh.inc.php";
    if ($_POST['teamName'] == "") {
        header("Location: ../create_groups.php?error=invalidteamname");
    } 
    if (!isset($_POST['CourseSelect'])) {
        header("Location: ../create_groups.php?error=invalidcourse");
    } 
    else {
        $teamName = $_POST['teamName'];
        $courseID = $_POST['CourseSelect'];
        $sql = "INSERT INTO student_group (team_name, prof_course_id) VALUES (?,?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "si", $teamName, $courseID);
            mysqli_stmt_execute($stmt);
            header("Location: ../professorportal.php?result=success");
        }
    }
}
