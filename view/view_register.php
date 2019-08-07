<?php
    session_start();
    include('../function/verifie_registration.php');
    include('../function/register_send.php');
    include('../function/connect.php');
    include('../function/sendmail.php');
    $error = array('errpsdo'=>$errpsdo,'errmail'=>$errmail,'errpass'=>$errpass);
    if(ft_verifie_field($_POST,$PDO,$error)){
        send($_POST,$_SESSION,$_PDO);
        $mail->verification_mail($_SESSION['email'],$_SESSION['pseudo'],$_SEESION['token']);
        header("Location: view_mail.php");
        die();
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

</head>
<body>
    <div class="navbar">
        <div class="LOGO">
            <a href="view_login.php"><img src="../imgs/log-logo.svg" alt=""></a>
        </div>
    </div>
    <div class="gallery">
        <p class="question">Not sure yet ?<a href="./view_password.php" class="action"> discover our gallery now</a></p>
    </div>
    <div class="container">
            <div class="sidebar reveal2"></div>
                <div class="register">
                    <p class="question"> Already registered on Camagru ?<a href="./view_login.php" class="action"> login </a></p>
                </div>
            <div class="login reveal">
                <img src="../imgs/logo.svg" alt="CAMAGRU LOGO" class="logo">
                <form action = "view_register.php" class="form1" method="POST">
                    <input class = "pseudo <?php if( $error['errpsdo'])echo"error"?>" type="text" value = "<?php echo $_POST['pseudo']?>" name="pseudo" placeholder="profile name" required></br>
                    <input class ="email <?php if($error['errmail'])echo"error"?>" type="email" value = "<?php echo $_POST['email']?>" name="email" placeholder="email" required></br>
                    <input class ="password" type="password" name="password" placeholder="password" value = "<?php echo $_POST['password']?>" required></br>
                    <input class ="password1" value = "<?php echo $_POST['password1']?>"  type="password" name="password1" placeholder="confirm your password" required></br>
                    <div class="sb">
                        <input type="submit" name='submit' value="register"> 
                        <img src="../imgs/left-arrow.svg" alt="arow">
                    </div>
                </form>
                <div class="errors-contain">
                    <?php
                        foreach($error as $err){
                            if($err)
                                echo "<div class='errors'><p>$err</p></div>";
                        }
                    ?>
                </div>
            </div>
    </div>
    <footer class="footer">© 2019 CAMAGRU</footer>
        <script src="../js/animation.js"></script>
        <script>
            var password = document.querySelector('.password');
            var password1 = document.querySelector('.password1');
            if((password.value && !password1.value) || (password.value != password1.value))
                password1.classList.add('error');
            if(password.value.length != 0 && (password.value.length < 8 ||password.value.length > 28))
             password.classList.add('error')
        </script>
</body>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</html>