<?php

function connectDatabase($dbExists) {
    //create connnection credentials
    $db_host = 'localhost';
    $db_name = 'bowlingDB';
    $db_user = 'root';
    $db_pass = 'traffic-surprise-pungent';

    //create mysqli object
    if ($dbExists) $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    else $conn = new mysqli($db_host, $db_user, $db_pass);

    return $conn;
}

?>