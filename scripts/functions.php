<?php
error_reporting(E_ALL ^ E_WARNING); 
function connectDatabase($dbExists) {
    //create connnection credentials
    $db_host = 'localhost:';
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
        
        
        
        <td style="text-align: center;"><input type="button" value="Clear All" onclick="clearAll()">&nbsp;&nbsp;<input type="submit" onclick="submitted = true;" value="Submit"/></td></tr>
  
    </table>
    
     
    </form>';
}

function processEnroll($conn) {
    extract($_POST);
    $password = password_hash($frmPassword, PASSWORD_DEFAULT);

    if ($frmType == "tutor"){
        $sql = "INSERT INTO users (forename, surname, uType, email, pass, authorised) VALUES('$frmForename', '$frmSurname', '$frmType', '$frmEmail', '$password', 0)";
    }
    else $sql = "INSERT INTO users (forename, surname, uType, email, pass) VALUES('$frmForename', '$frmSurname', '$frmType', '$frmEmail', '$password')";
    
    

    if (mysqli_query($conn, $sql)) $result = True;
    else $result = False;

    $sql = "SELECT username FROM users WHERE email = '$frmEmail'";
    $sql_result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($sql_result)) {
        $show_result = $row["username"];
    }
    
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

            if ($uType == "student"){
                $_SESSION["loggedIn"] = true;
                $_SESSION["username"] = $username;
                $_SESSION["forename"] = $forename;
                $_SESSION["surname"] = $surname;
                $_SESSION["uType"] = $uType;

                $returnVar = "<p>Welcome to the lanes, $forename! <br> You will be automatically redirected to the $uType home. If this doesn't work, please click <a href='{$uType}_home.php'>here.</a></p>";
                header("refresh:2; url={$uType}_home.php");
            }
            
            if ($uType == "tutor" && $authorised == 1){
                $_SESSION["loggedIn"] = true;
                $_SESSION["username"] = $username;
                $_SESSION["forename"] = $forename;
                $_SESSION["surname"] = $surname;
                $_SESSION["uType"] = $uType;

                $returnVar = "<p>Welcome to the lanes, $forename! <br> You will be automatically redirected to the $uType home. If this doesn't work, please click <a href='{$uType}_home.php'>here.</a></p>";
                header("refresh:2; url={$uType}_home.php");
            }
            if ($uType == "tutor" && $authorised == 0) $returnVar = "<p>Your tutor account has not yet been approved by an admin!</p>";
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

    echo "<table><caption>Your Courses</caption>";

    if ($numrows >= 1){
        echo "<th>Course</th><th>Credits</th><th>Completion</th>";
        while($row = mysqli_fetch_array($result)){
            echo '<tr><td>'. htmlspecialchars($row['courseName']) .'</td>
            <td>'. htmlspecialchars($row['courseCredits']) . '</td>';
            $id = $row['courseID'];
            $compsql = "SELECT completion FROM studentCourses WHERE username = '$username' AND courseID = '$id'";
            $compresult = mysqli_query($conn, $compsql); 

            while($row = mysqli_fetch_array($compresult)) {
                $courseRow = $row["completion"];
            }
    
            $fullCircleCount = round($courseRow * 10);
            $emptyCircleCount = 10 - $fullCircleCount;
            $fullCircle = str_repeat('🟩', $fullCircleCount);
            $emptyCircle =  str_repeat('⬜', $emptyCircleCount);
            $courseRow = 100 * $courseRow;

            echo "<td>$fullCircle$emptyCircle $courseRow%</td></tr>";
           
        }
    }
    else {
        echo "<tr><td>You have not been assigned to any courses.</td></tr>";
    }
    echo "</table>";

    $username = $_SESSION["username"];
    $sql = "SELECT courseID FROM studentCourses WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($result)) {
        consoleLog($row["courseID"]);
        $courseRow = $row["courseID"];
    }

    
    try {
        $sql = "SELECT * from courses WHERE courseID IN(" . implode(',', $courseRow) . ")";
    }
    catch (TypeError $e){
        consoleLog($e);
    }
    
    
    $courseResult = mysqli_query($conn, $sql);

    if (isset($_POST["week"])) {
        $week = $_POST["week"];
    }
    else $week = 1;

    echo '
        <table><caption>View Course Material</caption>
        <form>
            <tr><td>Course</td><td>
            <select name="course">';
            if (mysqli_num_rows($courseResult) > 0){
                while($row = mysqli_fetch_array($courseResult)){
                    $id = $row["courseID"];
                    $sql = "SELECT courseName FROM courses WHERE courseID = '$id'";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($result)) {
                        consoleLog($row["courseName"]);
                        $nameRow = $row["courseName"];
                    }

                    if (isset($_POST["course"]) && $row["courseID"] == $_POST["course"]) {
                        
                        echo '<option selected value="'.$id.'">'.$nameRow.'</option>';
                    }
                    else echo '<option value="'.$id.'">'.$nameRow.'</option>';
                    
                }
            }
            else echo '<option value="No courses">No courses</option>';
    
    echo '</select></td></tr>
            <tr><td>Week Number</td><td>
            <input name="week" type="number" min="1" max="15" value="'.$week.'" placeholder="Enter week number..."required></td></tr>
            
            <tr><td>Course Material</td><td id="fileBox">';
            uploadFile();
            echo '</td></tr>
                    <tr><td></td><td><input type="button" id="viewMaterial" value="View Material" onclick="viewMat()"></td></tr>
        </form></table>
    
    ';
}

