<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin/admin_header.css">

</head>

<body>
    <header class="header">
        <section class="sec">
            <div class="logo-container">
                <a href="admin_header.php">
                    <img src="../images/logo.png" alt="Vidya Vriddhi" class="logo-img">
                </a>
            </div>
            <form action="" method="POST" class="form">
                <input type="text" placeholder="search course">
                <button type="submit" class="fas fa-search" name="search_box"></button>
            </form>
            <div class="icons">
                <div id="menu_btn" class="fas fa-bars"></div>
                <div id="search_btn" class="fas fa-search"></div>
                <div id="user_btn" class="fas fa-user"></div>
            </div>
        </section>
    </header>
    <div class="side-bar">
        <div class="close-side-bar">
            <i class="fas fa-times"></i>
        </div>
        <div class="profile">
            <img src="" alt="">
            <h3>
                <span>Admin</span>
                <h3>
        </div>
        <nav class="navbar">
            <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
            <a href="courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
            <a href="teachers.php"><i class="fas fa-chalkboard-user"></i><span>Expertise</span></a>
        </nav>
    </div>
</body>

</html>