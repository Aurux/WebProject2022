<?php


function connectDatabase($dbExists) {
    //create connnection credentials
    $db_host = 'localhost';
    $db_name = 'bowlingDB';
    $db_user = 'root';
    $db_pass = 'traffic-surprise-pungent';

    //create mysqli object
    if ($dbExists) $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    else $conn = new mysqli($db_host, $db_user, $db_pass);

    return $conn;
}

function showEnrollForm() {
    echo '
    
    <form name="frmRegister" id="frmRegister" method="POST" action="enroll.php" onsubmit=" return validate(event)"  >
        
    <table>
        <tr><td>Forename<br><input name="frmForename" type="textbox" placeholder="Your first name..." required/><br><p1 id="fname" style="display:none">Must be 2-64 characters long<br>using only upper and lowercase letters.</p1></td>
        <td>Surname<br><input name="frmSurname"  type="textbox" placeholder="Your last name..." required/><br><p1 id="sname" style="display:none">Must be 2-64 characters long<br>using only upper and lowercase letters.</p1></td></tr>
        
        <tr><td>Email<br><input name="frmEmail"  type="textbox" placeholder="Your email..." required/><br><p1 id="email" style="display:none">Please enter a valid email address.</p1></td>
        <td>Confirm Email<br><input name="frmEmailConf"  type="textbox" placeholder="Confirm Email..." required/><br><p1 id="email2" style="display:none">Email must match.</p1></td></tr>
        <tr><td>Password<br><input name="frmPassword"  type="password" placeholder="Enter password" required/><br><p1 id="pword" style="display:none">Must be 8-32 characters long using upper and lower case<br>and contain at least one number.</p1></td>
        <td>Confirm Password<br><input name="frmPasswordConf"  type="password" placeholder="Confirm password" required/><br><p1 id="pword2" style="display:none">Passwords must match.</p1></td></tr>
        <tr><td>Account Type<br>
                <label><input name="frmType" value="student" type="radio" required>Student</label><br>
                <label><input name="frmType" value="tutor" type="radio">Tutor</label><br></td>
        
        
        
        <td style="text-align: center;"><input type="button" value="Clear All" onclick="clearAll()">&nbsp;&nbsp;&nbsp;<input type="submit" onclick="submitted = true;" value="Submit"/></td></tr>
  
    </table>
    
     
    </form>';
}