function showTutorHome($conn) {

    $sql = "SELECT * FROM courses;";
    $result = mysqli_query($conn, $sql);

    
    echo "<h1>Your Tutor Home Page</h1><br>";

    echo "<table style='width: 50%;' id='courseTable'><caption>Courses</caption><th>Course</th><th>Credits</th>";

    while($row = mysqli_fetch_array($result)){
        echo '<tr><td>'. htmlspecialchars($row['courseName']) .'</td>
        <td>'. htmlspecialchars($row['courseCredits']) . '</td>
        <td><input type="button" class="tutorButtons" value="View Students" name="'.$row["courseID"].'" onclick="viewStudents('.$row["courseID"].')"><input type="button" class="tutorButtons" value="View Assessments" name="'.$row["courseID"].'" onclick="viewAssessments('.$row["courseID"].')"></td>
        </tr>';
    }

    echo "<tr><td><input type='button' value='Create Course' onclick='createCourseForm()'></td></tr></table>";

    $sql = "SELECT * from courses ORDER BY courseName DESC;";
    $courseResult = mysqli_query($conn, $sql);

    if (isset($_POST["week"])) {
        $week = $_POST["week"];
    }
    else $week = 1;

    
    
    echo '
        <table style="width: 30%;"><caption>Manage Course Material</caption>
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


function showTimetable($conn, $courseID){
    $sql ="SELECT courseID, time, monday, tuesday, wednesday, thursday, friday FROM timetable WHERE courseID='$courseID'";

    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);

    $sql = "SELECT courseName FROM courses WHERE courseID = '$courseID'";
    $nameResult = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($nameResult)) {
        $courseName = $row["courseName"];
    }
    consoleLog("Showing timetable: ". $courseID);
    echo "<h1>$courseName - course ID: $courseID</h1><br>";
    echo "<table class='timetable'>";
    if ($numrows >= 1) {
        echo "<tr><th>Time</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th></tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<td>".$row["time"]."</td><td>".$row["monday"]."</td><td>".$row["tuesday"]
            ."</td><td>".$row["wednesday"]."</td><td>".$row["thursday"]."</td><td>".$row["friday"]."</td></tr>";

        }
        echo "</table><br>";
    }
    else echo "<tr><td>You have not been assigned to any courses.</td></tr></table>";
}

function draw_calendar($month,$year){
	$calendar = '<table cellpadding="10" cellspacing="1" class="calendar">';
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$calendar.= '<tr class="calendar-row">';

	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		$days_in_this_week++;
	endfor;

	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
		$calendar.= '<div class="day-number">'.$list_day.'</div>';
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		endfor;
	endif;

	$calendar.= '</tr>';
	$calendar.= '</table>';
	return $calendar;
}

