<?php
include "header.php";
if (!isset($_SESSION['professor_id'])) {
    header("Location: ./?error=notloggedin");
    exit();
}
?>


<!--Dropdown menus for course title and course ID. Populate both dropdown menus from student's available courses-->
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Student Portal</title>

    <link rel="stylesheet" href="css/professorportal.css">


</head>

<body>

    <div>

        <?php
        if (isset($_SESSION['fName']) && isset($_SESSION['lName'])) {
            echo '<h1 style="text-align: center" name="welcome">Welcome ' . $_SESSION['fName'] . " " . $_SESSION['lName'] . ' to the Instructor Portal</h1>';
        }
        ?>
        <br>
        <div class="width50">
            <div class="row">
                <div class="column">
                    <button onclick="window.location='course_file_upload.php';">Import Students and Courses</button>
                    <!--FILE TO UPLOAD COURSES. MAY NEED TO ALSO INCLUDE CODE FROM STUDENT_FILE_UPLOAD-->
                </div>
                <div class="column">
                    <button>Schedule Peer Evaluation</button>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <button onclick="window.location='create_groups.php';">Create Student Groups</button>
                </div>
                <div class="column">
                    <button>View Student Evaluation</button>
                </div>
            </div>
        </div>
    </div>
<a href="student_import.php">test</a>


</body>

</html>
