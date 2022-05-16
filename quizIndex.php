
<?php
    $title = "Moodle Quiz";
    include("includes/header.php");
    include("includes/nav.php");  
    $sql = "SELECT * FROM questions";
    $questions =  $conn->query($sql) or die($conn->error.__LINE__);
    $total = $questions->num_rows;
    $next = $total;
?>

<body>
    <div class ="container">
      <h1 id ="h1">
         Bowling quiz</h1>
      <br>
      <p id ="quizP1">
        In this quiz you will be assessed on your knowledge about bowling. This quiz will consist
        of a series of multiple choice questions. You will have one attempt to complete this quiz. <br><br> Results will be recorded and displayed at the end of the quiz.
        The quiz will consist of <?php echo $next?> questions are on the general subject of bowling. Questions have been set by tutors. This is a fun, simple quiz that can be accessed by all students.<br><br> Results will not count towards your grade.<br><br></p>      
        <div class="center">
          <a href="question.php?n=1" class="start">Start Quiz</a>
        </div>
    </div>
</body>

<?php include("includes/footer.php");