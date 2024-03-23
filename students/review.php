<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/student/review.css" />
  <title>Review</title>
  <?php
  include_once('../database/db_connect.php');
  include_once('header.php');

  ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    .star-rating {
      color: gold;
    }
  </style>
</head>

<body>
  <div class="containers">
    <h1>Course Reviews</h1>

    <?php

    session_start();

    if (isset($_SESSION['username'])) {
      $username = $_SESSION['username'];

      $sql_user_id = "SELECT id FROM learner WHERE email = '$username'";
      $result_user_id = $conn->query($sql_user_id);

      if ($result_user_id->num_rows > 0) {
        $row_user_id = $result_user_id->fetch_assoc();
        $user_id = $row_user_id['id'];
      }
      $course_id = $_GET['course_id'];

      $sql_check_enrollment = "SELECT * FROM enrollments WHERE learner_id = '$user_id' AND course_id = '$course_id'";
      $result_check_enrollment = $conn->query($sql_check_enrollment);

      if ($result_check_enrollment->num_rows == 0) {
        echo "You are not enrolled in this course. Only enrolled users can make reviews.";
        exit;
      }

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
        JOIN learner l ON r.learner_id = l.id
        WHERE r.course_id = $course_id";
      $result = $conn->query($sql);
      $reviews = [];
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $reviews[] = $row;
        }
      }
    } else {
      echo "You need to be logged in to make a review.";
      exit;
    }
    ?>

    <div class="container_course">
      <ul>
        <li> <img src="../images/<?php echo $course_image; ?>" alt="<?php echo $course_name; ?>"></li>
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
        <?php if (empty($reviews)) {
          echo "No reviews yet.";
        } else {
          foreach ($reviews as $review) {
            echo "<div class='user_details'>";
            echo " <img src='{$review['profile_picture']}'  class='profile-picture'>";
            echo "<p>{$review['fname']}</p>";
            echo "</div>";
            echo "<div class='message'>";
            echo "<input type='text' class='message' placeholder='{$review['review_text']}' disabled> ";
            echo "</div>";
            echo "</div>";
            echo "<div class='star'>";
            echo "<span class='star-rating'>";
            for ($i = 1; $i <= $review['rating']; $i++) {
              echo "<i class='fas fa-star'></i>";
            }
            echo "</span>";
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
    </div>
  </div>
</body>

</html>
