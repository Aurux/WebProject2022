<?php
    session_start();
    require("scripts/functions.php");
    $conn = connectDatabase(true);

    $courseID = $_POST["courseID"];
    $week = $_POST["week"];

    $dirPath = "uploads/" . $courseID . "/week" . $week . "/";

    $contents = scandir($dirPath);
    
    if ($contents == "") {
        echo "No files for this week.";
    }
    else {
        echo "<ul style='list-style-type: square;'>";
        foreach ($contents as $file) {
            if (strlen($file) > 2) {
                echo "<li><a href='". $dirPath . $file . "'>$file</a></li><br>";
            }
            
        }
        echo "</ul>";
    }

    


?>