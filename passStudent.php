<?php
    session_start();
    require("scripts/functions.php");
    $conn = connectDatabase(true);

    extract($_POST);

    $sql = "UPDATE studentAssessments SET completed='1' WHERE id = '$id' AND username = '$username'";
    mysqli_query($conn, $sql);

    $sql = "SELECT creditWeight FROM assessments WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)){
        $weight = $row["creditWeight"];
    }
    $sql = "UPDATE studentAssessments SET completion='$weight' WHERE id = '$id' AND username = '$username'";
    mysqli_query($conn, $sql);

    $sql = "UPDATE studentCourses SET completion = completion + '$weight' WHERE username = '$username' AND courseID = '$courseID';";
    mysqli_query($conn, $sql);

    echo "Passed";
?>