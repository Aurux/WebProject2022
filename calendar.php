<?php
    $title = "Calendar";
    require_once("includes/header.php");
    include("includes/nav.php");
?>

<body>
	<div class="content"><br><Br>
    <?php
        if ($_SESSION["loggedIn"] == true) echo draw_calendar($month,$year);
        else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
       
    ?>
	</div>
    <br><Br>
</body>
