<?php
    include("../function/connect.php");
    if (isset($_POST["reset-request-submit"])){
        try{
            $token = bin2hex(openssl_random_pseudo_bytes(16));
            if($PDO->verifyPDO('users','email',htmlentities($_POST['email']))){
                $statement = "SELECT * FROM password_reset WHERE email = ?";
                $field = array($token,htmlentities($_POST['email']));
                if(!$PDO->verifyPDO('password_reset' ,'email',$_POST['email'])){
                    $statement = 'INSERT INTO password_reset VALUES (NULL,?,?)';
                    $PDO->statementPDO($statement,$field,0);
                    $valid = "the email has been sent";
                }
                else{
                    $statement = "UPDATE password_reset SET token = ? WHERE email = ?";
                    $PDO->statementPDO($statement,$field,0);
                    $valid = "the email has been resent";
                }
                $mail->password_mail($_POST['email'],$token);
            }
            else
            $error = "There's no account with is email";
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
        <div class="form1">
            <div class="logo"><img src="../imgs/password.png"></div> 
            <h1 class="title">Reset your password</h1>
            <p style="margin-top: 15px;">An email will be send to you with instruction onhow reset your password.</p>
            <form style="margin-top: 20px;"action="view_password.php" method="POST">
                <input class="<?php if($error)echo"error"; if($valid)echo"valid";?>"type="email" name="email" placeholder="Enter your email address"><br>
                <input type="submit" value='send' name="reset-request-submit">
            </form>
            <a href="./view_login.php" class="redirect">Go to login</a>
        </div>
        <?php
            if($valid)
                echo "<div class='valide'>$valid</div>";
            if($error)
                echo "<div class='errors'>$error</div>"
        ?>
    </div>
        <footer class="footer">© 2019 CAMAGRU</footer>
</body>
</html>