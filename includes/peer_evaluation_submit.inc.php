<?php
session_start();

require 'dbh.inc.php';

$criterion_id = $_SESSION["criterion_id"];
$studentIndex = $_SESSION["student_id"][array_search($_POST["StudentSelect"], $_SESSION["names"])];
$evalNum = 5001;
$loggedInStudent = 1002;

$sql = "INSERT INTO student_criterion_score (criterion_id, score, student_id, peerEval_id) VALUES (?,?,?,?)";
$stmt = mysqli_stmt_init($conn);

for ($i = 0; $i < count($_SESSION['criterion']); $i++) {
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../index.php?error=sqlerror");
		exit();
	} else {
		if (isset($_SESSION['criterion_id'])) {
			$id = $_SESSION['criterion_id'][$i];
		}

		if (isset($_POST[str_replace(" ", "_", $_SESSION['criterion'][$i])])) {
			$score = $_POST[str_replace(" ", "_", $_SESSION['criterion'][$i])];
		}

		mysqli_stmt_bind_param($stmt, "iiii", $id, $score, $studentIndex, $evalNum);
		mysqli_stmt_execute($stmt);
		

	}
}





















/*
$sql = "INSERT INTO student_criterion_score (criterion_id, score, student_id, peerEval_id) VALUES ()";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
	header("Location: ../index.php?error=sqlerror");
	exit();
} else {
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);

	//grabs the result for the stmt
	$result = mysqli_stmt_get_result($stmt);

	$i = 0;
	while ($row = $result->fetch_assoc()) {
		$_SESSION['student_id'][$i] = $row["student_id"];
		$_SESSION['names'][$i] = $row["first_name"] . " " . $row["last_name"];
		$i++;
	}




	//header("Location: ../evaluationsuccess.php?result=success");
}
*/