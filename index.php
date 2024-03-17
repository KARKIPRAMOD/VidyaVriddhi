<?php
// //notification send
// function sendNotification($conn, $title, $message, $link)
// {
//     $time = round(microtime(true) * 1000);
//     $sql = "INSERT INTO notification(title,message,link,time) values ('$title','$message','$link','$time')";
//     $conn->query($sql);
// }

// $routes = [
//     "/" => "components/home.php",
//     "/registers" => "register/register.php",
//     "/login" => "register/login.php",
//     "/add" => "views/add.php",
//     "/delete" => "views/delete.php",
//     "/admin_header" => "admin/admin_header.php",
// ];

// $uri = parse_url($_SERVER["REQUEST_URI"])["path"];

// if (array_key_exists($uri, $routes)) {
//     require $routes[$uri];
// } else {
//     include 'views/404.php';
//     http_response_code(404);
// }
include './components/home.php';
?>