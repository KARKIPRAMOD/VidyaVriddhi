<?php
include_once('admin_header.php');
include_once('../database/db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
<div class="course-box1">
    <h1>Register New Expertise <div class="fas fa-user"></div></h1>
    <a href="register_expertise.php" class="button-24">Register</a>
</div>

<?php
$sql = "SELECT e.*, COUNT(r.resource_id) AS resource_count 
        FROM expertise e 
        LEFT JOIN resources r ON e.expertise_id = r.expertise_id 
        GROUP BY e.expertise_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $count = 0;
    echo '<div>';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="course-box">';
        echo '<a href="../teachers/' . $row["expertise_id"] . '.php">';
        echo '<img src="../images/' . $row["teacher_image"] . '" alt="' . $row["teacher_name"] . '" class="profile-img">';
        echo '</a>';
        echo '<i class="fas fa-user"></i>';
        echo '<h2>' . $row["teacher_name"] . '</h2>';
        echo '<p>Resources: ' . $row["resource_count"] . '</p>'; 
        echo '<a href="update_course.php?course_id=' . $row["expertise_id"] . ' " class="button-35">Update</a>';
        echo '<a href="reviews.php?course_id=' . $row["expertise_id"] . ' " class="button-35">Delete</a>';
        echo '<a href="reviews.php?course_id=' . $row["expertise_id"] . ' " class="button-35">Reviews</a>';
        echo '</div>';
        $count++;
        if ($count % 3 == 0) {
            echo '<br>';
        }
    }
    echo '</div>';
} else {
    echo "No expertise found.";
}
?>
</body>
</html>
