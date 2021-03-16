<?php
session_start();
include "header.php";
 ?>

 <head>
     <link rel="stylesheet" href="css/peerevaluation.css">
 </head>
<div class="eval">


  <div class="row">
    <div class="criterion">
    </div>
    <div class="column">
      <h2>0</h2>
    </div>
    <div class="column">
      <h2>1</h2>
    </div>
    <div class="column">
      <h2>2</h2>
    </div>
    <div class="column">
      <h2>3</h2>
    </div>
    <div class="column">
      <h2>4</h2>
    </div>
  </div>






  <form action = "" method = "post">
      <label>Student Name: </label>
      <select id="StudentSelect">
          <?php
              if (isset($_SESSION['names'])) {
                  for ($i = 0; $i < count($_SESSION['names']); $i++) {
                          echo '<option>' .$_SESSION['names'][$i] . '</option>';
                  }
              }
              else{
                  echo '<option value="" disabled selected hidden>No Names</option>';
              }
          ?>
      </select>
      <input type="radio" id="male" name="gender" value="male">
      <label for="male">Male</label><br>

          <?php
              if (isset($_SESSION['criterion'])) {
                  for ($i = 0; $i < count($_SESSION['criterion']); $i++) {
                          echo '<p>' .$_SESSION['criterion'][$i] . '</p>';
                  }
              }
              else{
                  echo '<p>No Criterion</p>';
              }
          ?>
  </form>
</div>
