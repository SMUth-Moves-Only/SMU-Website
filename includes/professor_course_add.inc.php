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
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "csv") {
        echo "Sorry, only CSV files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars($fileName) . " has been uploaded.";

            $csv = array_map('str_getcsv', file('../csv/' . $fileName));
            $courseID = "";
            $termID = "";
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
                    }
                    echo $course[0] . '<br>' . $course[1] . '<br>';

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
                        }


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
            header("Location: ../index.php?result=coursescreated");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
