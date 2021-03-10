<?php
include "header.php";
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js"></script>
    <script src="js/jQuery.js"></script>
</head>

<body>



    <!--THIS IS THE CONTACT FORM-->
    <form action="includes/contact.inc.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="nameUser" placeholder="John"><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="emailUser" placeholder="test@test.com"><br><br>
        <label for="subject">Subject:</label><br>
        <input type="text" id="subject" name="subjectText" placeholder="subject"><br><br>
        <label for="message">Message:</label><br>
        <input type="text" id="message" name="messageText" placeholder="message"><br><br>
        <button type="submit" name="contact-submit"> Submit </button>
    </form>
    <!--CONTACT FORM END-->



<h1>STUDENT SIGNUP</h1>



    <!--THIS IS THE SIGNUP FORM FOR STUDENTS-->
    <!--MAYBE MAKE A RADIO BUTTON TO SWITCH BETWEEN PROFESSOR AND STUDENT SIGNUP FORM?-->
    <form action="includes/student_signup.inc.php" method="post">
        <label for="fName">First Name:</label><br>
        <input type="text" id="fName" name="fName" placeholder="John"><br>
        <label for="lName">Last Name:</label><br>
        <input type="text" id="lName" name="lName" placeholder="Doe"><br>
        <label for="major">Major:</label><br>
        <input type="text" id="major" name="major" placeholder="BIT"><br><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" placeholder="test@test.com"><br><br>
        <label for="pwd">Password:</label><br>
        <input id="pwd" type="password" name="pwd" placeholder="Password"><br>
        <label for="repeatpwd">Password Confirm:</label><br>
        <input id="repeatpwd" type="password" name="repeatpwd" placeholder="Repeat Password"><br>
        <button type="submit" name="student-signup"> Submit </button>
    </form>
    <!--SIGNUP FORM END-->



    <h1>PROF SIGNUP</h1>



    <!--THIS IS THE SIGNUP FORM FOR PROFESSORS-->
    <!--MAYBE MAKE A RADIO BUTTON TO SWITCH BETWEEN PROFESSOR AND STUDENT SIGNUP FORM?-->
    <form action="includes/professor_signup.inc.php" method="post">
        <label for="name">First Name:</label><br>
        <input type="text" id="fname" name="fName" placeholder="John"><br>
        <label for="name">Last Name:</label><br>
        <input type="text" id="lname" name="lName" placeholder="Doe"><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" placeholder="test@test.com"><br><br>
        <label for="pwd">Password:</label><br>
        <input id="pwd" type="password" name="pwd" placeholder="Password"><br>
        <label for="repeatpwd">Password Confirm:</label><br>
        <input id="repeatpwd" type="password" name="repeatpwd" placeholder="Repeat Password"><br>
        <button type="submit" name="professor-signup"> Submit </button>
    </form>
    <!--SIGNUP FORM END-->




</body>

</html>

<?php
include "footer.php";
?>