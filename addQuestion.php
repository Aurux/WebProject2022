<?php
    $title = "Moodle Quiz";
    include("includes/header.php");
    include("includes/nav.php"); 
?>

<main>
    <div id="questionContent">
    <h1>Add a question</h1>
    <br>
    <?php
    echo addQuestion($conn);
    ?>
    </div>
</main>