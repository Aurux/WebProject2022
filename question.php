<?php 
    $title = "Bowling Moodle";
    include("includes/header.php");
    include("includes/nav.php"); 
?>
<?php

$query ="SELECT * FROM questions";
$results = $conn->query($query) or die($conn->error.__LINE__);

$number = (int) $_GET['n'];
$query = "SELECT * FROM `questions` WHERE question_number = $number";
$result = $conn->query($query) or die($conn->error.__LINE__);
$question = $result->fetch_assoc();


$number = (int) $_GET['n'];
$query = "SELECT * FROM `choices` WHERE question_number = $number";
$choices = $conn->query($query) or die($conn->error.__LINE__);

if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "student");
    else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";?>

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
