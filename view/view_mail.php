<?php
    include('../function/connect.php');
    include('../function/sendmail.php');
    session_start();
    if(!$_SESSION['token'] || !$_SESSION['pseudo']){
        header('Location: view_login.php');
        die();
    }
    if(($_GET['pseudo'] == $_SESSION['pseudo'])&&($_GET['resend'] == $_SESSION['resend'])){
        $mail->password_mail($_SESSION['email'],$_SESSION['user'],$_SEESION['token']);
        $valid = "the mail has been resent";
        $_SESSION['resend'] = md5(rand(1,9999)); 
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CAMAGRU</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../style/mail.css" />
    <script src="../js/animation.js"></script>
</head>
<body>
    <div class="navbar">
        <div class="LOGO">
            <a href="#"><img src="../imgs/log-logo.svg" alt=""></a>
        </div>
    </div>
    <div class="reveal container ">
        <div class="field">
            <div class="logo"><img src="../imgs/mail.png" alt=""></div>
            <div class="translate">
                <h1 class="title">Verification link sent!</h1><br>
                <p>Your acount hs been sccessfully registred to complete the precess enter the link sent to your email<br><span id="email"><?php echo $_SESSION['email']?></span></p><br>
            </div>
        </div> 
            <div class="resend">
                <p class="question"> if you didn't get any email ?<a class ="send" href="./view_mail.php?<?php if($_SESSION['pseudo'])echo 'pseudo='.$_SESSION['pseudo']?><?php if($_SESSION['resend'])echo '&resend='.$_SESSION['resend']?>"> Resend confirmation email</a></p>
            </div>
            <?php
                if($valid)
                    echo "<div style='position: relative;top: 60px;'class='valide'>$valid</div>";
            ?>
    </div>
    <footer class="footer">© 2019 CAMAGRU</footer>
</body>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</html>  
