<?php include 'database.php'; ?>
<?php

    $query ="SELECT * FROM questions";
    $results = $mysqli->query($query) or die($mysqli->error.__LINE__);
    $total = $results->num_rows;
?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <title>Moodle Login</title>
    <body>
        <header>
          <img src="images/logo.png" alt="Trulli" width="100" height="80">
          Bowling Univeristy Moodle
        </header>
        <ul id="navi">
            <li><a href="index.html">Home</a></li>
            <li><a href="enroll.html">Enroll</a></li>
            <li><a href="help.html">Help</a></li>
            <li><a class="active" href="QuizIndex.php">Quiz</a></li>
            <li><a href="calendar.php">Calendar</a></li>
            <li><a href="assessments.php">Assessments</a></li>
            <li><a href="timetable.php">Timetable</a></li>
        </ul>
        <div class ="container">
          <h1 id ="h1">
            Bowling quiz</h1>
          <br>
          <p id ="quizP1">
            In this quiz you will be assessed on your knowledge about bowling. This quiz will consist
            of a series of multiple choice questions. You will have one attempt to complete the quiz. <br><br> Results will be recorded.
            The quiz will consist of 10 questions on the subject of bowling, and will take about 5-10 minutes to complete. 
            In order to pass you must score over 40% or over of the total marks.</p>      
            <div class="center">
              <a href="question.php?n=1" class="start">Start Quiz</a>
            </div>
        </div>
    <body>
    <footer>
        Website by Team Name, 2021
    </footer>
</html>