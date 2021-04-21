<?php
include "header.php";
 ?>

<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/student_peer_eval.css">
    <title>student_peer_eval</title>
  </head>
  <body>

    <h1>Schedule Peer Evaluation</h1>

<div class="cgroup">
      <label>Select Course:</label>
      <select name="SelectCourse"></select>
  <br>
      <label>Select Class:</label>
      <select name="SelectClass"></select>
  <br>
      <label>Select Group:</label>
      <select name="SelectGroup"></select>
  <br>
      <form action="/action_page.php">
        <label>Select Date:</label>
        <input type="date" id="calendar" name="dateselect">
      </form>
      <button onclick="window.location='stu_peer_eval_success.php';" type="submit"> SUBMIT </button>
</div>

  </body>
</html>
