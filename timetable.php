<?php
    $title = "Timetables";
    require_once("includes/header.php");
    include("includes/nav.php");
?>

<div id="timetableContainer">
    <?php
    // DISPLAY STUDENT TIMETABLE
    if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "tutor") {
        $sql = "SELECT courseID FROM courses";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
            showTimetable($conn, $row["courseID"]);
        }
    }
    //DISPLAY ALL TIMETABLES 
    else if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "student") {
        $username = $_SESSION["username"];
        $sql = "SELECT courseID FROM studentCourses WHERE username = $username";
        $result = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_array($result)) {
            showTimetable($conn, $row["courseID"]);
        }else{
            echo '<div id="noTimetable"> You have not been assigned to any courses.</div>';
        }
    }
    else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    ?>

</div>
<?php include("includes/footer.php")?>
