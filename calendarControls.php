<?php
//controls for calendar
//GET month
$month = (int) ($_GET['month'] ? $_GET['month'] : date('m'));
//Get year
$year = (int)  ($_GET['year'] ? $_GET['year'] : date('Y'));
//LINKS TO SELECT MONTHS
$next_month = '<a href="?month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1).'" class="control">Next Month &gt;&gt;</a>';
$previous_month = '<a href="?month='.($month != 1 ? $month - 1 : 12).'&year='.($month != 1 ? $year : $year - 1).'" class="control">&lt;&lt; 	Previous Month</a>';
$controls = '<form method="get"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$previous_month.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$next_month.' </form>';
//DISPLAY CONTROLS
echo '<br><h2 style="float:left; padding-right:110px;">'.date('F',mktime(0,0,0,$month,1,$year)).' '.$year.'</h2>';
echo '<div style="float:left;">'.$controls.'</div>';
echo '<br /><br />';