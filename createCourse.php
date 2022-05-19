<?php
    // Add course to DB
    session_start();
    require("scripts/functions.php");
    $conn = connectDatabase(true);

    extract($_POST);

    $sql = "INSERT INTO courses (courseName, courseCredits) VALUES ('$name', '$credits');";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        consoleLog("Course added successfully!");
    }
    else consoleLog("Failed to add course.");

    mysqli_close($conn);
?>