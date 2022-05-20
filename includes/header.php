<?php
    require("scripts/functions.php");
    $conn = connectDatabase(false);
    session_start();
?>

<head>
        <?php echo "<title>" . $title . "</title>"; ?>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <link rel="icon" type="image/x-icon" href="/images/logo.png" alt="university logo">

        <meta charset="UTF-8">
        <meta name="description" content="Nationally Accredited Univeristy for the indoor bowling sport">
        <meta name="keywords" content="Univeristy, Bowling, Lanes, Degree, Sport, Alley, Courses">
        <meta name="author" content="Ben Wilson, Dan Glancy">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<header>
    <?php
    // Logged in user info box
    error_reporting(E_ALL ^ E_WARNING); 
    if ($_SESSION["loggedIn"] == true) echo '<div id="userInfo">'.
    $_SESSION["forename"] .' '. $_SESSION["surname"].'<br>
        User ID: '. $_SESSION["username"] .
    '</div>';
    ?>
<img src="images/logo.png"  width="100" height="80" alt="bowling ball background">
Bowling University Moodle
</header>