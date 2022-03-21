<?php 
    $title = "Bowling Moodle";
    include("includes/header.php");
    include("includes/nav.php");
    include 'database.php'; 
?>
<?php session_start(); ?>

<main>
    <div class="container">
        <div class="current">Question <?php echo $question['question_number']; ?> of 15</div><br>
        <p class="question">
            <?php echo $question['question_text']; ?>
        </p><br>
        <form method="post" action="process.php">
            <ul class="choices">
                <?php while($row = $choices->fetch_assoc()): ?>
                    <li><input name="choice" type="radio" value="<?php echo $row['id']; ?>" /><?php echo $row['choices_text']; ?></li><br>
                <?php endwhile; ?>
            </ul>

            <div class = "button">
                <input type="submit" value="Submit"/>
                <input type="hidden" name="number" value="<?php echo $number; ?>" />
            </div>
        </form>
        </div>
    </div>
</main>

<?php

?>