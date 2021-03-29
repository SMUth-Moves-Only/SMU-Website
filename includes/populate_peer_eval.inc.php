<?php
session_start();

require 'dbh.inc.php';

$sql = "SELECT id, first_name, last_name FROM student";
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
		$_SESSION['peer_eval_student_id'][$i] = $row["id"];
		$_SESSION['student_names'][$i] = $row["first_name"] . " " . $row["last_name"];
		$i++;
	}


	$sql = "SELECT id, name FROM criterion";
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
			$_SESSION['criterion_id'][$i] = $row["id"];
			$_SESSION['criterion'][$i] = $row["name"];
			$i++;
		}
		
	}

	header("Location: ../peerevaluation.php?result=success");
}
