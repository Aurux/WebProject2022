<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    function viewStudents(courseID) {
        console.log(courseID);
        $.ajax({
            method: 'POST',
            data: {courseID: courseID},
            url:'viewStudents.php',
            dataType: 'html',
            success: function(response) {
                $('#courseTable').replaceWith(response); // Update HTML course table. 
            }
        });   
    }

    function viewSubmissions(username) {
        console.log(courseID);
        $.ajax({
            method: 'POST',
            data: {username: username},
            url:'viewSubmissions.php',
            dataType: 'html',
            success: function(response) {
                $('#courseTable').replaceWith(response); // Update HTML course table. 
            }
        });   
    }

    function passStudent(id, username, courseID) {
       
        $.ajax({
            method: 'POST',
            data: {id: id, username: username, courseID: courseID},
            url:'passStudent.php',
            dataType: 'html',
            success: function(response) {
                window.location.reload();
            }
        });   
    }

    function failStudent(id, username, courseID) {
       
        $.ajax({
            method: 'POST',
            data: {id: id, username: username, courseID: courseID},
            url:'failStudent.php',
            dataType: 'html',
            success: function(response) {
                window.location.reload(); // Update HTML course table. 
            }
        });   
    }

    function viewAssessments(courseID) {
        console.log(courseID);
        $.ajax({
            method: 'POST',
            data: {courseID: courseID},
            url:'viewAssessments.php',
            dataType: 'html',
            success: function(response) {
                $('#courseTable').replaceWith(response); // Update HTML course table. 
            }
        });   
    }

    function viewAddAssessment(courseID) {
        console.log(courseID);
        $.ajax({
            method: 'POST',
            data: {courseID: courseID},
            url:'viewAddAssessments.php',
            dataType: 'html',
            success: function(response) {
                $('#courseTable').replaceWith(response); // Update HTML course table. 
            }
        });   
    }

    function addAssessment(courseID) {
        var title = document.getElementById("title").value;
        var info = document.getElementById("desc").value;
        var deadline = document.getElementById("deadline").value;
        var weight = document.getElementById("weight").value;
        $.ajax({
            method: 'POST',
            data: {courseID: courseID, title: title, info: info, deadline: deadline, weight: weight},
            url:'addAssessment.php',
            dataType: 'html',
            success: function() {
                viewAssessments(courseID);
            }
        });   
    }

    function createCourseForm() {
        $.ajax({
            method: 'GET',
            url:'createCourseForm.php',
            dataType: 'html',
            success: function(response) {
                $('#courseTable').replaceWith(response); // Update HTML course table. 
            }
        });
    }

    function addCourse() {
        var name = document.getElementById("name").value;
        var credits = document.getElementById("credits").value;
        $.ajax({
            method: 'POST',
            data: {name: name, credits: credits},
            url:'createCourse.php',
            dataType: 'html',
            success: function() {
                
            }
        });
    }

    function deleteAssessment(id, courseID) {
        console.log(courseID);
        $.ajax({
            method: 'POST',
            data: {id: id, courseID: courseID},
            url:'deleteAssessment.php',
            dataType: 'html',
            success: function() {
                viewAssessments(courseID);
            }
        });   
    }

    function addStudent(courseID) {
        var studentID = document.getElementById("studentID").value;
        var courseID = courseID;
        $.ajax({
            method: 'POST',
            data: {courseID: courseID, studentID: studentID},
            url:'addStudent.php',
            dataType: 'html',
            success: function() {
                viewStudents(courseID);
            }
        });
    }

    function removeStudent(username, courseID){
        $.ajax({
            method: 'POST',
            data: {studentID: username, courseID: courseID},
            url:'removeStudent.php',
            dataType: 'html',
            success: function() {
                viewStudents(courseID);
            }
        });

    }

    function viewMat() {
        var course = document.getElementsByName("course")[0].value;
        var week = document.getElementsByName("week")[0].value;
        $.ajax({
            method: 'POST',
            data: {courseID: course, week: week},
            url:'getMaterial.php',
            dataType: 'html',
            success: function(response) {
                $('#fileBox').replaceWith(response);
            }
        });
    }

    function addquizScore() {
        var studentID = document.getElementById("studentID").value;
        var courseID = courseID;
        $.ajax({
            method: 'POST',
            data: {courseID: courseID, studentID: studentID},
            url:'addStudent.php',
            dataType: 'html',
            success: function() {
                viewStudents(courseID);
            }
        });
    }

    function getQuestion(){
        var questionNum = document.getElementById("qNumField").value;
        console.log(questionNum);
        $.ajax({
            method: 'POST',
            data: {questionNum: questionNum},
            url:'getQuestion.php',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                document.getElementById("question_text").value = response.question_text;
                document.getElementById("choice1").value = response.choice1;
                document.getElementById("choice2").value = response.choice2;
                document.getElementById("choice3").value = response.choice3;
                document.getElementById("choice4").value = response.choice4;
                document.getElementById("correct_choice").value = response.correctChoice;
            }
        });
    }

    






</script>