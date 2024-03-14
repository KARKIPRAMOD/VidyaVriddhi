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
                        <li class="" id=""> hello</li>
                        <li class="" id=""> rishi</li>
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
    <div class="side-bar">
        <div class="close-side-bar">
            <i class="fas fa-times"></i>
        </div>
        <div class="profile">
            <img src="../uploads/profile/<?php echo $profile; ?>" alt="Profile Picture">
            <h3>
                <!-- <?php echo $userNameDisplay; ?> -->
            </h3>
            <span>student</span>
            <a href="student_profile.php" class="btn">View Profile</a>
        </div>
        <nav class="navbar">
            <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
            <a href="about.php"><i class="fas fa-question"></i><span>about us</span></a>
            <a href="courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
            <a href="teachers.php"><i class="fas fa-chalkboard-user"></i><span>teachers</span></a>
            <a href="contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
        </nav>
    </div>

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