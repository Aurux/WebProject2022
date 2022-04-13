<?php
    $title = "Login";
    require_once("includes/header.php");
    include("includes/nav.php");
?>


<div id="enroll">
    <?php
        if (isset($_POST["userID"])) echo processLogin($conn);
        else showLogin();
    ?>
</div>