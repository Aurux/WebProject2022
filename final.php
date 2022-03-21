<?php include 'database.php'; ?>
<?php session_start(); ?>
<!DOCTYPE html>

<html>
    <head>
        <title>Quiz</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <script type="text/javascript" src="quiz.js"></script>
    </head>
    <title>Moodle Login</title>
    <body>
        <header>
        <img src="images/logo.png" alt="Trulli" width="100" height="80">
        Bowling University Moodle</header>
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
                <div class="final">
                    <h2>You're done!</h2>
                    <p>Congrats</p>
                    <P>Final score: <?php echo $_SESSION['score']; ?>/15</P>
                    <div class = "restart">
                        <a href="question.php?n=1" class="reset" value ="<?php unset($_SESSION['score']); ?>">Take again</a>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>