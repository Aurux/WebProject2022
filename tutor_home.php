
<?php
    $title = "Tutor Home";
    require_once("includes/header.php");
    include("includes/nav.php");
    require("scripts/ajax.php");
?>


<div id="tutorHomeContent">
    <?php
        if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "tutor") showTutorHome($conn);
        else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    ?>
</div>

<?php
include("includes/footer.php");
?>