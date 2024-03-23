<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../register/login.css">
</head>

<body>
    <div class="main">
        <div class="left">
            <img src="../images/logo.png" class="logo" alt="">
        </div>
        <div class="right">
            <form action="login_process.php" method="POST" class="form">
                <div class="username prefix">
                    <label>Username :</label>
                    <input type="text" name="username" id="name">
                </div>
                <div class="Password prefix">
                    <label>Password :</label>
                    <input type="password" name="password" id="password">
                </div>
                <button type="submit">Log In</button>
                <div class="container">
                    <div class="signIn">
                        <a href="../register/register.php">Create a New Account</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>