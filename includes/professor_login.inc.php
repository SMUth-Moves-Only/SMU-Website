<?php

//checks for submit button submission
if (isset($_POST['login-submit'])) {
	//require the database handler
	require 'dbh.inc.php';

	//option to use email or username
	$mailuid = $_POST['userEmail'];
	$password = $_POST['userPass'];

	//check if anything was left empty
	if (empty($mailuid) || empty($password)) {
		header("Location: ../studentlogin.php?error=emptyfields");
		exit();
	} else {
		//check database
		$sql = "SELECT * FROM professor WHERE email_address=?;";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../index.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $mailuid);
			mysqli_stmt_execute($stmt);

			//grabs the result for the stmt
			$result = mysqli_stmt_get_result($stmt);

			//checks if result was recieved
			//stores in array
			if ($row = mysqli_fetch_assoc($result)) {
				//check password with reverse hash
				//first is password user tried to use and second is password from database
				//true or false statement
				if ($password == $row['password']) {
					$pwdCheck = true;
				} else {
					$pwdCheck = false;
				}

				if ($pwdCheck == true) {


					//have session started to end it
					session_start();

					//takes all session variables and deletes all values
					session_unset();

					//destroys the session
					session_destroy();



					session_start();
					$_SESSION['fName'] = $row['first_name'];
					$_SESSION['lName'] = $row['last_name'];
					$_SESSION['professor_id'] = $row['id'];

					$sql = "SELECT  professor_course.id, term_id, course_name, course_number, course_id, name, start_date, end_date
					FROM professor_course 
					JOIN course AS c ON c.id=professor_course.course_id
					JOIN term AS t ON t.id=professor_course.term_id
					WHERE professor_id = ?;";
					$stmt = mysqli_stmt_init($conn);

					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../index.php?error=sqlerror");
						exit();
					} else {
						mysqli_stmt_bind_param($stmt, "i", $row['id']);
						mysqli_stmt_execute($stmt);

						//grabs the result for the stmt
						$result = mysqli_stmt_get_result($stmt);


						//checks if result was recieved
						//stores in array
						$i = 0;

						while ($row = $result->fetch_assoc()) {
							$_SESSION['course_info'][$i] = array($row['id'], $row['course_id'], $row['course_name'], $row['course_number'], $row['name']);
							$i++;
						}
						//start a session for global variable


						//saves information not sensitive in website
						//take user back with success message
						header("Location: ../professorportal.php?login=success");
					}
				} else {
					header("Location: ../professor_login.php?error=wrongpwd");
					exit();
				}
			}


			//if data not recieved
			else {
				header("Location: ../professor_login.php?error=nouser");
				exit();
			}
		}
	}
} else {
	header("Location: ../index.php");
	exit();
}
