<?php 
    $title = "Bowling Moodle";
    include("includes/header.php");
    include("includes/nav.php");
 ?>

<main>
    <div class="container">
        <div class="final">
            <h2>You're done!</h2>
            <p>Congrats</p>
            <P>Final score: <?php echo $_SESSION['score']; ?>/15</P>
            <div class = "restart">
                <a href="question.php?n=1" class="reset" value ="<?php unset($_SESSION['score']); ?>">Take again</a>
            </div>
        </div>
    </div>
</main>