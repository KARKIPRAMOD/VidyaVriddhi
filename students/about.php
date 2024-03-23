<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin/admin_header.css">
    <style>
        body {
            background-color: white !important;
        }

        .aboutme {
            width: 100%;
            padding: 20px;
            padding-top: 50px;
        }

        .atitle {
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .acontainner {
            display: flex;
            width: 100%;
            align-items: center;
            margin-top: 60px;
        }

        .aleft {
            flex: 1;
        }

        .asubtitle {
            font-size: 25px;
            font-weight: bold;
            color: #42b867;
            margin-bottom: 10px;
        }

        .atext {
            font-size: 14px;
            color: #616161;
            max-width: 500px;
            line-height: 20px;

        }

        .avertical {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            gap: 20px;
        }

        .avertical .atext {
            text-align: center;
        }

        .aimage1 {
            height: 300px;
        }

        .aimage {
            flex: 1;
        }

        .aimage {
            height: 300px;
        }

        .strong {
            font-weight: bold;
            font-size: 30px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php
    include_once ('../students/student_header.php');
    ?>
    <div class="aboutme">
        <div class="atitle">
            <div class="strong">Vidhya Vriddhi </div> Empowering Students Through Digital Learning
        </div>
        <div class="acontainner avertical">
            <img class="aimage1" src="../images/elearning.svg" alt="">
            <div class="asubtitle">
                Who are we?
            </div>
            <div class="atext">As Vidhya Vriddhi, we're a dedicated team of educators and technologists committed to
                revolutionizing education. Our platform offers accessible, engaging, and personalized learning
                experiences for students worldwide. Join us in creating a brighter future through digital education.
            </div>

        </div>
        <div class="acontainner">
            <img class="aimage" src="../images/mission.svg" alt="">

            <div class="aleft">
                <div class="asubtitle" style="color: #08a4dd;">
                    Our Mission
                </div>
                <div class="atext">At Vidhya Vriddhi, our mission is simple: to empower students through digital
                    learning. We aim to break down barriers to education by providing a platform where learners can
                    access high-quality courses from anywhere in the world. By harnessing the power of technology, we
                    strive to make learning more interactive, engaging, and effective for students of all ages and
                    backgrounds.</div>
            </div>
        </div>

    </div>
</body>

</html>