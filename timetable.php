<?php include 'database.php'; ?>
<?php include 'functions.php'; ?>
<?php session_start(); ?>
<?php

   $query = "SELECT * FROM `Timetable`";
   $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
   $Timetable = $result->fetch_assoc();


?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <title>Moodle Login</title>
    <body>
        <header>
          <img src="images/logo.png" alt="Trulli" width="100" height="80">
          Bowling University Moodle
        </header>
        <ul id="navi">
        <li><a href="index.html">Home</a></li>
            <li><a href="enroll.html">Enroll</a></li>
            <li><a href="help.html">Help</a></li>
            <li><a href="QuizIndex.php">Quiz</a></li>
            <li><a href="calendar.php">Calendar</a></li>
            <li><a href="assessments.php">Assessments</a></li>
            <li><a class="active" href="timetable.php">Timetable</a></li>
        </ul>
    </body>
    <main>
      <div class="container">
        <div class = "current">
          <div class = "table">
            <THEAD>
              
            </THEAD>
            <?php
             echo "<table border>";
             echo "<th>Time</th>";
             echo "<th>Monday</th>";
             echo "<th>Tuesday</th>";
             echo "<th>Wednesday</th>";
             echo "<th>Thursday</th>";
             echo "<th>Friday</th>";
             while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
             foreach ($row as $field => $value) {
                echo "<td>" . $value . "</td>";
             }
             echo "</tr>";
             }
             echo "</table>";
            ?>
          </div>
        </div>
      </div>
    </main>

    <!--
    <TABLE class="myTimetable"> 
        <h1>My Timetable</h1>
    <THEAD>
    <TR>
      <TH></TH>
      <TH>Monday</TH>
      <TH>Tuesday</TH>
      <TH>Wednesday</TH>
      <TH>Thursday</TH>
      <TH>Friday</TH>     
    </TR>
    </THEAD>
    <TBODY>
        <TR>
            <TD>9:00</TD>
            <TD>
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>     
        </TR>
        <TR>
            <TD>10:00</TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
        </TR>
        <TR>
            <TD>11:00</TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
        </TR>
        <TR>
            <TD>12:00</TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
        </TR>
        <TR>
            <TD>13:00</TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
        </TR>
        <TR>
            <TD>14:00</TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
        </TR>
        <TR>
            <TD>15:00</TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
        </TR>
        <TR>
            <TD>16:00</TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
        </TR>
        <TR>
            <TD>17:00</TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
            <TD>        
              <div class="subject"></div>
              <div class="room"></div>
            </TD>
        </TR>
   </TBODY>
   </TABLE>
   </body>
</html>

  
