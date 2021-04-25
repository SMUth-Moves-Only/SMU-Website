<?php

//Insert into statement to schedule a peer evaluation

session_start();


require 'dbh.inc.php';


if (isset($_POST['eval-schedule'])) {

    $startDate = $_POST['startdateselect'];
    $endDate = $_POST['enddateselect'];

    foreach ($_SESSION['group_schedule'] as &$groupID) {
        //convert course number to id in database
        $sql = "insert into schedule_peer_eval (start_date, end_date, group_id) Value (?,?,?);";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../professor_portal.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssi", $startDate, $endDate, $groupID);
            mysqli_stmt_execute($stmt);
        }
    }
    header("Location: ../professor_portal.php?result=schedulesuccess");
}
