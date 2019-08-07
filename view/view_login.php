<?php
    include('../function/connect.php');
    include("../function/validate_image.php");
    session_start();
    $statement = "SELECT * FROM users WHERE (pseudo = ? AND passwrd = ?) OR (email = ? AND passwrd = ?)";
    if($_POST['submit']){
        $password = htmlentities(hash('whirlpool',$_POST['password']));
        $field = array($_POST['login'],$password,$_POST['login'],$password);
        $verif = $PDO->statementPDO($statement,$field);
        if(!$verif){
            if($PDO->verifyPDO('users','email',$_POST['login']) || $PDO->verifyPDO('users','pseudo',$_POST['login']))
                $error = "Sorry, that password isn't right";
            else
                $error = "Sorry, no account correspond";            
        }
        else{
            $_SESSION['pseudo'] = $verif['pseudo'];
            $_SESSION['email']  = $verif['email'];
            $_SESSION['profile'] = profilePic($_SESSION,$PDO);
            if($verif['token'])
                header("Location: view_mail.php");
            else
                header("Location: view_change_info.php");
            die();
        }  
    }
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
    <div class="navbar">
        <div class="LOGO">
            <a href="#"><img src="../imgs/log-logo.svg" alt=""></a>
        </div>
    </div>
    <div class="gallery">
        <p class="question">Not sure yet ?<a href="./view_password.php" class="action"> discover our gallery now</a></p>
    </div>
        <div class="container">
            <div class="sidebar reveal2"></div>
                <div class="register">
                    <p class="question">Not registered on Camagru yet ?<a href="./view_register.php" class="action"> Sign up </a></p>
                </div>
            <div class="login reveal">
                <img src="../imgs/logo.svg" alt="CAMAGRU LOGO" class="logo">
                <form action = "view_login.php" class="form" method="POST">
                    <input class="<?php if($error)echo"error"?>"type="text" name ="login" placeholder="e-mail or pseudo" required></br>
                    <input class="<?php if($error)echo"error"?>"type="password" name="password" placeholder="password" required></br>
                    <div class="sb">
                        <input id="submit" type="submit" name='submit' value="login"> 
                        <img src="../imgs/left-arrow.svg" alt="arow">
                    </div>
                    <div class=" register forget-password">
                        <p class="question">Forgot your password ?<a href="./view_password.php" class="action"> click here </a></p>
                    </div>

                </form>
                <div class="errors-contain">
                    <?php
                            if($error)
                                echo "<div style = 'margin-top: 35px !important;'class='errors'><p>$error</p></div>";
                    ?>
                </div>
        </div>        
    </div>
    <footer class="footer">© 2019 CAMAGRU</footer>
</body>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</html>
