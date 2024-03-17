<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/student/review.css" />
  <title>Review</title>
  <?php
  include_once ('../database/db_connect.php');
  ?>
</head>

<body>
  <div class="containers">
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

    $sql = "SELECT r.rating, r.review_text, l.fname,l.id, l.profile_picture
        FROM Reviews r
        JOIN learner l ON r. learner_id = l.id
        WHERE r.course_id = $course_id";
    $result = $conn->query($sql);
    $reviews = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
      }
    }
    ?>

    <div class="container_course">
      <ul>
        <li> <img src="<?php echo $course_image; ?>" alt="<?php echo $course_name; ?>"></li>
        <li>
          <?php echo $course_name; ?>
        </li>
        <li class="text">Contributors:</li>
        <li class="text">Resources:</li>
        <li>
          <?php echo $course_description; ?>
        </li>
      </ul>
    </div>

    <div class="container_review">
      <div class="detail">
        <?php if (empty ($reviews)) {
          echo "No reviews yet.";
        } else {
          foreach ($reviews as $review) {
            echo "<div class='user_details'>";
            echo " <img src='{$review['profile_picture']}'  class='profile-picture'>";
            echo "<p>{$review['fname']}</p>";
            echo "</div>";
            echo "<div class='message'>";
            echo "<input type='text' class='message' placeholder='{$review['review_text']}'/> ";
            echo "</div>";
            echo "</div>";
            echo "<div class='star'>";
            echo "<label><strong>Rating:</strong> {$review['rating']}</label>";
            echo "</div>";
            echo "</div>";
          }
        }
        ?>
        <div class="container_comment">
          <textarea type="textarea" class="comment"></textarea>
          <button type="submit">Comment</button>
        </div>
      </div>
</body>

</html>