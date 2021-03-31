<?php
include "header.php";
if (!isset($_SESSION['professor_id'])) {
    header("Location: ./?error=notloggedin");
    exit();
}
?>



<form action="includes/create_group.inc.php" method="post">
    <label>Course Title </label>
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
    <input type="text" id="teamName" name="teamName" placeholder="teamName">
    <button type="submit" name="create-group"> Submit </button>
</form>



<?php
include "footer.php";
?>