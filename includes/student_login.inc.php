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
		header("Location: ../studentlogin.php?error=emptyfields");
		exit();
	} else {
		//check database
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
				//check password with reverse hash
				//first is password user tried to use and second is password from database
				//true or false statement
				if ($password == $row['student_password']) {
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


					//start a session for global variable
					session_start();

					//saves information not sensitive in website
					$_SESSION['fName'] = $row['first_name'];
					$_SESSION['lName'] = $row['last_name'];
					$_SESSION['student_id'] = $row['id'];


					//take user back with success message
					header("Location: ../studentportal.php?login=success");
				} else {
					header("Location: ../studentlogin.php?error=wrongpwd");
					exit();
				}
			}


			//if data not recieved
			else {
				header("Location: ../studentlogin.php?error=nouser");
				exit();
			}
		}
	}
} else {
	header("Location: ../index.php");
	exit();
}
