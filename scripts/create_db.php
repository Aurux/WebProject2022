<?php
    // This file creates all tables, including example data.

    require_once("scripts/functions.php");
    $conn = connectDatabase(false);

    $sql = "CREATE DATABASE IF NOT EXISTS bowlingDB";
    if (mysqli_query($conn, $sql)) consoleLog("DB created.");
    else consoleLog("DB failed to be created: " . mysqli_error($conn));

    $sql = "USE bowlingDB";
    mysqli_query($conn, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS users (
                username int NOT NULL AUTO_INCREMENT,
                forename VARCHAR(30) NOT NULL,
                surname VARCHAR(50) NOT NULL,
                email VARCHAR(255) NOT NULL,
                uType ENUM('student', 'tutor') NOT NULL,
                pass VARCHAR(255) NOT NULL,
                authorised boolean,
                PRIMARY KEY (username)
                );
            
            ALTER TABLE users AUTO_INCREMENT=100000;
            CREATE TABLE IF NOT EXISTS choices (
                id int(11) NOT NULL,
                question_number int(11) NOT NULL,
                is_correct tinyint(1) NOT NULL DEFAULT 0,
                choices_text text NOT NULL
                );
            INSERT INTO choices (id, question_number, is_correct, choices_text) VALUES
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
    
            ALTER TABLE choices
            ADD PRIMARY KEY (id);
            ALTER TABLE choices
            MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
      
            CREATE TABLE IF NOT EXISTS questions (
                question_number int(11) NOT NULL,
                question_text text NOT NULL
                );
            INSERT INTO questions (question_number, question_text) VALUES
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
            
            ALTER TABLE questions ADD PRIMARY KEY (question_number);

            ALTER TABLE questions MODIFY question_number int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
            
            CREATE TABLE IF NOT EXISTS courses (
                courseID INT AUTO_INCREMENT,
                courseName VARCHAR(50) NOT NULL,
                courseCredits int,
                PRIMARY KEY (courseID)
                );
            
            INSERT INTO courses (courseName, courseCredits) VALUES
                ('Introduction to Bowling', 80),
                ('Intermediate Bowling', 80),
                ('Advanced Bowling', 80),
                ('Alley Management', 40),
                ('Strike Animation', 60),
                ('Lane Oiling', 20);
                

            CREATE TABLE IF NOT EXISTS studentCourses (
                username int,
                courseID int,
                completion decimal(3,2) DEFAULT 0,
                FOREIGN KEY(username) REFERENCES users(username)
                ON UPDATE CASCADE ON DELETE RESTRICT,
                FOREIGN KEY(courseID) REFERENCES courses(courseID)
                ON UPDATE CASCADE ON DELETE RESTRICT
                
                );

            CREATE TABLE IF NOT EXISTS timetable (
                id int(11) NOT NULL,
                courseID int(11) NOT NULL,
                time text NOT NULL,
                monday varchar(225) NOT NULL,
                tuesday varchar(225) NOT NULL,
                wednesday varchar(225) NOT NULL,
                thursday varchar(255) NOT NULL,
                friday varchar(225) NOT NULL
            );

            INSERT INTO timetable (id, courseID, time, monday, tuesday, wednesday, thursday, friday) VALUES
                (1, 1, '09:00', 'LT1-Lecture', '-', 'LT2-Lecture', '-', '-'),
                (2, 1, '10:00', 'F1R3-Seminar', '-', 'F1R2-Seminar', '-', 'F2R5-Tutorial'),
                (3, 1, '11:00', '-', '-', 'F3R1-Tutorial', '-', '-'),
                (4, 1, '12:00', '-', '-', '-', '-', '-'),
                (5, 1, '13:00', '-', 'LT3-Lecture', '-', '-', '-'),
                (6, 1, '14:00', 'LT1-Lecture', 'F3R3-Seminar', '-', 'LT2-Lecture', '-'),
                (7, 1, '15:00', 'F3R3-Seminar', '-', '-', 'F1R4-Seminar', '-'),
                (8, 1, '16:00', '-', 'F1R4-Tutorial', '-', '-', '-'),
                (9, 2, '09:00', '-', 'LT3-Lecture', '-', '-', 'F3R1-Tutorial'),
                (10, 2, '10:00', 'LT2-Lecture', 'F2R4-Seminar', '-', '-', '-'),
                (11, 2, '11:00', 'F1R5-Seminar', '-', '-', 'LT3-Lecture', '-'),
                (12, 2, '12:00', '-', '-', 'F1R2-Tutorial', 'F3R2-Seminar', '-'),
                (13, 2, '13:00', '-', '-', '-', 'LT2-Lecture', '-'),
                (14, 2, '14:00', 'LT3-Lecture', '-', '-', 'F3R2-Seminar', '-'),
                (15, 2, '15:00', 'F2R3-Tutorial', '-', '-', '-', '-'),
                (16, 2, '16:00', '-', '-', '-', '-', '-'),
                (17, 3, '09:00', '-', 'LT2-Lecture', '-', '-', '-'),
                (18, 3, '10:00', '-', 'F3R3-Seminar', 'LT1-Lecture', '-', 'LT2-Lecture'),
                (19, 3, '11:00', '-', 'LT2-Lecture', 'F3R3-Seminar', '-', 'F4R1-Seminar'),
                (20, 3, '12:00', '-', 'F4R1-Seminar', '-', 'LT2-Lecture', '-'),
                (21, 3, '13:00', 'F1R2-Tutorial', '-', '-', 'F4R1-Seminar', '-'),
                (22, 3, '14:00', '-', '-', '-', 'LT2-Lecture', '-'),
                (23, 3, '15:00', '-', 'F3R2-Tutorial', '-', 'F3R3-Seminar', '-'),
                (24, 3, '16:00', '-', '-', '-', '-', '-'),
                (25, 4, '09:00', 'LT2-Lecture', 'LT1-Lecture', '-', 'F1R8-Tutorial', 'LT3-Lecture'),
                (26, 4, '10:00', 'F4R6-Seminar', 'F2R3-Seminar', '-', '-', 'F2R3-Seminar'),
                (27, 4, '11:00', 'LT3-Lecture', '-', '-', '-', 'LT1-Lecture'),
                (28, 4, '12:00', 'F2R3-Seminar', 'LT2-Lecture', '-', '-', 'F4R6-Seminar'),
                (29, 4, '13:00', '-', 'F4R6-Seminar', '-', '-', '-'),
                (30, 4, '14:00', 'F1R8-Tutorial', '-', '-', '-', '-'),
                (31, 4, '15:00', '-', '-', '-', '-', '-'),
                (32, 4, '16:00', '-', '-', '-', '-', '-'),
                (33, 5, '09:00', '-', 'LT3-Lecture', '-', '-', '-'),
                (34, 5, '10:00', '-', 'F2R3-Seminar', '-', '-', '-'),
                (35, 5, '11:00', 'LT2-Lecture', '-', '-', '-', 'LT2-Lecture'),
                (36, 5, '12:00', 'F2R3-Seminar', 'LT1-Lecture', '-', '-', 'F3R5-Seminar'),
                (37, 5, '13:00', '-', 'F3R5-Seminar', '-', '-', 'F4R2-Tutorial'),
                (38, 5, '14:00', '-', 'F1R7-Tutorial', '-', '-', 'LT1-Lecture'),
                (39, 5, '15:00', 'LT2-Lecture', '-', '-', '-', 'F2R3-Seminar'),
                (40, 5, '16:00', 'F3R5-Seminar', '-', '-', '-', '-'),
                (41, 6, '09:00', '-', '-', '-', '-', '-'),
                (42, 6, '10:00', 'F1R4-Tutorial', '-', 'LT3-Lecture', '-', '-'),
                (43, 6, '11:00', '-', '-', 'F243-Seminar', 'LT2-Lecture', '-'),
                (44, 6, '12:00', 'LT1-Lecture', '-', 'LT3-Lecture', 'F1R3-Seminar', '-'),
                (45, 6, '13:00', 'F2R4-Seminar', '-', 'F2R4-Seminar', '-', '-'),
                (46, 6, '14:00', '-', '-', '-', '-', '-'),
                (47, 6, '15:00', 'LT2-Lecture', '-', '-', 'LT1-Lecture', '-'),
                (48, 6, '16:00', 'F1R3-Seminar', '-', '-', 'F1R3-Seminar', 'F2R4-Tutorial');

            ALTER TABLE timetable
            ADD PRIMARY KEY (id);

            ALTER TABLE timetable
            MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

            CREATE TABLE IF NOT EXISTS assessments (
                id int NOT NULL AUTO_INCREMENT,
                title VARCHAR(255),
                info TEXT,
                deadline DATE,
                creditWeight DECIMAL(3,2),
                courseID int,
                PRIMARY KEY (id),
                FOREIGN KEY(courseID) REFERENCES courses(courseID)
                ON UPDATE CASCADE ON DELETE RESTRICT
                
                );

            CREATE TABLE IF NOT EXISTS studentAssessments (
                username int,
                id int,
                completed boolean default false,
                completion decimal(3,2) DEFAULT 0,
                FOREIGN KEY(username) REFERENCES users(username)
                ON UPDATE CASCADE ON DELETE RESTRICT,
                FOREIGN KEY(id) REFERENCES assessments(id)
                ON UPDATE CASCADE ON DELETE RESTRICT
                );

            CREATE TABLE IF NOT EXISTS events (
                title varchar(225) NOT NULL,
                event_date date NOT NULL
                );

            CREATE TABLE IF NOT EXISTS quizScore (
                username int,
                quizscore int,
                PRIMARY KEY (username),
                FOREIGN KEY(username) REFERENCES users(username)
                ON UPDATE CASCADE ON DELETE RESTRICT
            );
            ";


    if ($conn->multi_query($sql) === TRUE) consoleLog("Table creation successful!");
    else {
      consoleLog("TABLE(s) FAILED TO BE CREATED: " . mysqli_error($conn));
    }
  
    mysqli_close($conn);
?>