<?php
    require_once("functions.php");
    $conn = connectDB(false);

    $sql = "CREATE DATABASE IF NOT EXISTS bowling_DB";
    if (mysqli_query($conn, $sql)) echo "DB created.";
    else echo "DB failed to be created: " . mysqli_error($conn);

    $sql = "USE bowling_DB";
    mysqli_query($conn, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS users (
                username VARCHAR(20) PRIMARY KEY,
                forename VARCHAR(30) NOT NULL,
                surname VARCHAR(50) NOT NULL,
                type ENUM('student', 'tutor') NOT NULL,
                password VARCHAR(255) NOT NULL,
                authorised TINYINT
            )";

    if (mysqli_query($conn, $sql)) echo "<p>TABLE users CREATED.</p>";
	else echo "<p>TABLE users FAILED TO BE CREATED: " . mysqli_error($conn) . "</p>";





    mysqli_close($conn);
?>