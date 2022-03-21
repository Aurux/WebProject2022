<?php include 'database.php'; ?>
<?php session_start(); ?>
<?php
   $number = (int) $_GET['n'];
   $query = "SELECT * FROM `questions` WHERE question_number = $number";
   $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
   $question = $result->fetch_assoc();

   
   $number = (int) $_GET['n'];
   $query = "SELECT * FROM `choices` WHERE question_number = $number";
   $choices = $mysqli->query($query) or die($mysqli->error.__LINE__);
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Quiz</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <title>Moodle Login</title>
    <body>
        <header>
        <img src="images/logo.png" alt="Trulli" width="100" height="80">
          Bowling University Moodle
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
    <body>
        <main>
            <div class="container">
                <div class="current">Question <?php echo $question['question_number']; ?> of 15</div><br>
                <p class="question">
                    <?php echo $question['question_text']; ?>
                </p><br>
                <form method="post" action="process.php">
                    <ul class="choices">
                        <?php while($row = $choices->fetch_assoc()): ?>
                            <li><input name="choice" type="radio" value="<?php echo $row['id']; ?>" /><?php echo $row['choices_text']; ?></li><br>
                        <?php endwhile; ?>
                    </ul>

                     <div class = "button">
                        <input type="submit" value="Submit"/>
                        <input type="hidden" name="number" value="<?php echo $number; ?>" />
                     </div>
                </form>
                </div>
            </div>
        </main>
    </body>
</html>

<?php

?>