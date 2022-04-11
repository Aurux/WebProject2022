<?php include 'header.php'; ?>
<?php

    $fn = $_POST['frmForename'];
    $sn = $_POST['frmSurname'];
    $gen = $_POST['frmGender'];
    $dob = $_POST['frmDateOfBirth'];
    $cs = $_POST['frmCourse'];
    $pw = $_POST['frmPassword'];
    $em = $_POST['frmEmail'];

    $sql = "INSERT INTO user (forename, surname, gender, dob, course, email, password)
            VALUES ('$fn', '$sn', '$gen', '$dob', '$cs', '$em', '$pw',)";
    
    mysqli_query ($mysqli, $sql) or die (mysqli_error($mysqli));

    ?>
