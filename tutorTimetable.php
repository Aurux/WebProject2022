<?php
    $title = "View Student Timetables";
    require_once("includes/header.php");
    include("includes/nav.php");
?>

<div class="container">
<table class="timetable">
    <?php
    if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "tutor") echo "<h1>Student Timetables</h1><br><P>Introduction to bowling - course ID:1</P><br>", showTutorTimetable1($conn);
    else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    ?>
</table>

<table class="timetable">
    <?php
    if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "tutor") echo "<br><p>Intermediate bowling - course ID:2</p><br>", showTutorTimetable2($conn);
    else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    ?>
</table>
<table class="timetable">
    <?php
    if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "tutor") echo "<br><p>Advanced bowling - course ID:3</p><br>", showTutorTimetable3($conn);
    else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    ?>
</table>
<table class="timetable">
    <?php
    if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "tutor") echo "<br><p>Alley management - course ID:4</p><br>", showTutorTimetable4($conn);
    else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    ?>
</table>
<table class="timetable">
    <?php
    if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "tutor") echo "<br><p>Strike animation - course ID:5</p><br>", showTutorTimetable5($conn);
    else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    ?>
</table>
<table class="timetable">
    <?php
    if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "tutor") echo "<br><p>Lane oiling - course ID:6</p><br>", showTutorTimetable6($conn);
    else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    ?>
</table>
</div>