<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
     include_once('student_header.php');
     include_once('../database/db_connect.php');
    ?>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<?php
    $sql = "SELECT * FROM courses";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $count = 0;
        echo '<div>'; 
        while ($row = $result->fetch_assoc()) {
            echo '<div class="course-box">';
            echo '<a href="course.php?course_id=' . $row["course_id"] . '">';
            echo '<img src="../images/' . $row["course_image"] . '" alt="' . $row["course_name"] . '">';
            echo '</a>';
            echo '<h2>' . $row["course_name"] . '</h2>';
            echo '<p>Contributors: ' . $row["contributors"] . '</p>';
            echo '<p>Resources: ' . $row["resources"] . '</p>';
            echo '<a href="reviews.php?course_id=' . $row["course_id"] . ' " class="button-28">Reviews</a>';
            echo '<a href="enroll.php?course_id=' . $row["course_id"] . ' " class="button-28">Enroll</a>';

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
    ?>
</body>
</html>