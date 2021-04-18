<?php
//start session and require database handler
session_start();

require 'dbh.inc.php';

//store student, comments, eval number, and logged in student as variables
$studentIndex = $_SESSION["peer_eval_student_id"][array_search($_POST["StudentSelect"], $_SESSION["student_names"])];
$addComments = $_POST["AddComm"];
$evalNum = 1;//ADD PEER EVAL ID
$loggedInStudent = $_SESSION["student_id"];

//add criterion and scores into database
$sql = "INSERT INTO student_criterion_score (criterion_id, score, student_id, student_receiving_id, peerEval_id) VALUES (?,?,?,?,?)";
$stmt = mysqli_stmt_init($conn);

for ($i = 0; $i < count($_SESSION['criterion']); $i++) {

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../index.php?error=sqlerror");
		exit();
	} 
	else {
		//add criterion ids to variable
		if (isset($_SESSION['criterion_id'])) {
			$criterion_id = $_SESSION['criterion_id'][$i];
		}

		//add score to variable
		if (isset($_POST[str_replace(" ", "_", $_SESSION['criterion'][$i])])) {
			$score = $_POST[str_replace(" ", "_", $_SESSION['criterion'][$i])];
		}

		mysqli_stmt_bind_param($stmt, "iiiii", $criterion_id, $score, $loggedInStudent, $studentIndex, $evalNum);
		mysqli_stmt_execute($stmt);
	}
}

//add additional comments into the database
$sql = "INSERT INTO additional_comments (student_id, peerEval_id, student_receiving_id, additional_comments) VALUES (?,?,?,?)";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
	header("Location: ../index.php?error=sqlerror");
	exit();
} 
else {

	mysqli_stmt_bind_param($stmt, "iiis", $loggedInStudent, $evalNum, $studentIndex, $addComments);
	mysqli_stmt_execute($stmt);

	header("Location: ../evaluationsuccess.php?result=evalsubmitted");
}




//send email once evaluation is submitted to database


//Include PHPMailer classes
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\Exception;

//Require PHPMailer libraries
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
	//Server settings
	$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host       = 'smtp.gmail.com';
	$mail->SMTPAuth   = true;
	$mail->Username   = 'smupeerevaluation@gmail.com';
	$mail->Password   = 'smuthmovesonly';
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	$mail->Port       = 587;

	//Recipients
	$mail->setFrom('no-reply@smupeerevaluation.com', 'SMU Peer Evaluation');
	$mail->addAddress('gregfairbanks21@gmail.com');

	// Content
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = 'Peer Evaluation';
	$mail->Body    = '<p>Hello,<br><br>Thank you for submitting your peer evaluation for SMU</p><p>Sincerely,<br>The SMU Peer Evaluation Team</p>';
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	$mail->send();
	echo 'Message has been sent';
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
