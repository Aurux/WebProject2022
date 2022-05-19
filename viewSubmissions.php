
<?php
    // Get submissions for course
    session_start();
    require("scripts/functions.php");
    //require("scripts/ajax.php");
    $conn = connectDatabase(true);


    $username = $_POST["username"];
    
    $sql = "SELECT courseName FROM courses WHERE courseID = '$courseID'";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($result)) {
        $courseName = $row["courseName"];
    }

  

    
    
    
    try {
        $sql = "SELECT * FROM assessments WHERE courseID = '$courseID'";
    }
    catch (TypeError $e){
        consoleLog($e);
    }

    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);

    echo "<table id='courseTable'><caption>$courseName Assessments</caption>";

    if ($numrows >= 1){
        echo "<th>Assessment</th><th>Course Value</th><th>Deadline</th>";
        while($row = mysqli_fetch_array($result)){
            $percent = $row["creditWeight"] * 100;
            echo '<tr><td>'. htmlspecialchars($row['title']) .'</td>
            <td>'. htmlspecialchars($percent) .'%</td>
            <td>'. htmlspecialchars($row['deadline']) . '</td>';
            
            echo '<td><input type="button" value="Delete" onclick="deleteAssessment('.$row['id'].','.$courseID.')"></td></tr>';
        }
    }
    else {
        echo "<tr><td>There are no assessments for this course.</td></tr>";
    }
    echo "<tr><td></td><td><input class='backButton' type='button' onclick='window.location.reload();' value='Go back'></td><td><input type='button' value='Add Assessment' onclick='viewAddAssessment(". $courseID . ")'></td></tr></table>";
    mysqli_close($conn);
?>