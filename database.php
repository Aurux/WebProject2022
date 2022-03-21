<?php
//create connnection credentials
$db_host = 'localhost:3307';
$db_name = 'quizdatabase';
$db_user = 'root';
$db_pass = 'traffic-surprise-pungent';

//create mysqli object
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if($conn->connect_error){
    printf("connect failed: %s\n", $conn->connect_error);
    exit();
}

$query ="SELECT * FROM questions";
$results = $conn->query($query) or die($conn->error.__LINE__);

$number = (int) $_GET['n'];
$query = "SELECT * FROM `questions` WHERE question_number = $number";
$result = $conn->query($query) or die($conn->error.__LINE__);
$question = $result->fetch_assoc();


$number = (int) $_GET['n'];
$query = "SELECT * FROM `choices` WHERE question_number = $number";
$choices = $conn->query($query) or die($conn->error.__LINE__);