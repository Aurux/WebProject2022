<?php
    $title = "Moodle Quiz";
    include("includes/header.php");
    include("includes/nav.php"); 
    
    $sql = "SELECT * FROM questions";
    $questions =  $conn->query($sql) or die($conn->error.__LINE__);
    $total = $questions->num_rows;
    $next = $total+1;
?>

<main>
    <div id="questionContent">
    <h1>Add a question</h1>
    <br>
    <?php
    echo addQuestion($conn);
    ?>
    <form method="POST">
        <label>Question number: </label>
        <input value ="<?php echo $next; ?>"name="question_number"/><br><br>
        <label>Question text: </label>
        <input type="text" name="question_text"/><br><br>
        <label>Add choice 1:  </label>
        <input type="text" name="choice1"/><br><br>
        <label>Add choice 2:  </label>
        <input type="text" name="choice2"/><br><br>
        <label>Add choice 3:  </label>
        <input type="text" name="choice3"/><br><br>
        <label>Add choice 4:  </label>
        <input type="text" name="choice4"/><br><br>
        <label>Correct choice: </label>
        <input type="number" name="correct_choice"/><br><br>
        <input type="submit" name="submit" value="submit"/>
    </form>
    </div>
</main>