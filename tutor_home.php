<?php
    $title = "Tutor Home";
    require_once("includes/header.php");
    include("includes/nav.php");
?>


<div id="homeContent">
    <?php
        if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "tutor") echo showStudentHome();
        else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    ?>
</div>

<?php
include("includes/footer.php");
?>