<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    function logout(){

    }

</script>

<ul id="navi">
            
            <?php
                error_reporting(E_ALL ^ E_WARNING); 
                if($_SESSION["loggedIn"] == true) echo '<li><a href="' . $_SESSION["uType"] .'_home.php">Your Home</a></li>';
                else echo '<li><a href="index.php">Home</a></li>';

                if($_SESSION["loggedIn"] != true) echo '<li><a href="enroll.php">Enroll</a></li>';

                if($_SESSION["loggedIn"] == true) {
                    echo '<li><a href="timetable.php">Timetables</a></li>
                        <li ><a href="calendar.php">Calendar</a></li>';
                    if ($_SESSION["uType"] == "student") echo '<li><a href="assessments.php">Assessments</a></li>';
                    
                   
                }

                if($_SESSION["loggedIn"] == true) echo "<li style=\"float:right;\"><a href=\"logout.php\">Logout</a></li>";
                else echo "<li style=\"float:right;\"><a href=\"login.php\">Login</a></li>";
                 
            ?>
            
            
            <li style="float:right;"><a href="help.php">Help</a></li>
            
        </ul> 