<?php
    require_once("functions.php");
    $conn = connectDB(false);

    $sql = "CREATE DATABASE IF NOT EXISTS bowling_DB";
    if (mysqli_query($conn, $sql)) echo "DB created.";
    else echo "DB failed to be created: " . mysqli_error($conn);

    $sql = "USE bowling_DB";
    mysqli_query($conn, $sql)


?>