<?php
include "header.php";
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
          <button onclick="window.location='studentlogin.php';">STUDENT</button> <br>
          <button>ADMINISTRATOR</button>
        </div>
    </div>

  </body>
</html>
