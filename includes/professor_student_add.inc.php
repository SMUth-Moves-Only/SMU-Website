<?php

session_start();

require 'dbh.inc.php';

if (isset($_POST['student-import'])) {

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
            $studentID = "";
            foreach ($csv as &$student) {

                $sql = "SELECT id FROM student WHERE first_name = ? AND last_name = ?";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../index.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ss", $student[0], $student[1]);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    //checks if result was recieved
                    //stores in array
                    if ($row = mysqli_fetch_assoc($result)) {
                        $studentID = $row['id'];
                    }

                        $professorCourseID = 2;
                        $sql = "INSERT into student_course (student_id, prof_course_id) VALUES (?,?)";
                        $result = mysqli_stmt_get_result($stmt);

                        //checks if result was recieved
                        //stores in array


                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../index.php?error=sqlerror");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "ii", $studentID, $professorCourseID);
                            mysqli_stmt_execute($stmt);
                            echo "Students added!";
                            //header("Location: ../index.php?result=studentscreated");
                        }
                    }
                }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
