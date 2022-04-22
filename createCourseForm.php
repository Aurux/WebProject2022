<?php
    session_start();
    require("scripts/functions.php");
    //require("scripts/ajax.php");
    $conn = connectDatabase(true);

    echo "<table id='courseTable'><caption>Create Course</caption>
        <tr><td>Course Name</td><td><input type='textbox' id='name' placeholder='Enter a course name...'></td></tr>
        <tr><td>Course Credits</td><td><input type='number' min='0' id='credits' placeholder='Enter credit value...'></td></tr>
        <tr><td><input class='backButton' type='button' onclick='window.location.reload();' value='Go back'></td><td><input type='button' value='Create' onclick='addCourse()'></td></tr></table>";

?>