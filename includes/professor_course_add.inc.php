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
        header("Location: ../professorportal.php?error=fileservererror");
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "csv") {
        header("Location: ../professorportal.php?error=notcsv");
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        header("Location: ../professorportal.php?error=servererror");
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            //convert csv file to array
            $csv = array_map('str_getcsv', file('../csv/' . $fileName));
            //create course and term variables
            $courseID = "";
            $termID = "";

            //set up total number of courses imported and variable for if both term and course are valid
            $imported = array(0, 0);
            $total = 0;
            //for each row in the csv file
            foreach ($csv as &$course) {
                //convert course number to id in database
                //$course[0] is course number, $course[1] is term name
                $sql = "SELECT id FROM course WHERE course_number = ?";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../professorportal.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $course[0]);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($row = mysqli_fetch_assoc($result)) {
                        $courseID = $row['id'];
                        if ($courseID != "") {
                            $imported[0] = 1;
                        } else {
                            $imported[0] = 0;
                        }
                    }
                    //convert term to id from database
                    $sql = "SELECT id FROM term WHERE name = ?";


                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../professorportal.php?error=sqlerror");
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
                            } else {
                                $imported[1] = 0;
                            }
                        }

                        if ($imported[0] == 1 && $imported[1] == 1) {
                            $total++; //get total number of courses imported
                        }
                        echo $total;

                        //insert into the professor_course table (assign all information for that specific "CRN")
                        $sql = "INSERT into professor_course (professor_id,course_id,term_id) VALUES (?,?,?)";
                        $result = mysqli_stmt_get_result($stmt);

                        //logged in professor ID
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
            header("Location: ../index.php?result=" . $total . "coursescreated");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
