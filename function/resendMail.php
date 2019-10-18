<?php
    include('connect.php');

    function getEmail($user,$PDO){
        $statement = 'SELECT `email` FROM `users` WHERE ID = ?';
        $field = array($user);
        $email = $PDO->statementPDO($statement,$field);
        return($email['email']);
    }
    function getToken($user,$PDO){
        $statement = 'SELECT `token` FROM `users` WHERE ID = ?';
        $field = array($user);
        $token = $PDO->statementPDO($statement,$field);
        return($token['token']); 
    }
    function changeToken($user,$PDO){
        $statement = "UPDATE users SET token = ? WHERE ID = ?";
        $token  = md5(uniqid($user, true));
        $field = array($token,$user);
        $PDO->statementPDO($statement,$field,0);
        return($token);
    }
    if($_GET['ID'] && getToken($_GET['ID'],$PDO)){
        try{
            $userID = $_GET['ID'];
            $statement= 'SELECT pseudo FROM users WHERE ID = ?';
            $user = $PDO->statementPDO($statement, array($userID));
            $email = getEmail($userID,$PDO);
            $token = changeToken($userID,$PDO);
            if($mail->verificationMail($email, $user[0], $_GET['ID'], $token))
                echo 'email';
            $valid = "the mail has been resent";
            if($_GET['use']){
                $mail->verificationMail($email, $user[0], $_GET['ID'], $token);
                echo $valid;
            }
                  
        }
        catch(Exeption $e){}
    }
    else{
        header('Location: ../views/viewIndex.php');
        die();
    }