<?php
session_start();

require 'dbh.inc.php';

$sql = "SELECT student_id, first_name, last_name FROM student";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
	header("Location: ../index.php?error=sqlerror");
	exit();
} else {
	mysqli_stmt_execute($stmt);

	//grabs the result for the stmt
	$result = mysqli_stmt_get_result($stmt);

	$i = 0;
	while ($row = $result->fetch_assoc()) {
		$_SESSION['student_id'][$i] = $row["student_id"];
		$_SESSION['names'][$i] = $row["first_name"] . " " . $row["last_name"];
		$i++;
	}


	$sql = "SELECT criterion_id, name FROM criterion";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../index.php?error=sqlerror");
		exit();
	} else {
		mysqli_stmt_execute($stmt);

		//grabs the result for the stmt
		$result = mysqli_stmt_get_result($stmt);

		$i = 0;
		while ($row = $result->fetch_assoc()) {
			$_SESSION['criterion_id'][$i] = $row["criterion_id"];
			$_SESSION['criterion'][$i] = $row["name"];
			$i++;
		}
		$_SESSION["evalStart"] = date('Y-m-d H:i:s');
		
	}

	header("Location: ../peerevaluation.php?result=success");
}
