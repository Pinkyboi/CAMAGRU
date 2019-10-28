<?php
    include($_SERVER['DOCUMENT_ROOT']."/class/connect-class.php");
    include($_SERVER['DOCUMENT_ROOT']."/class/mail-class.php");
    $mail = new Mail();

    if (isset($_POST["reset-request-submit"])){
        try{
            $token = bin2hex(random_bytes(32));
            if($_PDO->verifyPDO('users','email',$_POST['email'])){
                $_PDOstat = $_PDO->prepare('INSERT INTO `password` VALUES (?,?)');
                $_PDOstat->bindValue(1, htmlentities($_POST['email']),PDO::PARAM_STR);
                $_PDOstat->bindValue(2, htmlentities($_POST['token']),PDO::PARAM_STR);
            }            
        }
        catch(Exeption $e){}
    }