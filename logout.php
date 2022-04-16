<?php
    session_start();
    session_destroy();
    $_SESSION["loggedIn"] = false;
    header("refresh:0; url=index.php");
?>