function processEnroll($conn) {
    extract($_POST);
    $password = password_hash($frmPassword, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (forename, surname, uType, email, pass) VALUES('$frmForename', '$frmSurname', '$frmType', '$frmEmail', '$password')";

    if (mysqli_query($conn, $sql)) $result = True;
    else $result = False;

    $sql = "SELECT username FROM users WHERE email = '$frmEmail'";
    $sql_result = mysqli_query($conn, $sql);

    $show_result = $sql_result->fetch_array()['username'] ?? '';
    
    if ($result == True) {
        $result = "<br><br><br><br><p>You have enrolled succesfully! Your login ID is: " . $show_result . "</p>";
        $_SESSION["username"] = $show_result;
    }
    else $result = "<p>Enrollment failed, please try again in a little while.</p>";

    return $result;
}

function showLogin() {
    echo '
    <form method="POST" action="login.php">
        <table>
            <tr><td>User ID<br><input name="userID" type="textbox" placeholder="Your user ID..." required/></td></tr>
            <tr><td>Password<br><input name="userPass" type="password" placeholder="Your password..." required/></td></tr>
            <tr><td style="text-align: center;"><input type="submit" value="Submit"/></td></tr>
        
        </table>
    
    </form>
    ';
}

function processLogin($conn) {
    extract($_POST);
    $sql = "SELECT * FROM users WHERE username = '$userID'";
    $result = mysqli_query($conn, $sql);

    $rowcount = mysqli_num_rows($result);
    if ($rowcount == 1) {

        $row = mysqli_fetch_array($result);
        extract($row);

        
        if (password_verify($userPass, $pass)) {
            
            
            $_SESSION["loggedIn"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["forename"] = $forename;
            $_SESSION["surname"] = $surname;
            $_SESSION["uType"] = $uType;

            $returnVar = "<p>Welcome to the lanes, $forename! <br> You will be automatically redirected to the $uType home. If this doesn't work, please click <a href='{$uType}_home.php'>here.</a></p>";
            header("refresh:2; url={$uType}_home.php");
        }
        else {
            $returnVar = "<p>Something seems to be incorrect with the details you have provided. Please try again.<br>If you are a new student please enroll before attempting to login.</p>";
            header("refresh:2; url=index.php");
        }

        
    }
    if ($rowcount > 1) {
        $returnVar = "<p>There is something wrong with your account, please contact the system administrator.</p>";
    }
    if ($rowcount == 0) {
        $returnVar = "<p>Something seems to be incorrect with the details you have provided. Please try again.<br>If you are a new student please enroll before attempting to login.</p>";
    }

    return $returnVar;
}

function showStudentHome($conn, $username) {

    $sql = "SELECT courseID FROM studentCourses WHERE username = '$username';";
    $result = mysqli_query($conn, $sql); 

    while($row = mysqli_fetch_array($result)) {
        $courseRow[] = $row["courseID"];
    }
    
    
    try {
        $sql = "SELECT * FROM courses WHERE courseID IN(" . implode(',', $courseRow) . ")";
    }
    catch (TypeError $e){
        consoleLog($e);
    }
    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);

    echo "<h1>Your Student Home Page</h1><br>";

    echo "<aside><table><caption>Your Courses</caption>";

    if ($numrows >= 1){
        echo "<th>Course</th><th>Credits</th>";
        while($row = mysqli_fetch_array($result)){
            echo '<tr><td>'. htmlspecialchars($row['courseName']) .'</td>
            <td>'. htmlspecialchars($row['courseCredits']) . '</td></tr>';
        }
    }
    else {
        echo "<tr><td>You have not been assigned to any courses.</td></tr>";
    }
    echo "</table></aside>";
}

function showTutorHome($conn) {

    $sql = "SELECT * FROM courses;";
    $result = mysqli_query($conn, $sql);

    
    echo "<h1>Your Tutor Home Page</h1><br>";

    echo "<table id='courseTable'><caption>Courses</caption><th>Course</th><th>Credits</th>";

    while($row = mysqli_fetch_array($result)){
        echo '<tr><td>'. htmlspecialchars($row['courseName']) .'</td>
        <td>'. htmlspecialchars($row['courseCredits']) . '</td>
        <td><input type="button" class="tutorButtons" value="View Students" name="'.$row["courseID"].'" onclick="viewStudents('.$row["courseID"].')"></td>
        </tr>';
    }

    echo "</table>";

    $sql = "SELECT * from courses ORDER BY courseName DESC;";
    $courseResult = mysqli_query($conn, $sql);

    if (isset($_POST["week"])) {
        $week = $_POST["week"];
    }
    else $week = 1;

    
    
    echo '
        <table><caption>Manage Course Material</caption>
        <form method="POST" action="" id="uploadForm" enctype="multipart/form-data">
            <tr><td>Course</td><td>
            <select name="course" required>';
            while($row = mysqli_fetch_array($courseResult)){
                if (isset($_POST["course"]) && $row["courseID"] == $_POST["course"]) {
                    echo '<option selected value="'.$row["courseID"].'">'.htmlspecialchars($row["courseName"]).'</option>';
                }
                else echo '<option value="'.$row["courseID"].'">'.htmlspecialchars($row["courseName"]).'</option>';
                
            }
    
    echo '</select></td></tr>
            <tr><td>Week Number</td><td>
            <input name="week" type="number" min="1" max="15" value="'.$week.'" placeholder="Enter week number..."required></td></tr>
            <tr><td>Upload File</td><td><input type="file" name="fileUpload" required></td></tr>
            <tr><td>Course Material</td><td id="fileBox">';
            uploadFile();
            echo '</td></tr>
                    <tr><td></td><td><input type="button" id="viewMaterial" value="View Material" onclick="viewMat()"><input type="submit" value="Upload"></td></tr>
        </form></table>
    
    ';
}

function uploadFile() {
    if(isset($_FILES["fileUpload"])) {
        $file = $_FILES["fileUpload"];
        $fileName = $file["name"];
        $week = $_POST["week"];
        $courseID = $_POST["course"];
        $folderPath = 'uploads/' . $_POST["course"] . "/week" . $_POST["week"];

        consoleLog($folderPath);
        mkdir(dirname(__DIR__,1) ."/". $folderPath, 0755, true);
        
        $savePath = $folderPath . "/" . $fileName;
        consoleLog($savePath);
        if ($file["size"] <= 100000000) {
            if (move_uploaded_file($file["tmp_name"], $savePath)) {
                echo "$fileName uploaded successfully!<script>setTimeout(viewMat(),2000);</script>";
            }
            else {
                echo "File upload failed.";
            }
        }
        else {
            echo "File too large - must be under 100Mb";
        }
    }
}

function showStudentTimetable($conn,$username){
    $sql = "SELECT courseID FROM studentCourses WHERE username = '$username';";
    $result = mysqli_query($conn, $sql); 

    while($row = mysqli_fetch_array($result)) {
        $courseRow[] = $row["courseID"];
    }
    try {
        $sql ="SELECT courseID, time, monday, tuesday, wednesday, thursday, friday FROM timetable WHERE courseID IN(" . implode(',', $courseRow) . ")";
    }
    catch (TypeError $e){
        consoleLog($e);
    }
    
    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);

    if ($numrows >= 1) {
        echo "<tr><th>Time</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th></tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<td>".$row["time"]."</td><td>".$row["monday"]."</td><td>".$row["tuesday"]
            ."</td><td>".$row["wednesday"]."</td><td>".$row["thursday"]."</td><td>".$row["friday"]."</td></tr>";

        }
        echo "</table>";
    }
    else{
        echo "0 result";
    }
}

