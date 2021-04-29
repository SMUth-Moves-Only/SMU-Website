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
          echo '<option value="' . $_SESSION['course_info'][$i][0] . '">' . $_SESSION['course_info'][$i][0] . ' ' . $_SESSION['course_info'][$i][2] . '</option>';
        }
      } else {
        echo '<option value="" disabled selected hidden>No Courses Available</option>';
      }
      ?>
    </select>


    <!--team name & submit button & CSV file-->
    <input type="text" id="teamName" name="teamName" placeholder="Group Name"><br>

<!--
    <form action="includes/course_student_add.inc.php" method="post" enctype="multipart/form-data">
      Select CSV to Upload:
      <input type="file" name="fileToUpload" id="fileToUpload"><br>
    </from>
-->

    <button type="submit" name="create-group"> Submit </button>
  </form>
</div>

<!--

<br><br><br><br>

  <div class="poptable">
    <table>
      <thead>
        <th>Course Name</th>
        <th>Student Group</th>
        <th>Student Name</th>
      </thead>
      <tbody>
        <tr>
          <td><input type="text" name="cousrename"></td>
          <td><input type="text" name="stugroup"></td>
          <td><input type="text" name="stuname"></td>
        </tr>
  </div>

  <button type="button">Edit Table</button>

-->

<!--
<label>Course Name</label> <br>
<textarea name="coursename" rows="15" cols="50"></textarea>
<textarea name="stugroup" rows="15" cols="50"></textarea>
<textarea name="stuname" rows="15" cols="50"></textarea>
-->



<div class="cgroup">
  <h2>Course Title</h2>
  <form action="includes/groups_list.inc.php" method="post">
    <label>Course Name:</label>
    <select name="CourseName">
      <?php
      if (isset($_SESSION['course_info'])) {
        for ($i = 0; $i < count($_SESSION['course_info']); $i++) {
          echo '<option value="' . $_SESSION['course_info'][$i][0] . '">' . $_SESSION['course_info'][$i][0] . ' ' . $_SESSION['course_info'][$i][2] . '</option>';
        }
      } else {
        echo '<option value="" disabled selected hidden>No Courses Available</option>';
      }
      ?>
    </select><br>

    <button type="submit" name="assign-group"> Assign Student </button>

  </form>
</div>


<?php
include "footer.php";
?>
