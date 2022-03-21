<?php

function connectDB($dbExists) {
    //create connnection credentials
    $db_host = 'localhost:3306';
    $db_name = 'quizdatabase';
    $db_user = 'root';
    $db_pass = 'traffic-surprise-pungent';

    //create mysqli object
    if ($dbExists) $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    else $conn = mysqli_connect($db_host, $db_name, $db_pass);

    return $conn;

}






?>