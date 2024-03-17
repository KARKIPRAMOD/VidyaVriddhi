<?php
//session_start();
if (!isset ($_SESSION['username'])) {
    header("location: ../register/login.php");
    exit();
} else {
    include '../database/db_connect.php';

    $email = $_SESSION['username'];
    $notify = [];

    $notifysql = "SELECT * from notification limit 5";
    $result = $conn->query($notifysql);
    $sql = "SELECT document FROM expert WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $document = $row['document'];
        } else {
            echo "No rows returned from the database for username: $email";
        }
    } else {
        echo "Query execution failed: " . $conn->error;
    }
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

                <div class="popup" onclick="togglePopUpHome()">

                    <div id="user_btn" class="fas fa-user"></div>
                </div>
                <div class="pop_container" id="pophome">
                    <ul>
                        <li> <img src="<?php echo $document; ?>"> </li>
                        <li class="" id=""> Profile</li>
                        <li> <a href="../register/logout.php"> Logout </a></li>
                    </ul>
                </div>
            </div>
        </section>
    </header>

    <script>

        function togglePopUpHome() {
            document.getElementById("pophome").classList.toggle("show");

        }
    </script>
</body>

</html>