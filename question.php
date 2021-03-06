<?php 
    $title = "Bowling Moodle";
    include("includes/header.php");
    include("includes/nav.php"); 
?>
<?php

$sql ="SELECT * FROM questions";
$results = $conn->query($sql) or die($conn->error.__LINE__);

//GET QUESTION NUMBER AS 'n'
$number = (int) $_GET['n'];
$sql = "SELECT * FROM `questions` WHERE question_number = $number";
$result = $conn->query($sql) or die($conn->error.__LINE__);
$question = $result->fetch_assoc();

$sql = "SELECT * FROM `choices` WHERE question_number = $number";
$choices = $conn->query($sql) or die($conn->error.__LINE__);

$sql = "SELECT * FROM questions";
$questions =  $conn->query($sql) or die($conn->error.__LINE__);
$total = $questions->num_rows;
//GET TOTAL
$next = $total;

if ($_SESSION["loggedIn"] && $_SESSION["uType"] == "student");
    else echo "<h1>403 Forbidden - You don't have permission to access this.</h1>";?>

<main>  <!-- SHOW QUESTION NUMBER -->
        <div class="current">Question <?php echo $question['question_number']; ?> of <?php echo $next?></div><br>
        <br>
        <form method="post" action="process.php">
            <!-- DISPLAY CHOICES -->
            <table id="choicesTable">
                <caption><?php echo $question['question_text']; ?></caption>
                <?php while($row = $choices->fetch_assoc()): ?>
                    <tr><td><input name="choice" class="choices" type="radio" required value="<?php echo $row['id']; ?>" /></td><td><?php echo $row['choices_text']; ?></td></tr>
                <?php endwhile;?>
                </table>
                <!-- CREATE BUTTON TO SUBMIT -->
                <input type="submit" id="submitChoice" value="Submit"/>
                <input type="hidden" name="number" value="<?php echo $number; ?>" />    
            
        </form>
        
</main>
<?php include("includes/footer.php")?>