<?php
    $title = "Student Home";
    require_once("includes/header.php");
    include("includes/nav.php");
?>


<div id="homeContent">
    <?php
        if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "student")  showStudentHome($conn, $_SESSION["username"]);
        else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    ?>
</div>

<?php
include("includes/footer.php");
?>