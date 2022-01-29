fullPass = false;
            
function validate()
{   
    let currentDate = new Date();
    // Regex 
    var nameRe = /^[a-zA-Z]{2,64}$/;
    var ageRe = /^[0-9]{1,3}$/;

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
    
    /* Original code for DOB verification before I realised that I could just do it using Date objects.
    if (parseInt(dobSplit[0]) > 1900 & parseInt(dobSplit[0]) <= currentDate.getFullYear())
    {
        if (parseInt(dobSplit[0]) == currentDate.getFullYear() & parseInt(dobSplit[1]) <= (currentDate.getMonth() + 1) & parseInt(dobSplit[2]) <= currentDate.getUTCDate())
        {
            var dobPass = true;
        }
        if (parseInt(dobSplit[0]) != currentDate.getFullYear())
        {
            var dobPass = true;
        }
    }
    */
    
    if (dobDate >= dobStart & dobDate < currentDate)
    {
        var dobPass = true;
    }
    // Age check
    var ageCorrect = false;
    var ageAllowed = false;
    var age = document.forms["frmRegister"]["frmAge"].value;
    // 12 years and 150 years in ms, roughly accounting for leap years.
    var minAge = 1000 * 60 * 60 * 24 * 365.25 * 12
    var maxAge = 1000 * 60 * 60 * 24 * 365.25 * 150

    var ageDist = currentDate - dobDate;
    var ageDistYears = Math.floor(ageDist / 1000 / 60 / 60 / 24 / 365.25);
    
    if (ageDistYears == age & ageRe.test(age) == true)
    {
        var ageCorrect = true;
    }
    if (ageDist > minAge & ageDist < maxAge)
    {
        var ageAllowed = true;
    }
    

    // Checking todays date.
    var datePass = false;
    var todayDate = document.forms["frmRegister"]["frmDateReg"].value;
    var dateSplit = todayDate.split("-");
    
    if (parseInt(dateSplit[0]) == currentDate.getFullYear() & parseInt(dateSplit[1]) == (currentDate.getMonth() + 1) & parseInt(dateSplit[2]) == currentDate.getUTCDate())
    {
        var datePass = true;
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
                if (ageCorrect == true)
                {
                    document.getElementById("ageCorrect").style.display = "none";
                    if (ageAllowed == true)
                    {    
                        document.getElementById("ageAllow").style.display = "none";                                                                    
                        if (datePass == true)
                        {
                            document.getElementById("date").style.display = "none";
                            fullPass = true;
                            alert("Successfully registered!")
                            window.onbeforeunload = null;
                            return true;
                            
                        }
                        else
                        {
                            document.getElementById("date").style.display = "block";
                            return false;
                        }
                    }
                    else
                    {
                        document.getElementById("ageAllow").style.display = "block";
                        return false;
                    }
                    
                }
                else
                {
                    document.getElementById("ageCorrect").style.display = "block";
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
    
    
};