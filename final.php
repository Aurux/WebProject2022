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
        <header>Bowling Univeristy Moodle</header>
        <ul id="navi">
            <li><a href="index.html">Home</a></li>
            <li><a href="enroll.html">Enroll</a></li>
            <li><a href="help.html">Help</a></li>
        </ul>
    <body>
        <main>
            <div class="container">
                <h2>You're done!</h2>
                <p>Congrats</p>
                <P>Final score: <?php echo $_SESSION['score']; ?></P>
                <a href="question.php?n=1" type="reset">Take again</a>

            </div>
        </main>
    </body>
</html>