<?php
include "header.php";
if (!isset($_SESSION['professor_id'])) {
  header("Location: ./?error=notloggedin");
  exit();
}
?>

<!--call style sheet-->
<link rel="stylesheet" href="css/create_groups.css">

<h1>Assign Students </h1>

<!--Create Groups-->
<div class="cgroup">
  <h2>Create Groups</h2>
  <form action="includes/groups.inc.php" method="post">
    <label>Course Name:</label>
    <select name="CourseSelect">
      <?php
      if (isset($_SESSION['course_info'])) {
        for ($i = 0; $i < count($_SESSION['course_info']); $i++) {
          echo '<option value="' . $_SESSION['course_info'][$i][0] . '">' . $_SESSION['course_info'][$i][2] . '</option>';
        }
      } else {
        echo '<option value="" disabled selected hidden>No Courses Available</option>';
      }
      ?>
    </select>

    <!--team name & submit button-->
    <input type="text" id="teamName" name="teamName" placeholder="Group Name"><br>
    <button type="submit" name="createg"> Submit </button>
  </form>
</div>

<div class="cgroup">
  <h2></h2>
  <form action="includes/groups_list.inc.php" method="post">
    <label>Course Name:</label>
    <select name="CourseSelect">
      <?php
      if (isset($_SESSION['course_info'])) {
        for ($i = 0; $i < count($_SESSION['course_info']); $i++) {
          echo '<option value="' . $_SESSION['course_info'][$i][0] . '">' . $_SESSION['course_info'][$i][2] . '</option>';
        }
      } else {
        echo '<option value="" disabled selected hidden>No Courses Available</option>';
      }
      ?>
    </select><br>

    <button type="submit" name="create-group"> Submit </button>

  </form>
</div>


<?php
if ($_SERVER['QUERY_STRING'] == "result=success" /*ERROR MESSAGE*/) {
    echo '<div class="alert success" name="success">
    <span class="closebtn">&times;</span>
    <strong>Success:</strong> File uploaded.
  </div>';
} else if ($_SERVER['QUERY_STRING'] == "error=inputerror" /*ERROR MESSAGE: information input error*/) {
    echo '<div class="alert warning">
      <span class="closebtn">&times;</span>
      <strong>Warning!</strong> Indicates a warning that might need attention.
    </div>';
}
?>

<!--JavaScript-->
  <script>
    var close = document.getElementsByClassName("closebtn");
    var i;

    for (i = 0; i < close.length; i++) {
      close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
      }
    }
  </script>

<?php
include "footer.php";
?>
