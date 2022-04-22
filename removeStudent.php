<?php
    session_start();
    require("scripts/functions.php");
    $conn = connectDatabase(true);

    $courseID = $_POST["courseID"];
    $studentID = $_POST["studentID"];

    $sql = "DELETE FROM studentCourses WHERE username = '$studentID' AND courseID = '$courseID'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        consoleLog("Student removed successfully!");
    }
    else consoleLog("Failed to remove student.");

    mysqli_close($conn);
?>