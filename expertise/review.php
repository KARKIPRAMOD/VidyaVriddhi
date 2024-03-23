<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Reviews</title>
      <link rel="stylesheet" href="../css/student/review.css" />

    <?php
    include_once ('../database/db_connect.php');
    ?>
</head>

<body>
    <h1>Course Reviews</h1>
    <?php

    $course_id = $_GET['course_id'];

    $sql = "SELECT * FROM Courses WHERE course_id = $course_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $course = $result->fetch_assoc();
        $course_name = $course['course_name'];
        $course_description = $course['course_description'];
        $course_image = $course['course_image'];
    } else {
        echo "Course not found";
        exit;
    }

    $sql = "SELECT r.rating, r.review_text, l.fname, l.id ,l.profile_picture
        FROM Reviews r
        JOIN learner l ON r.learner_id = l.id
        WHERE r.course_id = $course_id";


    $result = $conn->query($sql);
    $reviews = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
    }
    ?>
    <div class="course-details">
        <img src="<?php echo $course_image; ?>" alt="<?php echo $course_name; ?>">
        <h1>
            <?php echo $course_name; ?>
        </h1>
        <p>
            <?php echo $course_description; ?>
        </p>
    </div>

    <div class="reviews">
        <h2>Reviews</h2>
        <?php if (empty ($reviews)) {
            echo "No reviews yet.";
        } else {
            foreach ($reviews as $review) {
                echo "<div class='review'>";
                echo "<img src='{$review['profile_picture']}'  class='profile-picture'>";
                echo "<p><strong>Rating:</strong> {$review['rating']}</p>";
                echo "<p><strong>Review:</strong> {$review['review_text']}</p>";
                echo "<p><strong>Student:</strong> {$review['fname']}</p>";
                echo "</div>";
            }
        } ?>
        <h3>Add a Review</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

            <label for="student_id">Student ID:</label>
            <input type="text" name="student_id" id="student_id" required><br>

            <label for="rating">Rating:</label>
            <select name="rating" id="rating" required>
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    echo "<option value=\"{$i}\">{$i}</option>";
                }
                ?>
            </select><br>

            <label for="review_text">Review:</label><br>
            <textarea name="review_text" id="review_text" rows="5" cols="40" required></textarea><br>
            <input type="submit" value="Submit Review">
        </form>
</body>

</html>