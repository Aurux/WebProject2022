
<?php
    session_start();
    require("scripts/functions.php");
    //require("scripts/ajax.php");
    $conn = connectDatabase(true);


    $courseID = $_POST["courseID"];


    echo "<table id='courseTable'><caption>$courseName Assessments</caption>";

    echo "<tr><td>Assessment Title</td><td><input type='textbox' placeholder='Enter a title...' id='title'></td></tr>
        <tr><td>Description</td><td><input type='textbox' placeholder='Enter a description...' id='desc'></td></tr>
        <tr><td>Deadline</td><td><input type='date' id='deadline'></td></tr>
        <tr><td>Course Percent Value</td><td><input type='number' min='0' max='100' id='weight'></td></tr>";
    echo "<tr><td><input class='backButton' type='button' onclick='window.location.reload();' value='Go back'></td><td><input type='button' value='Add Assessment' onclick='addAssessment(". $courseID . ")'></td></tr></table>";
    mysqli_close($conn);
?>