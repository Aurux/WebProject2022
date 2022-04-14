<?php
    require("scripts/functions.php");
    $conn = connectDatabase(true);
    session_start();
?>

<head>
        <?php echo "<title>" . $title . "</title>"; ?>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <link rel="icon" type="image/x-icon" href="/images/logo.png">
</head>
<header>
    <?php
    if ($_SESSION["loggedIn"] == true) echo '<div id="userInfo">'.
    $_SESSION["forename"] .' '. $_SESSION["surname"].'<br>
        User ID: '. $_SESSION["username"] .
    '</div>';
    ?>
<img src="images/logo.png"  width="100" height="80">
Bowling University Moodle
</header>