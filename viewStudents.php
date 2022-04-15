<?php
    session_start();
    require("scripts/functions.php");
    $conn = connectDatabase(true);

    var_dump($_POST);
    consoleLog("POST DATA: ".$_POST["courseID"]);
    $courseID = $_POST["courseID"];
    consoleLog("variable: ".$courseID);
    //$sql = "SELECT courseName FROM courses WHERE courseID = '$courseID'";
    //$courseName = mysqli_fetch_field(mysqli_query($conn, $sql));

  

    $sql = "SELECT username FROM studentCourses WHERE courseID = '$courseID'";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($result)) {
        $userRow[] = $row["username"];
    }
    
    
    try {
        $sql = "SELECT * FROM users WHERE username IN(" . implode(',', $userRow) . ")";
    }
    catch (TypeError $e){
        consoleLog($e);
    }

    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);

    echo "<table id='courseTable'><caption>Course Name</caption>";

    if ($numrows >= 1){
        echo "<th>Name</th><th>ID</th>";
        while($row = mysqli_fetch_array($result)){
            echo '<tr><td>'. htmlspecialchars($row['forename']) .' '.htmlspecialchars($row['surname']).'</td>
            <td>'. htmlspecialchars($row['username']) . '</td></tr>';
        }
    }
    else {
        echo "<tr><td>There are no students on this course.</td></tr>";
    }
    echo "</table>";
?>