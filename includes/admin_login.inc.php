<?php

//checks for submit button submission
if (isset($_POST['login-submit'])) {

	//require the database handler
	require 'dbh.inc.php';

	//login variables
	$mailuid = $_POST['userEmail'];
	$password = $_POST['userPass'];

	//check if anything was left empty
	if (empty($mailuid) || empty($password)) {
		header("Location: ../studentlogin.php?error=emptyfields");
		exit();
	} else {
		//get user information
		$sql = "SELECT * FROM administrator WHERE email_address=?;";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../index.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $mailuid);
			mysqli_stmt_execute($stmt);

			//grabs the result for the stmt
			$result = mysqli_stmt_get_result($stmt);

			//get result data
			if ($row = mysqli_fetch_assoc($result)) {
				//ADD REVERSE HASH IN FUTURE
				if ($password == $row['admin_password']) {
					$pwdCheck = true;
				} else {
					$pwdCheck = false;
				}

				if ($pwdCheck == true) {
					//start a session for global variable
					session_start();

					//saves information not sensitive in website
					$_SESSION['fName'] = $row['first_name'];
					$_SESSION['lName'] = $row['last_name'];
					$_SESSION['id'] = $row['id'];

					//take user back with success message
					header("Location: ../adminportal.php?login=success");
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
