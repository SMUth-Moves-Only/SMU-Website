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

$sql = "INSERT INTO complete_peer_eval (student_idReceiving, student_idWriting, time_started, time_finished) VALUES (?,?,?,?)"; //*********************************FIX************************************** */
$stmt = mysqli_stmt_init($conn);

$date = date('Y-m-d H:i:s');

if (!mysqli_stmt_prepare($stmt, $sql)) {
	header("Location: ../index.php?error=sqlerror");
	exit();
} else {
	if (isset($_SESSION["evalStart"])) {
		$startDate = $_SESSION["evalStart"];
	}
	mysqli_stmt_bind_param($stmt, "iiss", $studentIndex, $loggedInStudent, $startDate, $date);
	mysqli_stmt_execute($stmt);



	header("Location: ../evaluationsuccess.php?result=success");
}


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
