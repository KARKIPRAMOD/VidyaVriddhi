<?php
//  $servername = "localhost";
//  $username = "root";
//  $password = "";
//  $dbname = "web";

//  $conn = new mysqli($servername, $username, $password, $dbname);

//  if ($conn->connect_error) {
//      die("Connection failed: " . $conn->connect_error);

// }

$servername = "localhost:3300";
$username = "root";
$password = "root";
$dbname = "web";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
   die ("Connection failed: " . $conn->connect_error);
}
