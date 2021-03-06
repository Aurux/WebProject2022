<!--This will be displayed on 'quiz content' page -->

<?php
    $title = "Moodle Quiz";
    include("includes/header.php");
    include("includes/nav.php"); 
    include("includes/footer.php");
    require("scripts/ajax.php");
?>
<main>
    <div id="questionContent">
    <h1>Add/delete questions for the student quiz</h1><br>
    <?php
    // execute functions
    echo addQuestion($conn);
    echo deleteQuestion($conn,$delete_question_number);
    echo resetQuizScores($conn);
    ?>
    </div>
</main>
<?php include("includes/footer.php")?>