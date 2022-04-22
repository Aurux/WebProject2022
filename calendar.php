<?php
    $title = "Calendar";
    require_once("includes/header.php");
    include("includes/nav.php");
?>

<body>
	<div class="content"><br><Br>
    <?php
    $month = (int) ($_GET['month'] ? $_GET['month'] : date('m'));
    $year = (int)  ($_GET['year'] ? $_GET['year'] : date('Y'));
    $next_month_link = '<a href="?month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1).'" class="control">Next Month &gt;&gt;</a>';
    $previous_month_link = '<a href="?month='.($month != 1 ? $month - 1 : 12).'&year='.($month != 1 ? $year : $year - 1).'" class="control">&lt;&lt; 	Previous Month</a>';
    $controls = '<form method="get"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$previous_month_link.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$next_month_link.' </form>';
    echo '<h2 style="float:left; padding-right:30px;">'.date('F',mktime(0,0,0,$month,1,$year)).' '.$year.'</h2>';
    echo '<div style="float:left;">'.$controls.'</div>';
    echo '<br /><br />';
    ?>
        <?php 
        if ($_SESSION["uType"] == "tutor") echo addCalendarEvent($conn, $courseID);
        if ($_SESSION["loggedIn"] == true) echo draw_calendar($conn,$month,$year,$events,$courseID);
        else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
       
    ?>
	</div>
    <br><Br>
</body>
