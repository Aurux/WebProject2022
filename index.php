<?php
    $title = "Bowling Moodle";
    include("includes/header.php");
    include("includes/nav.php");

    if ($_SESSION["loggedIn"] == true){
        if ($_SESSION["uType"] == "student") {
            header("refresh:0; url=student_home.php");
        }
        if ($_SESSION["uType"] == "tutor") {
            header("refresh:0; url=tutor_home.php");
        }
    }
    else {
        include("login.php");
    }
    
    
    include_once("includes/footer.php");

    // Comment out after initial setup.
    require("scripts/create_db.php");
    
?>


