<?php
include_once('../database/db_connect.php');
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT id FROM expert WHERE email = '$username'";
    $result = $conn->query($sql);
    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $expertise_id = $row['id'];
        } else {
            echo "No rows returned from the database for username: $username";
        }
    } else {
        echo "Query execution failed: " . $conn->error;
    }
} else {
    echo "Username session variable is not set.";
}

if (isset ($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
} else {
    echo "Course ID is not provided!";
    exit(); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $passing_score = $_POST['passing_score'];
    $course_id = $_POST['course_id']; 
    
    echo "Expertise ID: " . $expertise_id . "<br>"; 
    echo "Course ID: " . $course_id . "<br>";
    
    $sql_insert_assessment = "INSERT INTO assessments (title, description, expertise_id, passing_score, course_id) 
                              VALUES ('$title', '$description', $expertise_id, $passing_score, $course_id)";
    if ($conn->query($sql_insert_assessment) === TRUE) {
        $assessment_id = $conn->insert_id; 
        
        for ($i = 1; $i <= 1; $i++) {
            $question_text = $_POST["question$i"];
            $correct_option = $_POST["correct_option$i"];
            $option1 = $_POST["option1_$i"];
            $option2 = $_POST["option2_$i"];
            $option3 = $_POST["option3_$i"];
            $option4 = $_POST["option4_$i"];
            
            $sql_insert_question = "INSERT INTO questions (assessment_id, question_text, correct_option, option1, option2, option3, option4) 
                                    VALUES ($assessment_id, '$question_text', $correct_option, '$option1', '$option2', '$option3', '$option4')";
            $conn->query($sql_insert_question);
        }
        
        echo "Assessment created successfully.";
    } else {
        echo "Error creating assessment: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Assessment</title>
    <link rel="stylesheet" href="assessment.css">
</head>
<body>
    <h2>Create Assessment</h2>
    <form action="assessment.php?course_id=<?php echo $course_id; ?>" method="post">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br>
        
        <label for="passing_score">Passing Score:</label><br>
        <input type="number" id="passing_score" name="passing_score" step="0.01" required><br>
        
        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
        
        <h3>Questions:</h3>
        <?php for ($i = 1; $i <= 1; $i++): ?>
            <label for="question<?php echo $i; ?>">Question <?php echo $i; ?>:</label><br>
            <input type="text" id="question<?php echo $i; ?>" name="question<?php echo $i; ?>" required><br>
            
            <label for="correct_option<?php echo $i; ?>">Correct Option:</label><br>
            <input type="number" id="correct_option<?php echo $i; ?>" name="correct_option<?php echo $i; ?>" required min="1" max="4"><br>
            
            <label for="option1_<?php echo $i; ?>">Option 1:</label><br>
            <input type="text" id="option1_<?php echo $i; ?>" name="option1_<?php echo $i; ?>" required><br>
            
            <label for="option2_<?php echo $i; ?>">Option 2:</label><br>
            <input type="text" id="option2_<?php echo $i; ?>" name="option2_<?php echo $i; ?>" required><br>
            
            <label for="option3_<?php echo $i; ?>">Option 3:</label><br>
            <input type="text" id="option3_<?php echo $i; ?>" name="option3_<?php echo $i; ?>" required><br>
            
            <label for="option4_<?php echo $i; ?>">Option 4:</label><br>
            <input type="text" id="option4_<?php echo $i; ?>" name="option4_<?php echo $i; ?>" required><br>
            <br><br><br><br>
        <?php endfor; ?>
        
        <input type="submit" value="Create Assessment">
    </form>
</body>
</html>
