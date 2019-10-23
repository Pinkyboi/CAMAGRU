<?php
    include('connect.php');
    include('verifieRegistration.php');
    function passwordResendVerifie($token,$email,$password,$confirmPassword,$PDO){
        try{
            $statement = "SELECT * FROM `password_reset` WHERE token = ? AND email = ?";
            $field = array($token,$email);            
            if($PDO->statementPDO($statement,$field)){
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
                if(isset($valid) || isset($error)){
                    if(!isset($valid))
                        $valid = '';
                    if(!isset($error))
                        $error = '';
                    echo json_encode($messageSend = array(
                        'valid' => $valid,
                        'error' => $error,
                    ));            
                }                 
            }
            else
                echo "";
           
        }
        catch(Exeption $e){
            
        }
    }
    if(!empty($_GET)){
        passwordResendVerifie($_GET['token'],$_GET['email'],$_GET['password'],$_GET['confirmPassword'],$PDO);
    }
?>