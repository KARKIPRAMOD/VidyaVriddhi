<?php
include_once('../database/db_connect.php');

if(isset($_POST['approve'])) {
    $item_id = $_POST['item_id'];

    $sql_select_resource = "SELECT * FROM uploaded_items WHERE id = '$item_id'";
    $result_select_resource = $conn->query($sql_select_resource);

    if ($result_select_resource->num_rows > 0) {
        $row = $result_select_resource->fetch_assoc();
        $title = $row["title"];
        $description = $row["description"];
        $course_id = $row["course_id"];
        $expert_id = $row["expertise_id"];
        $resource_link = $row["video_path"];
        

        $sql_insert_topic = "INSERT INTO Topics (topic_name, course_id) VALUES ('$title', '$course_id')";
        if ($conn->query($sql_insert_topic) === TRUE) {
            $topic_id = $conn->insert_id;

            $sql_insert_resource = "INSERT INTO resources (topic_id, resource_name,description, expertise_id, resource_link) VALUES ('$topic_id', '$title','$description', '$expert_id', '$resource_link')";
            if ($conn->query($sql_insert_resource) === TRUE) {
                $sql_delete_item = "DELETE FROM uploaded_items WHERE id = '$item_id'";
                if ($conn->query($sql_delete_item) === TRUE) {
                    echo "Resource approved and inserted successfully.";
                    //  sendNotification($conn, $title, " New Topic added", "/students/course.php");

                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                echo "Error inserting record into resources table: " . $conn->error;
            }
        } else {
            echo "Error inserting record into Topics table: " . $conn->error;
        }
    } else {
        echo "No resource found with the specified item ID.";
    }
} elseif(isset($_POST['reject'])) {
} else {
    echo "Action not specified.";
}


?>
