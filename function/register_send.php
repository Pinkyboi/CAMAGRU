<?php
    
    function send($POST,&$SESSION,$_PDO){
        $token = rand(1000,9999);
        $_PDOstat = $_PDO->prepare('INSERT INTO  users VALUES (NULL, ?,?,?,?)');
        $_PDOstat->bindValue(1, htmlentities($_POST['pseudo']),PDO::PARAM_STR);
        $_PDOstat->bindValue(2, htmlentities($_POST['email']),PDO::PARAM_STR);
        $_PDOstat->bindValue(3, htmlentities(hash('whirlpool',$_POST['password'])),PDO::PARAM_STR);
        $_PDOstat->bindValue(4,$token,PDO::PARAM_STR);
        $_PDOstat->execute();
        $SESSION = $POST;
        $SESSION['token'] = $token;
        sendmail($SESSION['email'],$SESSION['token']);
    }
?>