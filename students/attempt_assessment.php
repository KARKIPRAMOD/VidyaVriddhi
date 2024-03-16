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

    $assessment_id = isset($_GET['assessment_id']) ? $_GET['assessment_id'] : null; 

    if (!$assessment_id) {
        echo "<p>No assessment ID provided.</p>";
        exit;
    }

    $sql = "SELECT a.*, q.*
            FROM assessments a
            INNER JOIN questions q ON a.id = q.assessment_id
            WHERE q.assessment_id = '$assessment_id'";
    $result = $conn->query($sql);

    echo "<div class='containers'>";
    if ($result && $result->num_rows > 0) {
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
            echo "<li><input type='radio' name='answer[" . $row['id'] . "]' value='1'>" . $row['option1'] . "</li>";
            echo "<li><input type='radio' name='answer[" . $row['id'] . "]' value='2'>" . $row['option2'] . "</li>";
            echo "<li><input type='radio' name='answer[" . $row['id'] . "]' value='3'>" . $row['option3'] . "</li>";
            echo "<li><input type='radio' name='answer[" . $row['id'] . "]' value='4'>" . $row['option4'] . "</li>";
            echo "</ul>"; 
            echo "</div>"; 
            echo "</div>"; 
        }
    } else {
        echo "<p>No questions available for this assessment.</p>";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
        $sql_correct_answers = "SELECT id, correct_option FROM questions WHERE assessment_id = '$assessment_id'";
        $result_correct_answers = $conn->query($sql_correct_answers);
        $correct_answers = [];

        if ($result_correct_answers && $result_correct_answers->num_rows > 0) {
            while ($row = $result_correct_answers->fetch_assoc()) {
                $correct_answers[$row['id']] = $row['correct_option'];
            }
        }

        foreach ($_POST['answer'] as $question_id => $selected_answer) {
            $correct_answer = isset($correct_answers[$question_id]) ? $correct_answers[$question_id] : null;
            $is_correct = ($correct_answer && $selected_answer == $correct_answer) ? 1 : 0;

            $sql_insert_result = "INSERT INTO assessment_results (assessment_id, question_id, selected_answer, is_correct) 
                                  VALUES ('$assessment_id', '$question_id', '$selected_answer', '$is_correct')";
            $conn->query($sql_insert_result);
        }

        echo "Answers submitted and results stored successfully.";
    }

    $conn->close();
    ?>
        <form action="attempt_assessment.php" method="post">
            <input type="hidden" name="assessment_id" value="<?php echo $assessment_id; ?>">
            <input type="submit" value="Submit Answers">
        </form>
    </div>
</body>
</html>
