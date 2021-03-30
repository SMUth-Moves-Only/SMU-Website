<?php
include "analytics.php";
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/header.css">
    <script src="js/jQuery.js"></script>

</head>

    <header>
        <img class="logo" src="img/smuHeader.svg" alt="smu">
        <img class="headerRight headerImg" src="img/threeLines.svg">
        <?php
        session_start();
        if(isset($_SESSION["id"])){
        echo'<a class="headerRight headerBtn" href="includes/logout.inc.php">Logout</a>';
        }
        ?>
        <a class="headerRight headerBtn" href="/SMU-Website">Home</a>

    </header>

</html>
