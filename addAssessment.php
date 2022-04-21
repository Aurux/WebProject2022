<?php
    session_start();
    require("scripts/functions.php");
    $conn = connectDatabase(true);
    consoleLog("here");
    extract($_POST);
    $weight = $weight / 100;

    $sql = "INSERT INTO assessments (title, info, deadline, courseID, creditWeight) VALUES ('$title', '$info', '$deadline', '$courseID', '$weight');";
    $result = mysqli_query($conn, $sql);

    $sql = "SELECT id FROM assessments WHERE title = '$title' AND courseID = '$courseID'";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($result)) {
        $id = $row["id"];
    }

    $sql = "SELECT username FROM studentCourses WHERE courseID = '$courseID'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)){
        $username = $row["username"];
        $sql = "INSERT INTO studentAssessments (username, id) VALUES ('$username', '$id')";
        mysqli_query($conn, $sql);
    }

    if ($result) {
        consoleLog("Assessment added successfully!");
    }
    else {
        $message = "Failed to add assessment.". mysqli_error($conn);
        consoleLog($message);
    }
    mysqli_close($conn);
?>