<?php
session_start();

include '../database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT type FROM login_credentials WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;

        $row = $result->fetch_assoc();
        $userType = $row['type'];

        if ($userType === 'student') {
            header("Location: ../students/home.php?username=$username");
            exit();
        } elseif ($userType === 'expertise') {
            header("Location: ../expertise/expertise_header.php?username=$username");
            exit();
        } elseif ($userType === 'admin') {
            header("Location: ../admin/admin_header.php?username=$username");
            exit();

        }

    } else {
        echo "Invalid username or password";
    }
}
