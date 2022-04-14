<?php
    require_once("functions.php");
    $conn = connectDatabase(false);

    $sql = "CREATE DATABASE IF NOT EXISTS bowlingDB";
    if (mysqli_query($conn, $sql)) echo "DB created.";
    else echo "DB failed to be created: " . mysqli_error($conn);

    $sql = "USE bowlingDB";
    mysqli_query($conn, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS users (
                username VARCHAR(20) PRIMARY KEY,
                forename VARCHAR(30) NOT NULL,
                surname VARCHAR(50) NOT NULL,
                type ENUM('student', 'tutor') NOT NULL,
                password VARCHAR(255) NOT NULL,
                authorised TINYINT
            )";


    $sql = "CREATE TABLE `choices` (
      `id` int(11) NOT NULL,
      `question_number` int(11) NOT NULL,
      `is_correct` tinyint(1) NOT NULL DEFAULT 0,
      `choices_text` text NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    

    INSERT INTO `choices` (`id`, `question_number`, `is_correct`, `choices_text`) VALUES
    (1, 1, 0, '8'),
    (2, 1, 1, '10'),
    (3, 1, 0, '9'),
    (4, 1, 0, '11'),
    (5, 2, 0, '4'),
    (6, 2, 1, '3'),
    (7, 2, 0, '5'),
    (8, 2, 0, '2'),
    (9, 3, 1, '300'),
    (10, 3, 0, '500'),
    (11, 3, 0, '400'),
    (12, 3, 0, '350'),
    (13, 4, 0, '301'),
    (14, 4, 0, '298'),
    (15, 4, 0, '300'),
    (16, 4, 1, '299'),
    (17, 5, 0, '800'),
    (18, 5, 1, '900'),
    (19, 5, 0, '600'),
    (20, 5, 0, '1200'),
    (21, 6, 0, 'Nine Pin'),
    (22, 6, 0, 'Seven Pin'),
    (23, 6, 1, 'Ten Pin'),
    (24, 6, 0, 'Eight Pin'),
    (25, 7, 1, 'True'),
    (26, 7, 0, 'False'),
    (27, 8, 0, 'Plank'),
    (28, 8, 1, 'Approach'),
    (29, 8, 0, 'Walk'),
    (30, 8, 0, 'Standard'),
    (31, 9, 0, 'The Jug Heads'),
    (32, 9, 1, 'The Holy Rollers'),
    (33, 9, 0, 'The Pin Pals'),
    (34, 9, 0, 'The Beer Frames'),
    (35, 10, 1, 'Strike'),
    (36, 10, 0, 'Spare'),
    (37, 10, 0, 'Par'),
    (38, 10, 0, 'Split'),
    (39, 11, 0, 'Strike'),
    (40, 11, 0, 'Bad Bowling'),
    (41, 11, 0, 'Split'),
    (42, 11, 1, 'Spare'),
    (43, 12, 1, 'a turkey'),
    (44, 12, 0, 'a chicken'),
    (45, 12, 0, 'a pheasant'),
    (46, 12, 0, 'a good player'),
    (47, 13, 0, 'True'),
    (48, 13, 1, 'False'),
    (49, 14, 0, '10'),
    (50, 14, 0, '12'),
    (51, 14, 0, '24'),
    (52, 14, 1, '21'),
    (53, 15, 1, 'turtlepin'),
    (54, 15, 0, 'tenpin'),
    (55, 15, 0, 'duckpin'),
    (56, 15, 0, 'candlepin');
    
    ALTER TABLE `choices`
      ADD PRIMARY KEY (`id`);

    ALTER TABLE `choices`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57";
    

    $sql = "CREATE TABLE `questions` (
      `question_number` int(11) NOT NULL,
      `question_text` text NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    
    
    INSERT INTO `questions` (`question_number`, `question_text`) VALUES
    (1, 'How many pins are displayed in a single bowling lane?'),
    (2, 'How many holes are drilled as finger holes?'),
    (3, 'What is the score of a perfect game in bowling?'),
    (4, 'If you bowl 11 strikes and your final ball leaves one pin what is your score?'),
    (5, 'If you roll 3 perfect games in a row, then what is the score of the 3 game series?'),
    (6, 'What is the last pin on the rack, on the far right known as?'),
    (7, 'You should always wear bowling shoes when bowling?'),
    (8, 'What is the name of the area before the foul line, on which the bowler stands and walks towards the pins?'),
    (9, 'What is the name of Ned Flander\'s bowling team on \'The Simpsons\'?'),
    (10, 'If you knock down all ten pins on the first ball what is that known as?'),
    (11, 'If it takes two balls to knock down all ten pins that is known as what?'),
    (12, 'If a player gets three strikes in a row, this is known as what?'),
    (13, 'If you bowl on a handicap league, this means you\'re physically handicapped?'),
    (14, 'What is the maximum amount of times one can go up and release the ball in a single game?'),
    (15, 'Which of the following is not a bowling game?');
    
    ALTER TABLE `questions`
      ADD PRIMARY KEY (`question_number`);

    ALTER TABLE `questions`
      MODIFY `question_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16";
    

    if (mysqli_query($conn, $sql)) echo "<p>TABLE users CREATED.</p>";
	  else echo "<p>TABLE users FAILED TO BE CREATED: " . mysqli_error($conn) . "</p>";

    mysqli_close($conn);
?>