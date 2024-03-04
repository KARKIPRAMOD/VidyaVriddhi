<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display PDF</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
        <h3 class="w3-bar-item">Menu</h3>
        <a href="#" class="w3-bar-item w3-button">Link 1</a>
        <a href="#" class="w3-bar-item w3-button">Link 2</a>
        <a href="#" class="w3-bar-item w3-button">Link 3</a>
    </div>
    <div style="margin-left:25%">
        <div class="w3-container w3-teal">
            <h1>
                <div class="logo-container">
                    <a href="../students/courses.php">
                        <img src="../images/logo.png" alt="Vidya Vriddhi" class="logo-img">idya
                    </a>
                </div>
            </h1>
        </div>
        <div class="w3-container">
            <?php 
             if(isset($_GET['course_id'])){
                $course_id = $_GET['course_id']; 
                $source = $course_id . ".pdf";
                echo "<iframe src='$source'  width='100%' height='720px' frameborder='0'></iframe>";
            }
            
            ?>
        </div> 
    </div>
</body>
</html>
