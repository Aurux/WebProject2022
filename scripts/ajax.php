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

    function uploadFile() {
        var formData = new FormData($('#uploadForm'));
    }

    window.onload = viewMat();






</script>