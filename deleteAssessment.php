<?php
    session_start();
    require("scripts/functions.php");
    $conn = connectDatabase(true);

    $courseID = $_POST["courseID"];
    $assID = $_POST["id"];

    $sql = "DELETE FROM assessments WHERE id = '$assID' AND courseID = '$courseID'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        consoleLog("Assessment removed successfully!");
    }
    else consoleLog("Failed to remove assessment.");

    mysqli_close($conn);
?>