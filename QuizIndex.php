
<?php
    $title = "Moodle Quiz";
    include("includes/header.php");
    include("includes/nav.php");
?>

<body>
    <div class ="container">
      <h1 id ="h1">
         Bowling quiz</h1>
      <br>
      <p id ="quizP1">
        In this quiz you will be assessed on your knowledge about bowling. This quiz will consist
        of a series of multiple choice questions. You will have one attempt to complete the quiz. <br><br> Results will be recorded.
        The quiz will consist of 10 questions on the subject of bowling, and will take about 5-10 minutes to complete. 
        In order to pass you must score over 40% or over of the total marks.<br><br>The estimated time to complete the quiz will be: 20-30 minutes.</p>      
        <div class="center">
          <a href="question.php?n=1" class="start">Start Quiz</a>
        </div>
    </div>
</body>

<?php include("includes/footer.php");