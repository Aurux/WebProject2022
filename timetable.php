
<?php
    $title = "Timetable";
    require_once("includes/header.php");
    include("includes/nav.php");
?>

<div class="container">
<table class="timetable">
    <tr>
        <th>Course ID</th>
        <th>Time</th>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thursday</th>
        <th>Friday</th>
    </tr>
    <?php
    if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "student") echo "<h1>Your Timetable</h1>";
    else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";
    $sql ="SELECT courseID, time, monday, tuesday, wednesday, thursday, friday FROM timetable WHERE courseID='3'";
    $result = $conn->query($sql);

    if($result -> num_rows > 0) {
        while ($row = $result -> fetch_assoc()){
            echo "<tr><td>". $row["courseID"]."</td><td>".$row["time"]."</td><td>".$row["monday"]."</td><td>".$row["tuesday"]
            ."</td><td>".$row["wednesday"]."</td><td>".$row["thursday"]."</td><td>".$row["friday"]."</td></tr>";

        }
        echo "</table>";
    }
    else{
        echo "0 result";
    }

    ?>


</table>
</div>

