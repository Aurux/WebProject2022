
<?php
    $title = "Timetable";
    require_once("includes/header.php");
    include("includes/nav.php");
?>

<div class="container">
<table class="timetable">
    <?php
    if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "student") echo "<h1>Your Timetable</h1><br>", showStudentTimetable($conn,$_SESSION["username"]);
    else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    ?>
</table>
</div>

