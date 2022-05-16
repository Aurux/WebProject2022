<?php
    $title = "Moodle Quiz";
    include("includes/header.php");
    include("includes/nav.php"); 
    include("includes/footer.php")  
?>
<main>
    <div id="questionContent">
    <h1>Add/delete questions for the student quiz</h1><br>
    <?php
    echo seeQuestion($conn);
    echo addQuestion($conn);
    echo deleteQuestion($conn,$delete_question_number);

    $score = $_SESSION['score'];

    if (isset($_POST['reset'])){
        $score = 0;
        echo '<p1>Scores have been reset</p1>';
    }
    echo'<form method="POST">
    <br><label>Reset quiz score for students: </label>
    <input type="submit" name="reset" value="Reset"/>
    </form>';
    ?>
    </div>
</main>