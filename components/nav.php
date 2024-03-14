<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect unauthorized users to the login page
    header("location: ../register/login.php");
    exit();
} else {
    include '../database/db_connect.php';

    // if (isset($_SESSION['username'])) {
//     $username = $_SESSION['username'];
//     $sql = "SELECT name, profile_picture FROM learner WHERE email = '$username'";
//     $result = $conn->query($sql);
//     if ($result->num_rows > 0) {
//         $row = $result->fetch_assoc();
//         $name = $row['name'];
//         $profile = $row['profile_picture'];
//     }
// }

    // $userNameDisplay = isset($name) ? $name : 'User';
    $email = $_SESSION['username'];
    $notify = [];

    $notifysql = "SELECT * from notification limit 5";
    $result = $conn->query($notifysql);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/components/nav.css">
</head>

<body>
    <header class="header">
        <section class="sec">
            <div class="logo-container">
                <a href="home.php">
                    <img src="../images/logo.png" alt="Vidya Vriddhi" class="logo-img">
                </a>
            </div>
            <form action="" method="POST" class="form">
                <input type="text" placeholder="search course">
                <button type="submit" class="fas fa-search" name="search_box"></button>
            </form>

            <!-- notification popup -->
            <div class="icons">
                <div class="popup" onclick="togglePopUpMessage()">
                    <div id="menu_btn" class="fas fa-bell"></div>
                </div>
                <div class="popmessage_container" id="popmessage">
                    <ul>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo '<li class="" id="">' . $row["message"] . '</li>';
                        }
                        ?>
                    </ul>
                </div>

                <div class="popup" onclick="togglePopUpHome()">

                    <div id="user_btn" class="fas fa-user"></div>
                </div>
                <div class="pop_container" id="pophome">
                    <ul>
                        <li> <img src="../images/icone.png"> </li>
                        <li class="" id=""> Profile</li>
                        <li class="" id=""> Logout</li>
                    </ul>
                </div>
            </div>
        </section>
    </header>

    <script>
        function togglePopUpMessage() {
            document.getElementById("popmessage").classList.toggle("show");
            document.getElementById("pophome").classList.toggle("close-popup");

        }

        function togglePopUpHome() {
            document.getElementById("pophome").classList.toggle("show");
            document.getElementById("popmessage").classList.toggle("close-popup");

        }
    </script>
</body>

</html>