<?php
include "header.php";
?>

<!--Login buttons for instructor, student, or administrator-->


<!--  https://735633b2fc75.ngrok.io/SMU-Website/   -->

<!DOCTYPE html>
<html>

<style type="text/css">
  h1 {text-align: center;}
  body {background-color: tan}
  .buttons{
    cursor: pointer; color: yellow; text-align: center;
  }
  .button{
background-color: blue; padding: 20px 20px;
  }
  .Login { }
</style>

<head>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js"></script>
</head>

<body>

  <div class="Login">
    <h1>Log In</h1> <br>
    <div class="buttons">
      <a class="button">INSTRUCTOR</a> <br>
      <a class="button">STUDENT</a> <br>
      <a class="button">ADMINISTRATOR</a>
    </div>
  </div>

</body>

</html>