function showAssessments($conn, $username){
    $sql = "SELECT id FROM studentAssessments WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);


    echo "<br><table id='assessmentTable' style='width: 90%; margin-left: auto; margin-right: auto; float:none;'><caption>Assessments</caption>";
    if ($numrows >= 1){
        
        echo "<th>Course</th><th>Assessment</th><th>Info</th><th>Value</th><th>Deadline</th><th>Your Submission</th>";
        while ($row = mysqli_fetch_array($result)){
            $id = $row["id"];
            $sql = "SELECT * FROM assessments WHERE id = '$id'";
            $assResult = mysqli_query($conn, $sql);
            while($singleRow = mysqli_fetch_array($assResult)) {
                $courseID = $singleRow["courseID"];
                $title = $singleRow["title"];
                $info = $singleRow["info"];
                $value = $singleRow["creditWeight"] * 100;
                $deadline = $singleRow["deadline"];
            }
            $sql = "SELECT courseName FROM courses WHERE courseID = '$courseID'";
            $nameResult = mysqli_query($conn, $sql);
            while($singleRow = mysqli_fetch_array($nameResult)) {
                $courseName = $singleRow["courseName"];
            }
            
            echo "<tr><td>$courseName</td><td>$title</td><td>$info</td><td>$value%</td><td>$deadline</td><td>";
            
            $dirPath = "uploads/assessments/" . $id . "/" . $username . "/";

            $contents = scandir($dirPath);
            
            if ($contents == "") {
                echo "No files.";
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
            echo "</td>";
            uploadSubmission($id, $username);
            echo "<td><form method='POST' action='' id='uploadForm$id' enctype='multipart/form-data'><input name='fileUpload$id' type='file'><input type='submit' value='Add Submission'></form></td></tr>";

        }
    }
    else echo "<tr><td>You have no assessments currently.</td></tr>";

    echo "</table>";
    
}

function uploadSubmission($id,$username) {
    if(isset($_FILES["fileUpload$id"])) {
        $file = $_FILES["fileUpload$id"];
        $fileName = $file["name"];
        $folderPath = 'uploads/assessments/' . $id . "/" . $username;

        consoleLog($folderPath);
        mkdir(dirname(__DIR__,1) ."/". $folderPath, 0755, true);
        
        $savePath = $folderPath . "/" . $fileName;
        consoleLog($savePath);
        if ($file["size"] <= 100000000) {
            consoleLog($savePath);
            consoleLog($file["tmp_name"]);
            if (move_uploaded_file($file["tmp_name"], $savePath)) {
                consoleLog("$fileName uploaded successfully!");
            }
            else {
                consoleLog("File upload failed.");
            }
        }
        else {
            echo '<script>alert("File too large - must be under 100Mb");</script>';
        }
    }
}

function addQuestion($conn){
    if (isset($_POST['submit'])){
        $question_number = $_POST['question_number'];
        $question_text = $_POST['question_text'];
        $correct_choice = $_POST['correct_choice'];

        $choices = array();
        $choices[1] = $_POST['choice1'];
        $choices[2] = $_POST['choice2'];
        $choices[3] = $_POST['choice3'];
        $choices[4] = $_POST['choice4'];

        $sql = "INSERT INTO questions(question_number, question_text)
                VALUES('$question_number','$question_text')";

        $insert_row = $conn->query($sql) or die($conn->error.__LINE__);

        if($insert_row){
            foreach($choices as $choice => $value){
                if($value != ''){
                    if($correct_choice == $choice){
                        $is_correct = 1;
                    }else{
                        $is_correct = 0;
                    }
                    $sql = "INSERT INTO choices(question_number, is_correct, choices_text)
                            VALUES('$question_number','$is_correct','$value')";

                    $insert_row = $conn->query($sql) or die($conn->error.__LINE__);

                    if($insert_row){
                        continue;
                    }else{
                        die;
                    }  
                }
            }
            echo 'Question has been added';
        }
    }
}

function consoleLog($message) {
    echo '<script>console.log("' . $message . '");</script>';
}

?>