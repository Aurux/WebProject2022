
<?php
    $title = "Timetable";
    require_once("includes/header.php");
    include("includes/nav.php");
?>

<div class="container">
<table class="timetable">
    <tr>
        <th>Course ID</th>
        <th>Time</th>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thursday</th>
        <th>Friday</th>
    </tr>
    <?php
    if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "student") echo "<h1>Your Timetable</h1><br>", showTimetable($conn,$_SESSION["username"]);
    else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";



    ?>


</table>
</div>

