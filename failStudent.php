<?php
    // Mark student as failed for assessment
    session_start();
    require("scripts/functions.php");
    $conn = connectDatabase(true);

    extract($_POST);

    $sql = "UPDATE studentAssessments SET completed='1' WHERE id = '$id' AND username = '$username'";
    mysqli_query($conn, $sql);

    $sql = "SELECT creditWeight FROM assessments WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);



    echo "Failed";
?>