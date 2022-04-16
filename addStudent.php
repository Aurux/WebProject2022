<?php
    session_start();
    require("scripts/functions.php");
    $conn = connectDatabase(true);

    $courseID = $_POST["courseID"];
    $studentID = $_POST["studentID"];

    $sql = "INSERT INTO studentCourses (username, courseID) VALUES ($studentID, $courseID);";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        consoleLog("Student added successfully!");
    }
    else consoleLog("Failed to add student.");

    mysqli_close($conn);
?>