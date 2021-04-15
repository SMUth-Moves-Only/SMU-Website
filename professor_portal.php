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

<!--ERROR Messages-->
<?php
if ($_SERVER['QUERY_STRING'] == "result=success") {
    echo '<div class="alert success" name="success">
    <span class="closebtn">&times;</span>
    <strong>Success!</strong> Indicates a successful or positive action.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=notcsv") {
    echo '';
} else if ($_SERVER['QUERY_STRING'] == "error=notcsv") {
    echo '<div class="alert success">
    <span class="closebtn">&times;</span>
    <strong>Success!</strong> Indicates a successful or positive action.
  </div>';
} else if ($_SERVER['QUERY_STRING'] == "error=sqlerror") {
    echo '<div class="alert">
    <span class="closebtn">&times;</span>
    <strong>Error!</strong> There was an error with the database!
  </div>';
}
?>

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
                    <button onclick="window.location='course_student_add.php';">Import Students <br> and Courses</button>
                    <!--FILE TO UPLOAD COURSES. MAY NEED TO ALSO INCLUDE CODE FROM STUDENT_FILE_UPLOAD-->
                </div>
                <div class="column">
                    <button>Schedule Peer <br> Evaluation</button>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <button onclick="window.location='groups.php';">Create Student <br> Groups</button>
                </div>
                <div class="column">
                    <button>View Student <br> Evaluation</button>
                </div>
            </div>
        </div>
    </div>


</body>

<script>
    var close = document.getElementsByClassName("closebtn");
    var i;

    for (i = 0; i < close.length; i++) {
        close[i].onclick = function() {
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function() {
                div.style.display = "none";
            }, 600);
        }
    }
</script>


</html>
