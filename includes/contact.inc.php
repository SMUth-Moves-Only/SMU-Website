<?php

//Include PHPMailer classes
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\Exception;

session_start();

function sendEmail($nameUsers, $emailUsers, $subjectText, $messageText)
{
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
        $mail->Username   = '';
        $mail->Password   = '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('', '');
        $mail->addAddress('gregfairbanks21@gmail.com');

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'New message from ' . $nameUsers . " - Subject: " . $subjectText;
        $mail->Body    = '<p>Hello,<br><br>' . $messageText . '</p><p>Sincerely,<br>' . $nameUsers . '<br>' . $emailUsers . '</p>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

//checks for submit button submission
if (isset($_POST['contact-submit'])) {


    if (isset($_POST['g-recaptcha-response'])) {

        // Build POST request:
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = '6Lf4zlUaAAAAAB7gWRvux_15z1u83dILM0y634Cb';
        $recaptcha_response = $_POST['g-recaptcha-response'];

        // Make and decode POST request:
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);

        if ($recaptcha->success === false) {
            header("Location: ../index.php?error=recaptchaerror");
            exit();
        } else if ($recaptcha->score <= 0.3) {
            header("Location: ../index.php?error=boterror");
            exit();
        } else {
            //require database handler
            require 'dbh.inc.php';
            $nameUsers = $_POST['nameUser'];
            $emailUsers = $_POST['emailUser'];
            $subjectText = $_POST['subjectText'];
            $messageText = $_POST['messageText'];

            sendEmail($nameUsers, $emailUsers, $subjectText, $messageText);
            
            //insert into contact database if user is signed in
            if (isset($_SESSION['id'])) {
                $sql = "INSERT INTO contact (dayTime, userID, nameUser, emailUser, subjectText, messageText) VALUES (NOW(), ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                //helps keep database safe
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../index.php?error=contactsqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "issss", $_SESSION['id'], $nameUsers, $emailUsers, $subjectText, $messageText);
                    mysqli_stmt_execute($stmt);

                    //close the sqli connection to save resources
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);

                    header("Location: ../index.php?result=contactsuccess");
                    exit();
                }
            } 
            //insert into contact database if user not signed in
            else {
                $sql = "INSERT INTO contact (dayTime, nameUser, emailUser, subjectText, messageText) VALUES (NOW(), ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                //helps keep database safe
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../index.php?error=contactsqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ssss", $nameUsers, $emailUsers, $subjectText, $messageText);
                    mysqli_stmt_execute($stmt);

                    //close the sqli connection to save resources
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);

                    header("Location: ../index.php?result=contactsuccess");
                    exit();
                }
            }
        }
    }
}
