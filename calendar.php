<?php
    $title = "Calendar";
    require_once("includes/header.php");
    include("includes/nav.php");
?>

<body>
	<div class="content"><br><Br>
    <?php
       echo draw_calendar($month,$year);
    ?>
	</div>
    <br><Br>
</body>
