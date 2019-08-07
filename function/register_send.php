<?php
    function send($POST,&$SESSION,$_PDO){
        $token  = md5(uniqid($_POST['pseudo'], true));
        $SESSION['token'] = $token;
        $SESSION['pseudo'] = $POST['pseudo'];
        $_PDOstat = $_PDO->prepare("INSERT INTO  users VALUES (NULL, ?,?,?,?,'../gallery/profile.png')");
        $_PDOstat->bindValue(1, htmlentities($_POST['pseudo']),PDO::PARAM_STR);
        $_PDOstat->bindValue(2, htmlentities($_POST['email']),PDO::PARAM_STR);
        $_PDOstat->bindValue(3, htmlentities(hash('whirlpool',$_POST['password'])),PDO::PARAM_STR);
        $_PDOstat->bindValue(4,$token,PDO::PARAM_STR);
        $_PDOstat->execute();
    }
?>