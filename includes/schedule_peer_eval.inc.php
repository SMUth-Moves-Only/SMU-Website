<?php

//Insert into statement to schedule a peer evaluation

session_start();

require 'dbh.inc.php';

$groupID = $_POST['GroupSelect'];

$sql = "";

$stmt = mysqli_stmt_init($conn);

//helps keep database safe
if (!mysqli_stmt_prepare($stmt, $sql)) {
    //close the sqli connection to save resources
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../index.php?error=sqlerror");
    exit();
} 
else {
    mysqli_stmt_bind_param($stmt, "ii", $groupID);
    mysqli_stmt_execute($stmt);
    //close the sqli connection to save resources
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../professor_portal.php?user=peerevalassigned");
    exit();
}
