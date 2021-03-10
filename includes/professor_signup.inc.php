<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

// Load Composer's autoloader
//require 'vendor/autoload.php';

//DONE

//checks for submit button submission
if(isset($_POST['professor-signup'])){


	$emailHost = "localhost";

	
	//require database handler
	require 'dbh.inc.php';

	//fetch information from inputs
	$username = $_POST['uid'];
	$email = $_POST['mail'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];

	//check for empty fields
	if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat))
	{
		//send user back to signup page
		//sends back information like error and fields already filled out
		header("Location: ../getstarted.php?error=emptyfields&uid=".$username."&mail=".$email);

		//stops code from running if there was a mistake
		exit();
	}

	//check for valid email and valid username
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username))
	{
		header("Location: ../getstarted.php?error=invalidmailuid");
		//stops code from running if there was a mistake
		exit();

	}

	//checks for valid email
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		header("Location: ../getstarted.php?error=invalidmail&uid=".$username);
		//stops code from running if there was a mistake
		exit();
	}

	//checks for valid username
	//preg_match is search patters for username
	else if(!preg_match("/^[a-zA-Z0-9]*$/", $username))
	{
		header("Location: ../getstarted.php?error=invaliduid&mail=".$email);
		//stops code from running if there was a mistake
		exit();
	}

	else if($password !== $passwordRepeat)
	{
		header("Location: ../getstarted.php?error=emptyfields&uid=".$username."&mail=".$email);
		//stops code from running if there was a mistake
		exit();
	}

	//if user tried to sign up for username inside database
	else
	{
		//use prepared statements to protect database
		
		$sql = "SELECT uid FROM users WHERE uid=? OR email=?";

		$stmt = mysqli_stmt_init($conn);

		//helps keep database safe
		if(!mysqli_stmt_prepare($stmt, $sql))
		{
			//close the sqli connection to save resources
			mysqli_stmt_close($stmt);
			mysqli_close($conn);
			header("Location: ../getstarted.php?error=sqlerror1");
			exit();
		}

		//bind data if it is ok
		//passing in data type of string denoted by the s
		//puts in username data
		//we can have multiple parameters if you want to check password too
		else
		{
			mysqli_stmt_bind_param($stmt, "ss", $username, $email);
			mysqli_stmt_execute($stmt);

			//stores results in stmt variable
			mysqli_stmt_store_result($stmt);

			//checks how many rows of results from database
			$resultCheck = mysqli_stmt_num_rows($stmt);

			//if username is already taken
			if($resultCheck > 0)
			{
				//close the sqli connection to save resources
				mysqli_stmt_close($stmt);
				mysqli_close($conn);
				header("Location: ../getstarted.php?error=usertaken");
				exit();
			}
			//grab data from database
			else
			{
				$sql = "INSERT INTO users (uid, email, pwd, live, mgt, hashedValue, confirm) VALUES (?, ?, ?, ?, ?, ?, FALSE)";

				$stmt = mysqli_stmt_init($conn);

				//helps keep database safe
				if(!mysqli_stmt_prepare($stmt, $sql))
				{
					//close the sqli connection to save resources
					mysqli_stmt_close($stmt);
					mysqli_close($conn);
					header("Location: ../getstarted.php?error=sqlerror");
					exit();
				}

				else
				{
					//hash the password
					//bcrypt always update when it gets decrypted
					/*if(strlen($password) < 8)
					{
						echo "Enter a password that is at least 8 characters";
					}*/
					//Check against list of common passwords. Hash common passwords or compare unhashed?
					$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

					$active = 1;
					$admin = 0;

					//create hash value
					$hashedValue = md5(random_bytes(16));


					mysqli_stmt_bind_param($stmt, "sssiis", $username, $email, $hashedPwd, $active, $admin, $hashedValue);
					mysqli_stmt_execute($stmt);

					$userID = mysqli_insert_id($conn);

					$sql = "INSERT INTO accounts (userID, tierID, extraAllottedBrokers, extraAllottedUsers) VALUES (?, ?, ?, ?);";
					$stmt = mysqli_stmt_init($conn);

					//helps keep database safe
					if(!mysqli_stmt_prepare($stmt, $sql))
					{
						//close the sqli connection to save resources
						mysqli_stmt_close($stmt);
						mysqli_close($conn);
						header("Location: ../getstarted.php?error=sqlerror");
						exit();
					}

					else
					{
						$startingExtras = 0;
						$startingTier = 0;
						mysqli_stmt_bind_param($stmt, "iiii", $userID, $startingTier, $startingExtras, $startingExtras);
						mysqli_stmt_execute($stmt);


						// Instantiation and passing `true` enables exceptions
						$mail = new PHPMailer(true);

						try {
							//Server settings
							$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
							$mail->isSMTP();                                            // Send using SMTP
							$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
							$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
							$mail->Username   = '';                     // SMTP username
							$mail->Password   = '';                               // SMTP password
							$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
							$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

							//Recipients
							$mail->setFrom('no-reply@a', 'NAME');
							$mail->addAddress($email);
							//$mail->addAddress('supertaha@gmail.com');  // Add a recipient
							//$mail->addAddress('matt.bocharnikov@gmail.com'); // Name is optional
							//$mail->addReplyTo('info@example.com', 'Information');
							//$mail->addCC('cc@example.com');
							//$mail->addBCC('bcc@example.com');

							// Attachments
							//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
							//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

							// Content
							$mail->isHTML(true);                                  // Set email format to HTML
							$mail->Subject = ' Email Verification';

							//WITH CSS
							/*
							$mail->Body = '<p>Hello,<br><br>Thank you for signing up with AirMQTT. Please click or copy the verification link below into your browser to activate your account:<br>
							<button style="background-color: #fea400; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;" 
							onclick=“window.location.href="localhost/AirMQTT/verifyemail.php?email=' .$email. '&hash=' .$hashedValue. '">Verify Email</button><br><br>
							<p>Link: <a href="localhost/AirMQTT/verifyemail.php?email=' .$email. '&hash=' .$hashedValue.'"> localhost/AirMQTT/verifyemail.php?email=' .$email. '&hash=' .$hashedValue.'</a><br><br>
							Thanks!<br>The AirMQTT Development Team';
							*/
							$mail->Body = 'Hello,<br><br>Thank you for signing up with Report Card Rewards. <a href="' .$emailHost. '/verifyemail.php?email=' .$email. '&hash=' .$hashedValue.'">Click here</a> 
							or copy the verification link below into your browser to activate your account:<br>
							<p>Link: <a href="' .$emailHost. '/verifyemail.php?email=' .$email. '&hash=' .$hashedValue.'"> ' .$emailHost. '/verifyemail.php?email=' .$email. '&hash=' .$hashedValue.'</a><br><br>
							Thanks!<br>The Report Card Rewards Team';
							//$mail->Body    = 'Hello,<br><br>Thank you for signing up with AirMQTT. Please click or copy the verification link below into your browser to activate your account:<br>localhost/AirMQTT/verifyemail.php?email=' .$email. '&hash=' .$hashedValue. '<br><br>Best Regards,<br>The AirMQTT Development Team';
							//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

							$mail->send();
							echo 'Message has been sent';
						} catch (Exception $e) {
							echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						}



						//close the sqli connection to save resources
						mysqli_stmt_close($stmt);
						mysqli_close($conn);
						header("Location: ../index.php?user=accountcreated");
						exit();

					}
				}
			}
		}
	}
}

//send user back if they try to access without clicking signup button
else
{
	header("Location: ../getstarted.php?=invalidaccess");
	exit();
}
