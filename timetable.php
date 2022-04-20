<?php
    $title = "imetables";
    require_once("includes/header.php");
    include("includes/nav.php");
?>

<div class="container">
    <?php
    if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "tutor") {
        $sql = "SELECT courseID FROM courses";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
            showTimetable($conn, $row["courseID"]);
        }
    }
    if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "student") {
        $username = $_SESSION["username"];
        $sql = "SELECT courseID FROM studentCourses WHERE username = $username";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
            showTimetable($conn, $row["courseID"]);
        }
    }
    else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    ?>

</div>
