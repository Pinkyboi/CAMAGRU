<?php
    include('../function/connect.php');
    include('../function/verifie_registration.php');
    if($_GET['token'] && $_GET['email']){
        $token = $_GET['token'];
        $email = $_GET['email'];
    }
    else if(($_POST['token'] && $_POST['email']))
    {
        $token = $_POST['token'];
        $email = $_POST['email'];   
    }
    if(isset($token) && isset($email)){
        try{
            $statement = "SELECT * FROM `password_reset` WHERE token = ? AND email = ?";
            $field = array($token,$email);
            if($PDO->statementPDO($statement,$field)){
                if($_POST['submit-confirm-password']){
                    if(!ft_verifie_password($_POST) && isset($token) && isset($email)){
                        $statement2 = "UPDATE users SET passwrd = ? WHERE email = ?";
                        $field2 = array(htmlentities(hash('whirlpool',$_POST['password'])),$_POST['email']);
                        $PDO->statementPDO($statement2,$field2,0);
                        $statement3 = "DELETE FROM `password_reset` WHERE token = ? AND EMAIL = ?";
                        $PDO->statementPDO($statement3,$field,0);
                        $valid = "your password have been reseted";
                        unset($_POST);
                    }
                    else
                        $error = ft_verifie_password($_POST);
                }
            }
            else{
                header('Location: view_login.php');
                die();
            }       
        } 
        catch(Exeption $e){
            var_dump($e->getMessage());
        }
    }
    else{
        header('Location: view_login.php');
        die();
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
    <title>CAMAGRU</title>
</head>
<style>
    
</style>
<body>
    <div class="navbar">
        <div class="LOGO">
            <a href="#"><img src="../imgs/log-logo.svg" alt=""></a>
        </div>
    </div>
    <div class="container reveal">
        <div class="lock"><img src="../imgs/lock.png"></div>
        <div class="form"></div>
        <h1 class="title">Change your password</h1>
        <p>Welcome back! in the fields bellow enter your new password and confirm it.</p>
            <form style="margin-top: 30px;" action="view_change_password.php" method="post">
                <input type="hidden" name = "token" value = <?php echo $token?>>
                <input type="hidden" name = "email" value = <?php echo $email?>>
                <label id="label" for="pass1">Your new password :</label><br>
                <input id = "pass1" type="password" class="<?php if($error)echo 'error'; if($valid) echo 'valid';?>" placeholder="Enter your new password" name="password" required><br>
                <label id="label" for="pass1">Your new password :</label><br>
                <input id = "pass2" type="password" class="<?php if($error)echo 'error'; if($valid) echo 'valid';?>" placeholder="Confirm your new password" name="password1" required><br>
                <input type="submit" name="submit-confirm-password" value="submit">
            </form>
            <a href="./view_login.php" class="redirect">Go to login</a>
            <?php
                if($valid)
                    echo "<div class='valide'>$valid</div>";
                if($error)
                    echo "<div class='errors'>$error</div>";
            ?>   
        </div>
    </div>
    <footer class="footer">© 2019 CAMAGRU</footer>
</body>
</html>