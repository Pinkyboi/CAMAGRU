<?php
    // include('../class/connect.php');
    // var_dump(POST);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CAMAGRU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../style/log.css" />
    <script src="../js/animation.js"></script>
</head>
<body>
    <div class="container">
        <div class="sidebar reveal2"></div>
            <div class="register">
                <p class="question">Not registered on Camagru yet ?<a href="./view_register.php" class="action"> Sign up </a></p>
            </div>
        <div class="login reveal">
            <img src="../imgs/logo.svg" alt="CAMAGRU LOGO" class="logo">
            <form class="form" action="POST">
                <input type="text" placeholder="e-mail or pseudo" required></br>
                <input type="password" placeholder="password" required></br>
                <div class="sb">
                    <input id="submit" type="submit" value="login"> 
                    <img src="../imgs/left-arrow.svg" alt="arow">
                </div>
                <div class="forget-password">
                    <p class="question">Forgot your password ?<a href="./register.html" class="action"> click here </a></p>
                </div>
            </form>
        </div>
    </div>
</body>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</html>
