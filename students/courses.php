<?php
include_once ('student_header.php');
include_once ('../database/db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    $learner_username = $_SESSION['username'];

    $sql_get_learner_id = "SELECT id FROM learner WHERE email = '$learner_username'";
    $result_get_learner_id = $conn->query($sql_get_learner_id);
    if ($result_get_learner_id->num_rows > 0) {
        $row_learner_id = $result_get_learner_id->fetch_assoc();

        $learner_id = $row_learner_id['id'];
        $sql = "SELECT c.course_id, 
            c.course_name, 
            c.course_image, 
            COUNT(DISTINCT e.id) AS total_contributors,
            COUNT(DISTINCT r.resource_id) AS total_resources,
            EXISTS(SELECT 1 FROM enrollments WHERE course_id = c.course_id AND learner_id = '$learner_id') AS is_enrolled
            FROM Courses c
            LEFT JOIN Topics t ON c.course_id = t.course_id
            LEFT JOIN Resources r ON t.topic_id = r.topic_id
            LEFT JOIN expert e ON r.expertise_id = e.id
            GROUP BY c.course_id, c.course_name, c.course_image;";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $count = 0;
            echo '<div>';
            while ($row = $result->fetch_assoc()) {
                echo '<div class="course-box">';
                echo '<a href="../contents/content_generator.php?course_id=' . $row["course_id"] . '">';
                echo '<img src="../images/' . $row["course_image"] . '" alt="' . $row["course_name"] . '">';
                echo '</a>';
                echo '<h2>' . $row["course_name"] . '</h2>';
                echo '<p>Contributors: ' . $row["total_contributors"] . '</p>';
                echo '<p>Resources: ' . $row["total_resources"] . '</p>';
                echo '<a href="review.php?course_id=' . $row["course_id"] . ' " class="button-28">Reviews</a>';
                if ($row["is_enrolled"]) {
                    echo '<a href="progress.php?course_id=' . $row["course_id"] . '" class="button-28">Progress</a>';
                } else {
                    echo '<a href="enroll.php?course_id=' . $row["course_id"] . '" class="button-28">Enroll</a>';
                }
                echo '</div>';
                $count++;
                if ($count % 3 == 0) {
                    echo '<br>';
                }
            }
            echo '</div>';
        } else {
            echo "No courses found.";
        }
    } else {
        echo "Error: Unable to fetch learner ID.";
    }
    ?>
</body>

</html>