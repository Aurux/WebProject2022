<div id="enroll">
    <form name="frmRegister" id="frmRegister" method="post" action="doEnroll.php" onsubmit="return validate()"  >

        <table>
            <tr><td>Forename<br><input name="frmForename" type="textbox" placeholder="Your first name..." required/><br><p1 id="fname" style="display:none">Must be 2-64 characters long<br>using only upper and lowercase letters.</p1></td>
            <td>Surname<br><input name="frmSurname"  type="textbox" placeholder="Your last name..." required/><br><p1 id="sname" style="display:none">Must be 2-64 characters long<br>using only upper and lowercase letters.</p1></td></tr>
            
            <tr><td>Email<br><input name="frmEmail"  type="textbox" placeholder="Your email..." required/><br><p1 id="email" style="display:none">Please enter a valid email address.</p1></td>
            <td>Confirm Email<br><input name="frmEmailConf"  type="textbox" placeholder="Confirm Email..." required/><br><p1 id="email2" style="display:none">Email must match.</p1></td></tr>

            <tr><td>Password<br><input name="frmPassword"  type="password" placeholder="Enter password" required/><br><p1 id="pword" style="display:none">Must be 8-32 characters long using upper and lower case<br>and contain at least one number.</p1></td>
            <td>Confirm Password<br><input name="frmPasswordConf"  type="password" placeholder="Confirm password" required/><br><p1 id="pword2" style="display:none">Passwords must match.</p1></td></tr>


            <tr><td>Gender<br>
                <label><input name="frmGender" value="male" type="radio" required>Male</label><br>
                <label><input name="frmGender" value="female" type="radio">Female</label><br>
                <label><input name="frmGender" value="other" type="radio">Other</label></td>

            <td>Date of birth<br><input name="frmDateOfBirth" type="date"><br><p1 id="dob" style="display:none">Please enter a valid date of birth.</p1></td></tr>
            
            <tr><td>Course<br><select name="frmCourse" required><option value="">Please select...</option><option value="Bowling Form 101">Bowling Form 101</option><option value="Lane Analysis">Lane Analysis</option><option value="Team Management">Team Management</option></select></td>
            <td style="text-align: center;"><input type="button" value="Clear All" onclick="clearAll()">&nbsp;&nbsp;&nbsp;<input type="submit" onclick="submitted = true;" value="Submit"/></td></tr>
        <!--
            Need to add password hashing on client
        -->
        </table>
        
            

    </form>
</div>