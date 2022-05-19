<?php
    // Get question data for tutor quiz editor
    session_start();
    require("scripts/functions.php");
    $conn = connectDatabase(true);

    extract($_POST);

   $questionData = array("question_text"=>"","choice1"=>"","choice2"=>"","choice3"=>"","choice4"=>"","correctChoice"=>"");

   $sql = "SELECT question_text FROM questions WHERE question_number = '$questionNum'";
   $result = mysqli_query($conn, $sql);
   while ($row = mysqli_fetch_array($result)){
       $questionData["question_text"] = $row['question_text'];
   }

   $sql = "SELECT * FROM choices WHERE question_number = '$questionNum'";
   $result = mysqli_query($conn, $sql);
   $i = 1;
   while ($row = mysqli_fetch_array($result)){
       $questionData["choice$i"] = $row["choices_text"];
           

           
       
       if ($row["is_correct"] == 1){
           $questionData["correctChoice"] = $i;
       }
       $i++;
   }

   echo json_encode($questionData);


?> 
