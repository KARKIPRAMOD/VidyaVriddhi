<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessments</title>
    <link rel="stylesheet" href="progress.css">
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

            $sql_enrolled_courses = "SELECT course_id FROM enrollments WHERE learner_id = '$user_id'";
            $result_enrolled_courses = $conn->query($sql_enrolled_courses);

            if ($result_enrolled_courses->num_rows > 0) {
                echo "<div class='container'>";
                while ($row_enrolled_course = $result_enrolled_courses->fetch_assoc()) {
                    $course_id = $row_enrolled_course['course_id'];

                    $sql_course_name = "SELECT course_name FROM courses WHERE course_id = '$course_id'";
                    $result_course_name = $conn->query($sql_course_name);
                    $row_course_name = $result_course_name->fetch_assoc();
                    $course_name = $row_course_name['course_name'];

                    $sql_assessments = "SELECT id, title FROM assessments WHERE course_id = '$course_id'";
                    $result_assessments = $conn->query($sql_assessments);

                    if ($result_assessments->num_rows > 0) {
                        echo "<h2>Assessments for Course: $course_name</h2>";
                        echo "<ul>";

                        while ($row_assessment = $result_assessments->fetch_assoc()) {
                            $assessment_id = $row_assessment['id'];
                            $assessment_title = $row_assessment['title'];

                            echo "<li><a href='attempt_assessment.php?assessment_id=$assessment_id' class='assessment-link'>$assessment_title</a></li>";
                        }

                        echo "</ul>";
                    } else {
                        echo "<p class='no-assessments'>No assessments found for Course: $course_name (ID: $course_id)</p>";
                    }
                }
                echo "</div>"; 
            } else {
                echo "<p class='no-enrollment'>You are not enrolled in any courses.</p>";
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
