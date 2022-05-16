<?php 
    $title = "Bowling Moodle";
    include("includes/header.php");
    include("includes/nav.php");

    $sql = "SELECT * FROM questions";
    $questions =  $conn->query($sql) or die($conn->error.__LINE__);
    $total = $questions->num_rows;
    $next = $total;
 ?>

<main>
    <div id="finalContent">
            <h2>You're done!</h2><br>
            <p>Congratulations on completing the quiz!</p><br>
            <P>Final score: <?php echo $_SESSION['score']; ?>/<?php echo $next?></P><br><br>
            <a href="student_home.php" class="reset" value ="<?php ($_SESSION['score']); ?>">Finish attempt</a>

    </div>
</main>