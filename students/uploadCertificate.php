<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['certificate'])) {
        $target_dir = "../certificate/";
        $unique = uniqid();
        $target_file = $target_dir . $unique;
        if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)) {
            echo "Certificate was Uploaded successfully!";
            http_response_code(200);
        } else {
            echo "Image not uplaoded!";
            http_response_code(404);
        }
    } else {
        echo "Image not uplaoded!";
        http_response_code(404);
    }
} else {
    http_response_code(404);
}
