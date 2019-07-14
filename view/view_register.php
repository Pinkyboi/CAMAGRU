<?php
    include('../class/connect.php');
    include('../fail.php');
    $PDO = new Database();
    $_PDO = $PDO->initPDO('Camagru','root','tiger');
    $error = array('errpsdo'=>$errpsdo,'errmail'=>$errmail,'errpass'=>$errpass);
    if(ft_verifie_field($_POST,$PDO,$error)){
        $_PDOstat = $_PDO->prepare('INSERT INTO  users VALUES (NULL, ?,?,?)');
        $_PDOstat->bindValue(1, htmlentities($_POST['pseudo']),PDO::PARAM_STR);
        $_PDOstat->bindValue(2, htmlentities($_POST['email']),PDO::PARAM_STR);
        $_PDOstat->bindValue(3, htmlentities(hash('whirlpool',$_POST['password'])),PDO::PARAM_STR);
        $_PDOstat->execute();
        unset($_POST);
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
                            if($err != NULL)
                                echo "<div class='errors'><p>$err</p></div>";
                        }
                    ?>
                </div>
            </div>
    </div>
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