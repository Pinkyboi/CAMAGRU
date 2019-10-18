<?php
include('verifieRegistration.php');
include('connect.php');
session_start();
    if($_GET){
        try{
            $message = array();
            if($_GET['changeUser'] == $_SESSION['pseudo'])
                $message['pseudo'] = "You are already using that pseudo";
            else if($_GET['changeUser'] && !($message['pseudo'] = ft_verifie_pseudo($_GET['changeUser'],$PDO))){
                $statement = "UPDATE users SET pseudo = ? WHERE email = ?";
                $field = array($_GET['changeUser'],$_SESSION['email']);
                $PDO->statementPDO($statement,$field,0);
                $_SESSION['pseudo'] = $_GET['changeUser'];
                $message['pseudo'] = 'Your pseudo have been updated';
            }
            if($_GET['changeEmail'] == $_SESSION['email'])
                $message['email'] = "You are already using that email";
            else if($_GET['changeEmail'] && !($message['email'] = ft_verifie_mail($_GET['changeEmail'],$PDO))){
                $statement = "UPDATE users SET email = ? WHERE email = ?";
                $field = array($_GET['changeEmail'],$_SESSION['email']);
                $PDO->statementPDO($statement,$field,0);
                $_SESSION['email'] = $_GET['changeEmail'];
                $message['email'] = 'Your email have been updated';
            }
            if($_GET['changePassword'] && !($message['password'] = ft_verifie_password($_GET['changePassword'],$_GET['confirmChangePassword']))){
                $statement = "UPDATE users SET passwrd = ? WHERE pseudo = ?";
                $field = array(htmlentities(hash('whirlpool',$_GET['changePassword'])),$_SESSION['pseudo']);
                $PDO->statementPDO($statement,$field,0);
                $message['password'] = 'Your password have been updated';
            }
            if($_GET['changeNotif']){
                $statement = "SELECT `notification` FROM users WHERE pseudo = ?";
                $field = array($_SESSION['pseudo']);
                $notifStatus = $PDO->statementPDO($statement,$field);
                $statement1 = "UPDATE users SET `notification` = ? WHERE pseudo = ?";
                $notification = ($_GET['changeNotif'] === 'false')? '0':'1';
                $field1 = array($notification,$_SESSION['pseudo']);
                $PDO->statementPDO($statement1,$field1,0);
                $message['notification'] = ($notification != $notifStatus[0])?"notification status has been uptaded":"";
            }
            if($message['pseudo'] || $message['email'] || $message['password'] || $message['profile'] || $message['notification']){
                echo json_encode($messageSend = array(
                    'pseudo' => $message['pseudo'],
                    'email' => $message['email'],
                    'password' => $message['password'],
                    'profile' => $message['profile'],           
                    'notification' => $message['notification']          
                ));            
            }            
        }
        catch(Exeption $e){}
    }    
?>