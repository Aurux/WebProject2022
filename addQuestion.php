<?php
    $title = "Moodle Quiz";
    include("includes/header.php");
    include("includes/nav.php"); 
?>
<main>
    <div id="questionContent">
    <h1>Add/delete questions for the student quiz</h1><br><br>
    <?php
    echo addQuestion($conn);
    echo deleteQuestion($conn,$delete_question_number);
    ?>
    </div>
</main>