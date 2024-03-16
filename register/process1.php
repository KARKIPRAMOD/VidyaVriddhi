<?php
include '../database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_GET['type'] == 'student') {
        extract($_POST);
        echo "student's course";
        $profilePicture = uploadLprofile();
        $password1 = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO learner (fname,lname, address, email, contact, password, profile_picture) 
                VALUES ('$fname','$lname', '$address', '$email', '$contact', '$password1', '$profilePicture')";
        if ($conn->query($sql) === TRUE) {

            echo "Student registered successfully<br>";
            login_credentials($conn);

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    } elseif ($_GET['type'] == 'expertise') {
        extract($_POST);
        $document = uploadDocument();
        $profilePicture = uploadEprofile();
        $password1 = password_hash($password, PASSWORD_DEFAULT);
        $username = $_POST['eemail'];
        $password = $_POST['epassword'];

        $sql = "INSERT INTO expert (fname,lname,email,address, pnum, password,profession,institution, profile_picture,document,description) 
                VALUES ('$efname','$elname','$eemail','$eaddress', '$econtact', '$password1', '$eprofession','$einstitution','$profilePicture','$document', '$edes')";
        if ($conn->query($sql) === TRUE) {
            login_ecredentials($conn,$username,$password);
            header("location:./register/register.php");
            echo "Expertise registered successfully<br>";

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

function login_credentials($conn)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['email'];
        $password = $_POST['password'];
        $type = $_GET['type'];

        $sql = "INSERT INTO login_credentials (username, password, type) 
                      VALUES ('$username', '$password', '$type')";
        if ($conn->query($sql) === TRUE) {
            echo "Login credentials stored successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}

function login_ecredentials($conn,$username,$password)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $type = $_GET['type'];

        $sql = "INSERT INTO login_credentials (username, password, type) 
                      VALUES ('$username', '$password', '$type')";
        if ($conn->query($sql) === TRUE) {
            echo "Login credentials stored successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}

function uploadLprofile()
{
    $target_dir = "../uploads/profile/";
    $unique = uniqid();
    $target_file = $target_dir . $unique;
    if (move_uploaded_file($_FILES["pimg"]["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        return 0;
    }
}

function uploadEprofile()
{
    $target_dir = "../uploads/profile/";
    $unique = uniqid();
    $target_file = $target_dir . $unique;
    if (move_uploaded_file($_FILES["epimg"]["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        return 0;
    }
}

function uploadDocument()
{
    $target_dir = "../uploads/profile/";
    $unique = uniqid();
    $target_file = $target_dir . $unique;
    if (move_uploaded_file($_FILES["edoc"]["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        return 0;
    }
}
?>
