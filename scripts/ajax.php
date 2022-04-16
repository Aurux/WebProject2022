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





</script>