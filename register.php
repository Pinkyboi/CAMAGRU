<?php
    include("connect.php");
    include("ft_verifie.php");
    $email = $_POST['email'];
    if (isset($_POST['submit'])){
            if(!($_POST['passwrd'] === $_POST['passwrd2'])){
                echo "<style>#passwrd2{border: 1px solid rgb(245, 80, 80);}</style>";
                $false = "<p class='red' >The confirmation password does not match<p>";
            }
            if(strlen($_POST['passwrd']) < 8||strlen($_POST['passwrd']) > 28){
                echo "<style>#passwrd{border: 1px solid rgb(245, 80, 80);}</style>";
                $false = "<p class='red' >The password don't have the right size<p>";
            }
            if(ft_verifie($_PDO,'email',$_POST['email'])){
            if(ft_verifie($_PDO,'pseudo',$_POST['pseudo'])){
                if(!$false){
                    $_PDOstat = $_PDO->prepare('INSERT INTO  users VALUES (NULL, :email,:pseudo,:passwrd)');
                    $_PDOstat->bindValue(':email', htmlentities($_POST['email']),PDO::PARAM_STR);
                    $_PDOstat->bindValue(':pseudo', htmlentities($_POST['pseudo']),PDO::PARAM_STR);
                    $_PDOstat->bindValue(':passwrd', htmlentities(hash('whirlpool',$_POST['passwrd'])),PDO::PARAM_STR);
                    $_PDOstat->execute();   
                }
            }
            else
                $notpseudo = 'pseudo'; 
        }
        else{
            $notmail = 'email';
            if(!ft_verifie($_PDO,'pseudo',$_POST['pseudo']))
                $notpseudo = 'pseudo';
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $msg ?></h1>
    <div class="container">
        <div class="log">
        <img src="./imgs/log2.svg" id="deco">
            <div class="f">
                <img src="./imgs/logo.svg" id="logo">
                <form action="register.php" method="post" class="dump">
                    <input id='email'type="email" placeholder="Adresse email" name="email" autocomplete="off"<?php if(isset($_POST['email']) && !$notmail)echo "value = ".htmlentities($_POST['email'])?> required><br>
                    <?php if (isset($notmail)){ $notmail = "<p class='red' >This $notmail is alredy used <p>";echo $notmail;echo "<style> form #pseudo{margin-top:-10px;} #email{margin-bottom:0;}</style>";}?>
                    <input id='pseudo' type="text" placeholder="Nom de compte" name="pseudo" autocomplete="off" <?php if(isset($_POST['pseudo']) && !$notpseudo)echo "value = ".htmlentities($_POST['pseudo'])?> required><br>
                    <?php if (isset($notpseudo)){ $notpseudo = "<p class='red' > This $notpseudo is alredy used <p>";echo $notpseudo;echo "<style>#passwrd{margin-top:-10px;} #pseudo{margin:-10px;}</style>";} ?>
                    <input id="passwrd" type="password" placeholder="Mot de passe (entre 8 et 28 cracters)" name="passwrd" <?php if(isset($_POST['passwrd']))echo "value = {$_POST['passwrd']}" ?> required><br>
                    <input id="passwrd2" type="password" placeholder="Confirmer le mot de passe" name="passwrd2" required><br>
                    <input type="submit" name="submit" value="connexion">
                    <?php if($false)echo $false;?>
                    <p id='confi '>En cliquant sur "Inscription", vous acceptez les Conditions générales d'utilisation.</p>
                </form>
                <div class="else">
                    <p>Vous n’avez pas de compte  ?  <a href="./inscription">Inscrivez-vous</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</html>