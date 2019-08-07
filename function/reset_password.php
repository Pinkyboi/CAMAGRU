<?php
    include("../class/connect-class.php");
    include("../class/mail-class.php");
    $mail = new Mail();
    if (isset($_POST["reset-request-submit"])){
        $token = bin2hex(random_bytes(32));
        if($_PDO->verifyPDO('users','email',$_POST['email'])){
            $_PDOstat = $_PDO->prepare('INSERT INTO `password` VALUES (?,?)');
            $_PDOstat->bindValue(1, htmlentities($_POST['email']),PDO::PARAM_STR);
            $_PDOstat->bindValue(2, htmlentities($_POST['token']),PDO::PARAM_STR);
        }
    }