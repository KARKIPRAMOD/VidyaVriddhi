<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styles.css">

</head>
<body>
<?php
    include_once('admin_header.php');
    include_once('../database/db_connect.php');

    $sql = "SELECT c.course_id, 
        c.course_name, 
        c.course_image, 
        COUNT(DISTINCT e.expertise_id) AS total_contributors,
        COUNT(DISTINCT r.resource_id) AS total_resources
        FROM Courses c
        LEFT JOIN Topics t ON c.course_id = t.course_id
        LEFT JOIN Expertise e ON t.topic_id = e.topic_id
        LEFT JOIN Resources r ON t.topic_id = r.topic_id
        GROUP BY c.course_id, c.course_name, c.course_image;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $count = 0;
        echo '<div>'; 
        while ($row = $result->fetch_assoc()) {
            $course_id = $row["course_id"];
            $check_sql = "SELECT COUNT(*) AS count FROM uploaded_items WHERE course_id = '$course_id'";
            $check_result = $conn->query($check_sql);
            $check_row = $check_result->fetch_assoc();
            $has_uploaded_items = $check_row["count"] > 0;

            echo '<div class="course-box">';
            echo '<a href="../contents/content_generator.php?course_id=' . $row["course_id"] . '">';
            echo '<img src="../images/' . $row["course_image"] . '" alt="' . $row["course_name"] . '">';
            echo '</a>';
            echo '<h2>' . $row["course_name"] . '</h2>';
            echo '<p>Contributors: ' . $row["total_contributors"] . '</p>';
            echo '<p>Resources: ' . $row["total_resources"] . '</p>';

            if ($has_uploaded_items) {
                echo '<form action="approve.php" method="post">';
                echo '<a href="approve.php?course_id=' . $course_id . '" class="button-35">Approve</a>';
                echo '</form>';
            }
            

            echo '<form action="course_process.php" method="post">';
            echo '<input type="hidden" name="course_id" value="' . $row["course_id"] . '">';
            echo '<button type="submit" name="update_course" class="button-35">Update</button>';
            echo '<button type="submit" name="delete_course" class="button-35">Delete</button>';
            echo '<button type="submit" name="reviews" class="button-35">Reviews</button>';
            echo '</form>';
            
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