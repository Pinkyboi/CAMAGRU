<?php
    include('connect.php');
    include('verifieRegistration.php');
    function passwordResendVerifie($token,$email,$password,$confirmPassword,$PDO){
        try{
            $messageSend = array();
            if(!ft_verifie_password($password,$confirmPassword)){
                $statement = "UPDATE `users` SET passwrd = ? WHERE email = ?";
                $password = hash('whirlpool',$password);
                $field = array($password,$email);
                $PDO->statementPDO($statement,$field,0);
                $field = array($token,$email);
                $statement2 = "DELETE FROM `password_reset` WHERE token = ? AND EMAIL = ?";
                $PDO->statementPDO($statement2,$field,0);
                $valid = "your password have been reseted";
            }
            else
                $error = ft_verifie_password($password,$confirmPassword); 
            if($valid || $error){
                echo json_encode($messageSend = array(
                    'valid' => $valid,
                    'error' => $error,
                ));            
            }            
        }
        catch(Exeption $e){
            
        }
    }
    if($_GET['resetPassword']&&$_GET['password']&&$_GET['email']&&$_GET['confirmPassword']&&$_GET['token']){
        passwordResendVerifie($_GET['token'],$_GET['email'],$_GET['password'],$_GET['confirmPassword'],$PDO);
    }
?>