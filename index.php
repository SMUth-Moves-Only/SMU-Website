<?php
include "header2.php";
?>

<!--Login buttons for instructor, student, or administrator-->

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js"></script>
</head>
  <body>

    <div class="Login">
      <h1>Log In</h1> <br>
        <div class="buttons">
          <button onclick="window.location='professor_login.php';">INSTRUCTOR</button> <br>
          <button onclick="window.location='student_login.php';">STUDENT</button> <br>
          <button onclick="window.location='admin_login.php';">ADMINISTRATOR</button>
        </div>
    </div>

  </body>
</html>
