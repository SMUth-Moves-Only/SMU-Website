<?php
session_start();
//checks for submit button submission
if (isset($_POST['login-submit'])) {
	//require the database handler
	require 'dbh.inc.php';

	//option to use email or username
	$mailuid = $_POST['userEmail'];
	$password = $_POST['userPass'];

	//check if anything was left empty
	if (empty($mailuid) || empty($password)) {
		header("Location: ../student_login.php?error=emptyfields");
		exit();
	} else {
		//get user information from inputted email address
		$sql = "SELECT * FROM student WHERE email_address=?;";
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
				//implement reverse hash
				//check password
				if ($password == $row['student_password']) {
					$pwdCheck = true;
				} else {
					$pwdCheck = false;
				}

				if ($pwdCheck == true) {

					//destroy old session if already started
					//have session started to end it
					session_start();
					//takes all session variables and deletes all values
					session_unset();
					//destroys the session
					session_destroy();
					//start a session for global variable
					session_start();

					//saves information not sensitive in website
					$_SESSION['fName'] = $row['first_name'];
					$_SESSION['lName'] = $row['last_name'];
					$_SESSION['student_id'] = $row['id'];


					//take user back with success message
					header("Location: ../student_portal.php?login=success");
				} else {
					header("Location: ../student_login.php?error=wrongpwd");
					exit();
				}
			}


			//if data not recieved
			else {
				header("Location: ../student_login.php?error=nouser");
				exit();
			}
		}
	}
} else {
	header("Location: ../index.php");
	exit();
}
