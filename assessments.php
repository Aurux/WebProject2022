<?php
    $title = "Asessments";
    require_once("includes/header.php");
    include("includes/nav.php");
    require("scripts/ajax.php");
?>


<div id="HomeContent">
    <?php
        if ($_SESSION["loggedIn"]) {
            if ($_SESSION["uType"] == "student") {
                showAssessments($conn, $_SESSION["username"]);
            }
            if ($_SESSION["uType"] == "tutor") {
                showAssessmentsTutor($conn);
            }
        }
        

        else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    ?>
</div>

<?php
include("includes/footer.php");
?>