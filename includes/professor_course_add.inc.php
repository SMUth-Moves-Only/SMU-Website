<?php

session_start();

require 'dbh.inc.php';

if (isset($_POST['course-import'])) {

    $target_dir = "../csv/";
    $fileName = 'd' . date("Y-m-d") . 't' . date("h-i-s") . basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {

        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "csv") {

        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {

        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {


            $csv = array_map('str_getcsv', file('../csv/' . $fileName));
            $courseID = "";
            $termID = "";

            $imported = array(0, 0);
            $total = 0;
            foreach ($csv as &$course) {

                $sql = "SELECT id FROM course WHERE course_number = ?";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../index.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $course[0]);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    //checks if result was recieved
                    //stores in array
                    if ($row = mysqli_fetch_assoc($result)) {
                        $courseID = $row['id'];
                        if ($courseID != "") {
                            $imported[0] = 1;
                        }
                        else{
                            $imported[0] = 0;
                        }
                    }

                    $sql = "SELECT id FROM term WHERE name = ?";


                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../index.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $course[1]);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        //checks if result was recieved
                        //stores in array
                        if ($row = mysqli_fetch_assoc($result)) {
                            $termID = $row['id'];
                            if ($termID != "") {
                                $imported[1] = 1;
                            }
                            else{
                                $imported[1] = 0;
                            }
                        }

                        if($imported[0] == 1 && $imported[1] == 1){
                            $total++;
                        }
                        echo $total;

                        $sql = "INSERT into professor_course (professor_id,course_id,term_id) VALUES (?,?,?)";
                        $result = mysqli_stmt_get_result($stmt);

                        //checks if result was recieved
                        //stores in array
                        $professor_ID = $_SESSION['professor_id'];

                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../index.php?error=sqlerror");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "iii", $professor_ID, $courseID, $termID);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                }
            }
            header("Location: ../index.php?result=".$total."coursescreated");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
