<?php
include "header.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/assign_instructor.css">
  </head>
  <body>
    <h1>Assign Instructor</h1>
<br>
    <div class="assign">
      <label>Select CSV file:</label>
      <input type="file" name="fileToUpload" id="fileToUpload"><br>
      <button onclick="window.location='assign_instructor_success.php';" type="submit"> SUBMIT </button>
    </div>
  </body>
</html>
