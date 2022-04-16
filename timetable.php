
<?php
    $title = "Timetable";
    require_once("includes/header.php");
    include("includes/nav.php");
?>

<div class="container">
<h1>Student timetable</h1><br>
<table class="timetable">
    <tr>
        <th>courseID</th>
        <th>time</th>
        <th>monday</th>
        <th>tuesday</th>
        <th>wednesday</th>
        <th>thursday</th>
        <th>friday</th>
    </tr>
    <?php
    $sql ="SELECT courseID, time, monday, tuesday, wednesday, thursday, friday FROM timetable WHERE courseID='1'";
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

