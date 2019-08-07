<?php
    include('../function/connect.php');
    session_start();
    session_destroy();
    if(!$_GET['token'] || !$_GET['pseudo']){
        header('Location: view_login.php');
        die();
    }
    else{
        try{
            $statement = "SELECT * FROM `users` WHERE  pseudo = ? AND token = ?";
            $field = array($_GET['pseudo'],$_GET['token']);
            var_dump($_GET);
            if($PDO->statementPDO($statement,$field)){
                $statement2 = "UPDATE users SET token = 0 WHERE pseudo = ? AND token = ?";
                $PDO->statementPDO($statement2,$field,0);
            }
            else
            {
                header('Location: view_login.php');
                die();  
            }
        }
        catch(Exeption $e){
            var_dump($e->getMessage());
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="../style/mail.css" />
    <script src="../js/animation.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="navbar">
        <div class="LOGO">
            <a href="#"><img src="../imgs/log-logo.svg" alt=""></a>
        </div>
    </div>
    <div class="container reveal">
        <div style ="margin-top: 50px;">
            <div class="logo" style="margin-left: 45px;margin-top: 15px;"><img src="../imgs/validation.png"></div> 
            <h1 class="title" style="margin-top: 20px;">Your account have been Acrivated!</h1>
            <p style="margin-top: 15px;">Welcome to CAMAGRU You can connect to account now!</p>
            <a href="./view_login.php" style="position: relative;top: 60px;"class="redirect">Go to login</a>
        </div>
    </div>
        <footer class="footer">© 2019 CAMAGRU</footer>
</body>
</html>