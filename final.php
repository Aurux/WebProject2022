<!-- FINAL QUIZ PAGE -->
<?php 
    $title = "Bowling Moodle";
    include("includes/header.php");
    include("includes/nav.php");
 ?>

<main>
    <div id="finalContent">
        <h2>You're done!</h2><br>
        <p>Congratulations on completing the quiz!</p><br>
        <?php
        //DISPLAY QUIZ SCORE DEPENDING ON USERNAME    
        $username = $_SESSION["username"];
        $sql = "SELECT username FROM users WHERE username = $username";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
            showQuizScore($conn, $row["username"]);
        }
        //UPLOAD QUIZ SCORE TO DATABASE
        echo uploadScore($conn);?>
    </div>
</main>
<?php include("includes/footer.php")?>