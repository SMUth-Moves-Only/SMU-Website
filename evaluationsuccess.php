<?php
include "header.php";
if (!isset($_SESSION['student_id'])) {
  header("Location: ./?error=notloggedin");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>peerevaluation</title>
</head>

<link rel="stylesheet" href="css/evaluationsuccess.css">

<body>
  <div class="checkmark">
    <img src="img/checkmark.svg" alt="check">
  </div>

  <h3>Thank you! <br> You evaluation has been submitted <br> successfully.</h3>

  <h1>A confirmation email has been sent to your student email address.</h1>

</body>

</html>