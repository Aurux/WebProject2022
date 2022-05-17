<?php include("includes/header.php");
    //check score
    if(!isset($_SESSION['score'])){
        $_SESSION['score'] = 0;
    }
    if($_POST){
        $number = $_POST['number'];
        $selected_choice = $_POST['choice'];
        $next = $number+1;
        //get total
        $sql = "SELECT * FROM `questions`";
        //results
        $results = $conn->query($sql) or die($conn->error.__LINE__);
        $total = $results->num_rows;
        //get correct choice
        $sql = "SELECT * FROM `choices` WHERE question_number = $number AND is_correct = 1";
        $result = $conn->query($sql) or die($conn->error.__LINE__);
        $row = $result->fetch_assoc();
        $correct_choice = $row['id'];
        if($correct_choice == $selected_choice) {
            $_SESSION['score']++;
        }
        if($number == $total){
            header("Location: final.php");
            exit();
        } else {
            header("Location: question.php?n=".$next);
        }
    }
?> 
