<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessments</title>
    <link rel="stylesheet" href="progress.css">
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start; 
        }

        .left-column {
            width: 45%; 
            padding: 20px;
            border:solid;
            box-sizing: border-box;
        }

        .right-column {
            width: 45%; 
            padding: 20px;
            border:solid;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <?php
    include_once('../database/db_connect.php');
    include_once('header.php');
    session_start();

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        $sql_user_id = "SELECT id FROM learner WHERE email = '$username'";
        $result_user_id = $conn->query($sql_user_id);

        if ($result_user_id->num_rows > 0) {
            $row_user_id = $result_user_id->fetch_assoc();
            $user_id = $row_user_id['id'];

            if (isset($_GET['course_id'])) {
                $course_id = $_GET['course_id'];

                $sql_course_name = "SELECT course_name FROM courses WHERE course_id = '$course_id'";
                $result_course_name = $conn->query($sql_course_name);
                $row_course_name = $result_course_name->fetch_assoc();
                $course_name = $row_course_name['course_name'];

                echo "<div class='container'>";
                echo "<div class='left-column'>";
                echo "<h2>Assessments for Course: $course_name</h2>";

                $sql_unattempted = "SELECT a.id, a.title, a.passing_score 
                                    FROM assessments a 
                                    LEFT JOIN assessment_results ar ON a.id = ar.assessment_id AND ar.learner_id = '$user_id'
                                    WHERE a.course_id = '$course_id' AND ar.learner_id IS NULL";
                $result_unattempted = $conn->query($sql_unattempted);

                if ($result_unattempted->num_rows > 0) {
                    echo "<ul>";
                    while ($row_unattempted = $result_unattempted->fetch_assoc()) {
                        $assessment_id = $row_unattempted['id'];
                        $assessment_title = $row_unattempted['title'];
                        $passing_score = $row_unattempted['passing_score'];

                        echo "<li><a href='attempt_assessment.php?assessment_id=$assessment_id' class='assessment-link'>$assessment_title</a> (Passing Score: $passing_score)</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p class='no-assessments'>No unattempted assessments found for Course: $course_name (ID: $course_id)</p>";
                }
                echo "</div>"; 

                echo "<div class='right-column'>";
                echo "<h2>Attempted Assessments</h2>";

                $sql_attempted = "SELECT a.title, a.passing_score, ar.score, ar.passed 
                                  FROM assessments a 
                                  INNER JOIN assessment_results ar ON a.id = ar.assessment_id 
                                  WHERE a.course_id = '$course_id' AND ar.learner_id = '$user_id'";
                $result_attempted = $conn->query($sql_attempted);

                if ($result_attempted->num_rows > 0) {
                    echo "<ul>";
                    while ($row_attempted = $result_attempted->fetch_assoc()) {
                        $assessment_title = $row_attempted['title'];
                        $passing_score = $row_attempted['passing_score'];
                        $score = $row_attempted['score'];
                        $passed = $row_attempted['passed'] ? "Passed" : "Failed";

                        echo "<li>";
                        echo "<strong>Title:</strong> $assessment_title<br>";
                        echo "<strong>Passing Score:</strong> $passing_score<br>";
                        echo "<strong>Score:</strong> $score<br>";
                        echo "<strong>Status:</strong> $passed<br>";
                        echo "</li>";
                    }
                    echo "</ul>";
                    echo '<a href="certificate.php" class="button-28">Certificate</a>';

                } else {
                    echo "<p class='no-assessments'>No attempted assessments found for Course: $course_name (ID: $course_id)</p>";
                }
                echo "</div>"; 
                echo "</div>"; 
            } else {
                echo "<p class='no-course'>No course selected.</p>";
            }
        } else {
            echo "<p class='no-user'>User not found.</p>";
        }
    } else {
        echo "<p class='not-logged-in'>You are not logged in.</p>";
    }
    ?>
</body>
</html>