function showTutorTimetable1($conn){
    $sql ="SELECT courseID, time, monday, tuesday, wednesday, thursday, friday FROM timetable WHERE courseID='1'";

    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);

    if ($numrows >= 1) {
        echo "<tr><th>Time</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th></tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<td>".$row["time"]."</td><td>".$row["monday"]."</td><td>".$row["tuesday"]
            ."</td><td>".$row["wednesday"]."</td><td>".$row["thursday"]."</td><td>".$row["friday"]."</td></tr>";

        }
        echo "</table>";
    }
}
function showTutorTimetable2($conn){
    $sql ="SELECT courseID, time, monday, tuesday, wednesday, thursday, friday FROM timetable WHERE courseID='2'";

    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);

    if ($numrows >= 1) {
        echo "<tr><th>Time</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th></tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<td>".$row["time"]."</td><td>".$row["monday"]."</td><td>".$row["tuesday"]
            ."</td><td>".$row["wednesday"]."</td><td>".$row["thursday"]."</td><td>".$row["friday"]."</td></tr>";

        }
        echo "</table>";
    }
}
function showTutorTimetable3($conn){
    $sql ="SELECT courseID, time, monday, tuesday, wednesday, thursday, friday FROM timetable WHERE courseID='3'";

    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);

    if ($numrows >= 1) {
        echo "<tr><th>Time</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th></tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<td>".$row["time"]."</td><td>".$row["monday"]."</td><td>".$row["tuesday"]
            ."</td><td>".$row["wednesday"]."</td><td>".$row["thursday"]."</td><td>".$row["friday"]."</td></tr>";

        }
        echo "</table>";
    }
}
function showTutorTimetable4($conn){
    $sql ="SELECT courseID, time, monday, tuesday, wednesday, thursday, friday FROM timetable WHERE courseID='4'";

    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);

    if ($numrows >= 1) {
        echo "<tr><th>Time</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th></tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<td>".$row["time"]."</td><td>".$row["monday"]."</td><td>".$row["tuesday"]
            ."</td><td>".$row["wednesday"]."</td><td>".$row["thursday"]."</td><td>".$row["friday"]."</td></tr>";

        }
        echo "</table>";
    }
}
function showTutorTimetable5($conn){
    $sql ="SELECT courseID, time, monday, tuesday, wednesday, thursday, friday FROM timetable WHERE courseID='5'";

    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);

    if ($numrows >= 1) {
        echo "<tr><th>Time</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th></tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<td>".$row["time"]."</td><td>".$row["monday"]."</td><td>".$row["tuesday"]
            ."</td><td>".$row["wednesday"]."</td><td>".$row["thursday"]."</td><td>".$row["friday"]."</td></tr>";

        }
        echo "</table>";
    }
}
function showTutorTimetable6($conn){
    $sql ="SELECT courseID, time, monday, tuesday, wednesday, thursday, friday FROM timetable WHERE courseID='6'";

    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);

    if ($numrows >= 1) {
        echo "<tr><th>Time</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th></tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<td>".$row["time"]."</td><td>".$row["monday"]."</td><td>".$row["tuesday"]
            ."</td><td>".$row["wednesday"]."</td><td>".$row["thursday"]."</td><td>".$row["friday"]."</td></tr>";

        }
        echo "</table>";
    }
}

function consoleLog($message) {
    echo '<script>console.log("' . $message . '");</script>';
}

?>
