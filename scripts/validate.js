fullPass = false;
            
function validate()
{   
    let currentDate = new Date();
    // Regex 
    var nameRe = /^[a-zA-Z]{2,64}$/;
    var ageRe = /^[0-9]{1,3}$/;

    var passRe = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/gm

    // RFC5322 compliant email regex sourced from https://emailregex.com/
    var emailRe = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/

    // Forename Check
    var fnamePass = nameRe.test(document.forms["frmRegister"]["frmForename"].value);
    // Surname Check
    var snamePass = nameRe.test(document.forms["frmRegister"]["frmSurname"].value);
    // Date of birth check
    var dobPass = false;
    var dob = document.forms["frmRegister"]["frmDateOfBirth"].value;
    var dobSplit = dob.split("-");
    var dobStart = new Date(1900, 0, 1, 0, 0, 0, 0);
    var dobDate = new Date(parseInt(dobSplit[0]), parseInt(dobSplit[1]) - 1, parseInt(dobSplit[2]), 0, 0, 0, 0);
    
    
    
    if (dobDate >= dobStart & dobDate < currentDate)
    {
        var dobPass = true;
    }
    // Email Check
    var emailPass = emailRe.test(document.forms["frmRegister"]["frmEmail"].value);
    if (document.forms["frmRegister"]["frmEmail"].value == document.forms["frmRegister"]["frmEmailConf"].value) {
        var emailMatch = true;
    }
    else {
        var emailMatch = false;
    }

    // Password Check

    var pwdPass = passRe.test(document.forms["frmRegister"]["frmPassword"].value);
    if (document.forms["frmRegister"]["frmPassword"].value == document.forms["frmRegister"]["frmPasswordConf"].value) {
        var pwdMatch = true;
    }
    else {
        var pwdMatch = false;
    }

    // Checking all pass flags, if some info is found to be incorrect then hidden text will appear below the incorrect input. It is removed once the input is corrected.
    

    if (fnamePass == true)
    {
        document.getElementById("fname").style.display = "none";                        
        if (snamePass == true)
        {    
            document.getElementById("sname").style.display = "none";                          
            if (dobPass == true)
            {                     
                document.getElementById("dob").style.display = "none";           
                if (emailMatch == true)
                {
                    document.getElementById("email2").style.display = "none";
                    if (emailPass == true)
                    {    
                        document.getElementById("email").style.display = "none";                                                                    
                        if (pwdMatch == true)
                        {
                            document.getElementById("pword2").style.display = "none";
                            if (pwdPass == true)
                            {
                                document.getElementById("pword").style.display = "none";
                                fullPass = true;
                                alert("Successfully registered!")
                                window.onbeforeunload = null;
                                return true;
                            }
                            else
                            {
                                document.getElementById("pword").style.display = "block";
                                return false;
                            }
                        }
                        else
                        {
                            document.getElementById("pword2").style.display = "block";
                            return false;
                        }
                    }
                    else
                    {
                        document.getElementById("email").style.display = "block";
                        return false;
                    }
                    
                }
                else
                {
                    document.getElementById("email2").style.display = "block";
                    return false;
                }
            }
            else
            {
                document.getElementById("dob").style.display = "block";
                return false;
            }
        }
        else
        {
            document.getElementById("sname").style.display = "block";
            return false;
        }
        
    }
    else {
        document.getElementById("fname").style.display = "block";
        return false;
    }
        
        


        
}

    
    


    


// Confirm clearing the form
function clearAll()
{
    
    var confirmClear = window.confirm("Are you sure you want to clear all fields?");

    if (confirmClear)
    {
        document.getElementById("frmRegister").reset();
    }
    
    
}

// Confirm if they want to leave the page. Only runs if a change has been made to the form.
function confirmBack()
        {
            if (fullPass != true)
            {
                window.addEventListener("beforeunload", function (event)
                {
                    var message = "You have entered information into the form, are you sure you want to leave?";

                    (event || window.event).returnValue = message;
                    return message
                }
                );
            }
            
        }

// Handle user trying to leave the page.
window.onbeforeunload = function() {
    
    
    
    return 'You have entered information, are you sure you want to leave?';
    
    
}