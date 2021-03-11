<?php
include "analytics.php";
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/header.css">

    <style type="text/css">
        body {background-color:antiquewhite}
      div {background-color: white; border: 2px solid black; width: 250px;}    
    </style>

    <script type="text/javascript">

        function Login() {
            //only show stu inpout for students; only show pro input for professors
            var y =document.forms["logIn"].elements["Person"].value;
            var Slog = document.getElementById("stu");
            var Plog = document.getElementById("pro");

                if (y=="S") {
                    Slog.style.display = "block";
                    Plog.style.display = "none";
                } else if (y=="P") {
                    Slog.style.display = "none";
                    Plog.style.display = "block";
                }
            }

            function checkForm() {
            //check that user has selected Student or Professor before submitting
            //keep track if any error
            var someError = false;

            //check if Student or Professor was selected
            var Check =  document.forms["logIn"].elements["Person"];
            someError = checkFO(Check);

            //if error was found, give user message and prevent submitting form
            if (someError==true) {
                event.preventDefault(); //prevent "submit" defult event
             
                //pop up error message
                alert("Please select Student or Professor");

            }
        }

    </script>

</head>

    <body>

        <tr>
            <img src="smu.png" alt="smu">        
        </tr>
        
        <div>
            <!--select a button for student or professor--> 
            <h1>Signup:</h1>
            <h4>Are you a student or professor?</h4>
            <p><input type="radio" name="person" value="st"><label>Student</label></p>
            <p><input type="radio" name="person" value="pr"><label>Professor</label></p>
            <p><input type="submit" value="Submit"></p>
        </div>
<br>

        <div>
            <h1>Login:</h1>
        </div>


    </body>

</html>