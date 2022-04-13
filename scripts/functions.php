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
    
    if ($result == True) $result = "<br><br><br><br><p>You have enrolled succesfully! Your login ID is: " . $show_result . "</p>";

    else $result = "<p>Enrollment failed, please try again in a little while.</p>";

    return $result;
}


?>