<?php
include '../database/db_connect.php';
session_start();
if (isset ($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM expert WHERE email = '$username'";
    $result = $conn->query($sql);
    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $contact = $row['pnum'];
            $address = $row['address'];
            $profession = $row['profession'];
            $institution = $row['institution'];
            $document = $row['document'];
            $profile = $row['profile_picture'];
            $dec = $row['description'];
        } else {
            echo "No rows returned from the database for username: $username";
        }
    } else {
        echo "Query execution failed: " . $conn->error;
    }
} else {
    echo "Username session variable is not set.";
}
$userNameDisplay = isset ($fname) ? $fname : 'User';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <script src="https://kit.fontawesome.com/8eab227f7f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/expertise/ex_profile.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User profile</title>
</head>

<body>
    <div class="containers_user">
        <div class="container_display">
            <div class="display">
                <img src="<?php echo $document; ?>" />
                <h1 style="color: aliceblue">
                    <?php echo $fname . ' ' . $lname; ?>
                </h1>
                <label>Contribute:</label>
            </div>
        </div>

        <div class="container_nav">
            <ul>
                <li><a href="ex_profile.php"><i class="fa-solid fa-user"></i> profile</a></li>
                <li><a href="expertise_header.php"><i class="fas fa-home"></i>home</a></li>
            </ul>
        </div>

        <div class="container_show">
            <div class="user">
                <h2>EXPERTISE INFORMATION</h2>
                <form>
                    <div class="row">
                        <label>First name</label>
                        <input type="text" name="fname" id="fname" placeholder="<?php echo $fname; ?>" />

                        <label>Email</label>
                        <input type="email" name="email" id="email" placeholder="<?php echo $email; ?>" />
                    </div>

                    <div class="colum">
                        <label>Last name</label>
                        <input type="text" name="lname" id="lname" placeholder="<?php echo $lname; ?>" />
                    </div>

                </form>
                <div>
                    <div class="user">
                        <br>
                        <h2>CONTACT INFORMATION</h2>
                        <form>
                            <div class="row">
                                <label>Address</label>
                                <input type="text" name="address" id="address" placeholder="<?php echo $address; ?>" />

                                <!-- <label>Contact Number</label>
                                <input type="text" name="pnum" id="pnum" placeholder="<?php echo $contact; ?>" /> -->
                            </div>

                            <div class="colum">
                                <label>Contact Number</label>
                                <input type="text" name="pnum" id="pnum" placeholder="<?php echo $contact; ?>" />
                            </div>
                        </form>
                    </div>

                    <div class="user">
                        <br>
                        <h2>About us</h2>
                        <form>
                            <div class="row">
                                <label>Profession</label>
                                <input type="text" name="profession" id="profession"
                                    placeholder="<?php echo $profession; ?>" />
                                <label>Short Intro</label>
                                <textarea type="textarea" name="dec" id="dec"
                                    placeholder="<?php echo $dec; ?>"></textarea>
                            </div>

                            <div class="colum">
                                <label>Instution</label>
                                <input type="text" name="instution" id="instution"
                                    placeholder="<?php echo $institution; ?>" />
                            </div>
                        </form>
                    </div>

                    <div class="user">
                        <br>
                        <h2>Documents/Certificate</h2>
                        <form>
                            <div class="row">
                                <img src="<?php echo $profile; ?>" />
                                <!-- <label>Short Intro</label>
                                <textarea type="textarea" name="dec" id="dec" placeholder="about"></textarea> -->
                            </div>

                            <!-- <div class="colum">
                                <label>Instution</label>
                                <input type="text" name="instution" id="instution" placeholder="Instution" />
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
</body>

</html>