<?php
    include('../function/connect.php');

    $statement = "SELECT * FROM $db_name WHERE(pseudo = ? AND passwrd = ?)";
    if($_POST['login']){
        $field = array($_POST['login'],htmlentities(hash('whirlpool',$_POST['password'])));
        $verif = $PDO->statementPDO($db_name,$statement,$field);
        if($verif == 0){
            $statement2 = "SELECT * FROM $db_name WHERE(email = ? AND passwrd = ?)";
            $verif = $PDO->statementPDO($db_name,$statement2,$field);
        }  
    }
    if($verif == 0 && $_POST['login']){
        if($PDO->verifyPDO('users','email',$_POST['login'])|| $PDO->verifyPDO('users','pseudo',$_POST['login']))
            $error = "Sorry, that password isn't right";
        else
            $error = "Sorry, no account correspond";
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
                    <p class="question">Forgot your password ?<a href="./register.html" class="action"> click here </a></p>
                </div>

            </form>
            <div class="errors-contain">
                <?php
                        if($error != NULL)
                            echo "<div style = 'margin-top: 35px !important;'class='errors'><p>$error</p></div>";
                ?>
                </div>
        </div>
    </div>
</body>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</html>
