<?php
//create connnection credentials
$db_host = 'localhost:3307';
$db_name = 'quizdatabase';
$db_user = 'root';
$db_pass = 'traffic-surprise-pungent';

$sql = "CREATE TABLE `test`.`questions` ( `question_number` INT(11) NOT NULL AUTO_INCREMENT , `question_text` TEXT NOT NULL , PRIMARY KEY (`question_number`)) ENGINE = InnoDB;";

$sql = "CREATE TABLE `test`.`choices` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `question_number` INT(11) NOT NULL , `is_correct` TINYINT(1) NOT NULL DEFAULT '0' , `text` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";


//create mysqli object
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if($mysqli->connect_error){
    printf("connect failed: %s\n", $mysqli->connect_error);
    exit();
}
