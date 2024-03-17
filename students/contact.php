<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin/admin_header.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto');

        .contactContainner {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-top: 50px;
        }

        .wrapper {

            width: 100%;
            max-width: 550px;
            background: black;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .wrapper .title h1 {
            color: #c5ecfd;
            text-align: center;
            margin-bottom: 25px;
        }

        .contact-form {
            display: flex;
        }

        .input-fields {
            display: flex;
            flex-direction: column;
            margin-right: 4%;
        }

        .input-fields,
        .msg {
            width: 48%;
        }

        .input-fields .input,
        .msg textarea {
            margin: 10px 0;
            background: transparent;
            border: 0px;
            border-bottom: 2px solid #c5ecfd;
            padding: 10px;
            color: #c5ecfd;
            width: 100%;
        }

        .msg textarea {
            height: 212px;
        }

        ::-webkit-input-placeholder {
            /* Chrome/Opera/Safari */
            color: #c5ecfd;
        }

        ::-moz-placeholder {
            /* Firefox 19+ */
            color: #c5ecfd;
        }

        :-ms-input-placeholder {
            /* IE 10+ */
            color: #c5ecfd;
        }

        .btn {
            background: #39b7dd;
            text-align: center;
            padding: 15px;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            .contact-form {
                flex-direction: column;
            }

            .msg textarea {
                height: 80px;
            }

            .input-fields,
            .msg {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php
    include_once ('../students/student_header.php');
    ?>
    <div class="contactContainner">
        <div class="wrapper">
            <div class="title">
                <h1>contact us form</h1>
            </div>
            <div class="contact-form">
                <div class="input-fields">
                    <input type="text" class="input" placeholder="Name">
                    <input type="text" class="input" placeholder="Email Address">
                    <input type="text" class="input" placeholder="Phone">
                    <input type="text" class="input" placeholder="Subject">
                </div>
                <div class="msg">
                    <textarea placeholder="Message"></textarea>
                    <div class="btn">send</div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>