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
    <button type="submit" name="create-group"> Submit </button>
  </form>
</div>

<div class="cgroup">
  <h2>Course Title</h2>
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
include "footer.php";
?>
