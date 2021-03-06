<!--This will be displayed on 'quiz content' page -->
<?php
    $title = "Calendar";
    require_once("includes/header.php");
    include("includes/nav.php");
?>
<body>
    <div id="calendar">
	<div class="content"><br><Br>
    <?php 
    //display functions depending on user type
        if ($_SESSION["uType"] == "tutor") echo addCalendarEvent($conn, $courseID);
        if ($_SESSION["uType"] == "tutor") echo deleteCalendarEvent($conn,$delete_event);
        include('calendarControls.php');
        if ($_SESSION["loggedIn"] == true) echo draw_calendar($conn,$month,$year,$events);
        

        else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    ?>
	</div>
    </div>
</body>
<?php include("includes/footer.php")?>

