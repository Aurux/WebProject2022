<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    function viewStudents(courseID) {
        
        console.log(courseID);
        

        $.ajax({
            method: 'POST',
            data: {courseID: id},
            url:'viewStudents.php',
            success: function(id) {
                $.ajax({
                    url:"viewStudents.php",
                    method: "GET",
                    dataType: 'text',
                    success: function(response) {
                        console.log(response);
                        $('#courseTable').html(response); // Update HTML course table.
                        
                    }
                 });
            }
        });
        
    }




</script>