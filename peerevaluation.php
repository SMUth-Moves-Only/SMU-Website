<?php
session_start();
include "header.php";
 ?>

 <head>
     <link rel="stylesheet" href="css/peerevaluation.css">
 </head>
<div class="eval">


  <form action = "includes/peer_evaluation_submit.inc.php" method = "post">
      <label>Student Name: </label>
      <select id="StudentSelect" name="StudentSelect">
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

<br><br>
  <div class="row">
    <div class="criterion">
      <p class="title">Evaluation</p>
    </div>
    <div class="column">
      <h3>0</h3>
    </div>
    <div class="column">
      <h3>1</h3>
    </div>
    <div class="column">
      <h3>2</h3>
    </div>
    <div class="column">
      <h3>3</h3>
    </div>
    <div class="lastColumn">
      <h3>4</h3>
    </div>
  </div>

  <?php
      if (isset($_SESSION['criterion'])) {
          for ($i = 0; $i < count($_SESSION['criterion']); $i++) {
                  echo '<div class="row">';
                  echo '<div class="criterion">';
                  echo '<p>' . $_SESSION['criterion'][$i] . '</p>';
                  echo '</div>';
                  echo '<div class="column">';
                  echo '<input type="radio" id="'.$_SESSION['criterion'][$i].'0" name="'.$_SESSION['criterion'][$i].'" value="0"> <label for="'.$_SESSION['criterion'][$i].'0">0</label>';
                  echo '</div>';
                  echo '<div class="column">';
                  echo '<input type="radio" id="'.$_SESSION['criterion'][$i].'1" name="'.$_SESSION['criterion'][$i].'" value="1"> <label for="'.$_SESSION['criterion'][$i].'1">1</label>';
                  echo '</div>';
                  echo '<div class="column">';
                  echo '<input type="radio" id="'.$_SESSION['criterion'][$i].'2" name="'.$_SESSION['criterion'][$i].'" value="2"> <label for="'.$_SESSION['criterion'][$i].'2">2</label>';
                  echo '</div>';
                  echo '<div class="column">';
                  echo '<input type="radio" id="'.$_SESSION['criterion'][$i].'3" name="'.$_SESSION['criterion'][$i].'" value="3"> <label for="'.$_SESSION['criterion'][$i].'3">3</label>';
                  echo '</div>';
                  echo '<div class="column">';
                  echo '<input type="radio" id="'.$_SESSION['criterion'][$i].'4" name="'.$_SESSION['criterion'][$i].'" value="4"> <label for="'.$_SESSION['criterion'][$i].'4">4</label>';
                  echo '</div>';
                  echo '</div>';
          }
      }
      else{
          echo '<p>No Criterion</p>';
      }
  ?>

  <div class="AdditionalComments">

  <h1>Additional Comments</h1>
    <textarea style="width: 100%" name="AddComm" rows="8"></textarea>
  </div>

  <!--includes/peer_evaluation_submit.inc.php-->
  <div class="buttons">
    <button type="submit">Submit</button>
  </div>


  </form>
</div>
