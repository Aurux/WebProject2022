<?php
//create connnection credentials
$db_host = 'localhost:3307';
$db_name = 'quizdatabase';
$db_user = 'root';
$db_pass = '';

//create mysqli object
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if($mysqli->connect_error){
    printf("connect failed: %s\n", $mysqli->connect_error);
    exit();
}