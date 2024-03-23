<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attempt Assessment</title>
    <link rel="stylesheet" href="assessment.css"> 
</head>
<body>
    <div class="main-content">
        <?php
        include_once('../database/db_connect.php');
        include_once('header.php');
        session_start();

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $sql_user_id = "SELECT id FROM learner WHERE email = ?";
            $stmt_user_id = $conn->prepare($sql_user_id);
            $stmt_user_id->bind_param('s', $username);
            $stmt_user_id->execute();
            $result_user_id = $stmt_user_id->get_result();
            if ($result_user_id->num_rows == 1) {
                $row_user_id = $result_user_id->fetch_assoc();
                $user_id = $row_user_id['id'];
            } else {
                echo "<p>Error: User not found.</p>";
                exit;
            }
        }

        if (isset($_GET['assessment_id'])) {
            $assessment_id = $_GET['assessment_id'];
            $sql = "SELECT a.*, q.id AS question_id, q.question_text, q.option1, q.option2, q.option3, q.option4, q.correct_option, a.passing_score
                    FROM assessments a
                    INNER JOIN questions q ON a.id = q.assessment_id
                    WHERE q.assessment_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $assessment_id);
            $stmt->execute();
            $result = $stmt->get_result();

            echo "<div class='containers'>";
            if ($result && $result->num_rows > 0) {
                echo "<form action='../students/attempt_assessment.php?assessment_id=$assessment_id' method='post'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='container'>";
                    echo "<h2>Assessment Title: " . $row['title'] . "</h2>";
                    echo "<p>Description: " . $row['description'] . "</p>";
                    echo "<p>Passing Score: " . $row['passing_score'] . "</p>";
                    echo "</div>";

                    echo "<div class='card'>";
                    echo "<h3>" . $row['question_text'] . "</h3>";
                    echo "<div class='card_contents'>";
                    echo "<ul>"; 
                    echo "<li><input type='radio' name='answer[" . $row['question_id'] . "]' value='1'>" . $row['option1'] . "</li>";
                    echo "<li><input type='radio' name='answer[" . $row['question_id'] . "]' value='2'>" . $row['option2'] . "</li>";
                    echo "<li><input type='radio' name='answer[" . $row['question_id'] . "]' value='3'>" . $row['option3'] . "</li>";
                    echo "<li><input type='radio' name='answer[" . $row['question_id'] . "]' value='4'>" . $row['option4'] . "</li>";
                    echo "</ul>"; 
                    echo "</div>"; 
                    echo "</div>";
                }
                echo "<input type='submit' value='Submit Answers'>";
                echo "</form>";
            } else {
                echo "<p>No questions available for this assessment.</p>";
            }
            echo "</div>"; 

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $assessment_id = $_GET['assessment_id'];
                $completion_date = date('Y-m-d H:i:s');
                $total_marks = 0;
                foreach ($_POST['answer'] as $question_id => $selected_answer) {
                    $sql_correct_answer = "SELECT correct_option FROM questions WHERE id = ?";
                    $stmt_correct_answer = $conn->prepare($sql_correct_answer);
                    $stmt_correct_answer->bind_param('i', $question_id);
                    $stmt_correct_answer->execute();
                    $result_correct_answer = $stmt_correct_answer->get_result();
                    if ($result_correct_answer && $result_correct_answer->num_rows == 1) {
                        $row_correct_answer = $result_correct_answer->fetch_assoc();
                        $correct_answer = $row_correct_answer['correct_option'];
                        if ($selected_answer == $correct_answer) {
                            $total_marks++;
                        }
                    }
                }

                $sql_passing_score = "SELECT passing_score FROM assessments WHERE id = ?";
                $stmt_passing_score = $conn->prepare($sql_passing_score);
                $stmt_passing_score->bind_param('i', $assessment_id);
                $stmt_passing_score->execute();
                $result_passing_score = $stmt_passing_score->get_result();
                $row_passing_score = $result_passing_score->fetch_assoc();
                $passing_score = $row_passing_score['passing_score'];

                $passed = $total_marks >= $passing_score ? 1 : 0;

                $sql_insert_result = "INSERT INTO assessment_results (assessment_id, learner_id, passed, score, date_completed) 
                                      VALUES (?, ?, ?, ?, ?)";
                $stmt_insert_result = $conn->prepare($sql_insert_result);
                $stmt_insert_result->bind_param('iiiss', $assessment_id, $user_id, $passed, $total_marks, $completion_date);
                if ($stmt_insert_result->execute()) {
                    echo "<p>Answers submitted and results stored successfully. Total marks: $total_marks</p>";
                    header("location: courses.php");
                } else {
                    echo "Error: " . $conn->error;
                }
            }
        } else {
            echo "<p>No assessment ID provided.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
